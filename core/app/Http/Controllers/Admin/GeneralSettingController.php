<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Contest;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'General Setting';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.general', compact('pageTitle', 'timezones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:40',
            'cur_text' => 'required|string|max:40',
            'cur_sym' => 'required|string|max:40',
            'base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required',
        ]);

        $general = gs();
        $general->site_name = $request->site_name;
        $general->cur_text = $request->cur_text;
        $general->cur_sym = $request->cur_sym;
        $general->base_color = $request->base_color;
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = ' . $request->timezone . ' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function referralSettings()
    {
        $pageTitle = 'Referral Settings';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.referralSettings', compact('pageTitle', 'timezones'));
    }

    public function updateReferralSettings(Request $request)
    {
        $request->validate([
            'currency_percentage' => 'required|int',
            'job_percentage' => 'required|int',
        ]);

        $general = gs();
        $general->currency_percentage = $request->currency_percentage;
        $general->job_percentage = $request->job_percentage;
        $general->save();

        $notify[] = ['success', 'Referral setting updated successfully'];
        return back()->withNotify($notify);
    }


    public function contestSettings()
    {
        $pageTitle = 'Contest Settings';
        $contest   = Contest::where('contest_state', 1)->where('contest_type', 1)->orderby("id","desc")->get()->toArray();
        if(empty($contest)){
            $contest   = Contest::where('contest_state', 0)->where('contest_type', 1)->orderby("id","desc")->get()->toArray();
        }

        $contest2   = Contest::where('contest_state', 1)->where('contest_type', 2)->orderby("id","desc")->get()->toArray();
        if(empty($contest2)){
            $contest2   = Contest::where('contest_state', 0)->where('contest_type', 2)->orderby("id","desc")->get()->toArray();
        }

        $contest3   = Contest::where('contest_state', 1)->where('contest_type', 3)->orderby("id","desc")->get()->toArray();
        if(empty($contest3)){
            $contest3   = Contest::where('contest_state', 0)->where('contest_type', 3)->orderby("id","desc")->get()->toArray();
        }

        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.contestSettings', compact('pageTitle', 'timezones','contest','contest2','contest3'));
    }

    public function updateContestSettings(Request $request)
    {
        $request->validate([
            'contest_name' => 'required|string',
            'contest_month' => 'required|string',
            'contest_state' => 'required|boolean',
            'contest_prize' => 'required|string',
            'friend_task_added' => 'required|int',
            'friend_task_completed' => 'required|int',
            'rules' => 'required|string',
        ]);
        $contest_type = $request->contest_type;

        $activeContest   = Contest::where('contest_state', 1)->where('contest_type', $contest_type)->orderby("id","desc")->first();
        if(empty($activeContest)){
            $activeContest   = Contest::where('contest_state', 0)->where('contest_type', $contest_type)->orderby("id","desc")->first();
        }
        $activeContest->contest_name = $request->contest_name;
        $activeContest->contest_month = $request->contest_month;
        $activeContest->contest_state = $request->contest_state;
        $activeContest->contest_prize = $request->contest_prize;
        $activeContest->friend_task_added = $request->friend_task_added;
        $activeContest->friend_task_completed = $request->friend_task_completed;
        $activeContest->rules = $request->rules;
        $activeContest->save();

        $notify[] = ['success', 'Contest setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function badwordsSettings()
    {
        $pageTitle = 'Forbidden Words Settings';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.badwordsSettings', compact('pageTitle', 'timezones'));
    }

    public function updatebadwordsSettings(Request $request)
    {
        $request->validate([
            'bad_words' => 'required|string',
        ]);

        $general = gs();
        $general->bad_words = $request->bad_words;
        $general->save();

        $notify[] = ['success', 'Forbidden Words updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemConfiguration()
    {
        $pageTitle = 'System Configuration';
        return view('admin.setting.configuration', compact('pageTitle'));
    }


    public function systemConfigurationSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $general->ev = $request->ev ? Status::ENABLE : Status::DISABLE;
        $general->en = $request->en ? Status::ENABLE : Status::DISABLE;
        $general->sv = $request->sv ? Status::ENABLE : Status::DISABLE;
        $general->sn = $request->sn ? Status::ENABLE : Status::DISABLE;
        $general->kv = $request->kv ? Status::YES : Status::NO;
        $general->approve_job = $request->approve_job ? Status::ENABLE : Status::DISABLE;
        $general->force_ssl = $request->force_ssl ? Status::ENABLE : Status::DISABLE;
        $general->secure_password = $request->secure_password ? Status::ENABLE : Status::DISABLE;
        $general->registration = $request->registration ? Status::ENABLE : Status::DISABLE;
        $general->agree = $request->agree ? Status::ENABLE : Status::DISABLE;
        $general->multi_language = $request->multi_language ? Status::ENABLE : Status::DISABLE;
        $general->save();
        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function customCss()
    {
        $pageTitle = 'Custom CSS';
        $file = activeTemplate(true) . 'css/custom.css';
        $fileContent = @file_get_contents($file);
        return view('admin.setting.custom_css', compact('pageTitle', 'fileContent'));
    }


    public function customCssSubmit(Request $request)
    {
        $file = activeTemplate(true) . 'css/custom.css';
        if (!file_exists($file)) {
            fopen($file, "w");
        }
        file_put_contents($file, $request->css);
        $notify[] = ['success', 'CSS updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode()
    {
        $pageTitle = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance', compact('pageTitle', 'maintenance'));
    }

    public function maintenanceModeSubmit(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);
        $general = GeneralSetting::first();
        $general->maintenance_mode = $request->status ? Status::ENABLE : Status::DISABLE;
        $general->save();

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        $maintenance->data_values = [
            'description' => $request->description,
        ];
        $maintenance->save();

        $notify[] = ['success', 'Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }

    public function cookie()
    {
        $pageTitle = 'GDPR Cookie';
        $cookie = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        return view('admin.setting.cookie', compact('pageTitle', 'cookie'));
    }

    public function cookieSubmit(Request $request)
    {
        $request->validate([
            'short_desc' => 'required|string|max:255',
            'description' => 'required',
        ]);
        $cookie = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        $cookie->data_values = [
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'status' => $request->status ? Status::ENABLE : Status::DISABLE,
        ];
        $cookie->save();
        $notify[] = ['success', 'Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
}
