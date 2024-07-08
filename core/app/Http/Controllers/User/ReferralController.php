<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Transaction;
use App\Models\GeneralSetting;

class ReferralController extends Controller
{
    /**
     * Assign a referral code to the user.
     *
     * @param  string  $referralCode
     * @return RedirectResponse
     */
    public function assignReferrer($referralCode)
    {
        if ( $_SERVER['HTTP_REFERRER'] ) {
            $httpReferrer = $_SERVER['HTTP_REFERRER'];
        }
        else {
            $httpReferrer = '';
        }

        $refCookieName = config('referral.cookie_name');
        $refCookieHttpReferrerName = config('referral.cookie_http_referrer_name');
        $refCookieExpiry = config('referral.cookie_expiry');
        if (Cookie::has($refCookieName)) {
            // Referral code cookie already exists, redirect to configured route
            return redirect()->route(config('referral.redirect_route'));
        } else {
            // Create a referral code cookie and redirect to configured route
            $ck = Cookie::make($refCookieName, $referralCode, $refCookieExpiry);
            Cookie::make($refCookieHttpReferrerName, $httpReferrer, $refCookieExpiry);
            return redirect()->route(config('referral.redirect_route'))->withCookie($ck);
        }
    }

    /**
     * Generate referral codes for existing users.
     *
     * @return JsonResponse
     */
    public function createReferralCodeForExistingUsers()
    {
        $userModel = resolve(config('auth.providers.users.model'));
        $users = $userModel::cursor();

        foreach ($users as $user) {
            if (!$user->hasReferralAccount()) {
                $user->createReferralAccount();
            }
        }

        return response()->json(['message' => 'Referral codes generated for existing users.']);
    }

    public function getReferralLink()
    {
        $pageTitle = "Referral Link";
        $user      = auth()->user();

        if (!$user->hasReferralAccount()) {
            $user->createReferralAccount();
        }

       $refLink = $user->getReferralLink();
       $referralCode = $user->getReferralCode();
       $oldReferralCode = $user->getOldReferralCode();

       $referrals = $user->referrals;

       //dd($referrals);

       return view($this->activeTemplate . 'user.referral.index', compact('pageTitle','refLink', 'referrals', 'referralCode', 'oldReferralCode'));

        //return response()->json(['message' => 'Referral codes generated for existing users.']);
    }

    public function getUserReferrals()
    {

        $pageTitle = "Referral Link";
        $user      = auth()->user();
        $transactionsPurchase = [];
        $transactionsJob = [];
        $referrals = $user->referrals;
        foreach($referrals as $referral){
            $transactionsPurchase[]      = Transaction::where("user_id", $referral->user_id)->where("remark", "deposit")->get()->toArray();
            $transactionsJob[]      = Transaction::where("user_id", $referral->user_id)->where("remark", "payment_receive")->get()->toArray();
        }

        $settings = GeneralSetting::where("id",1)->first();

        $currency_percentage = $settings->currency_percentage;
        $job_percentage = $settings->job_percentage;

        return view($this->activeTemplate . 'user.referral.history', compact('pageTitle','referrals',"transactionsPurchase","transactionsJob","currency_percentage","job_percentage"));

    }
}
