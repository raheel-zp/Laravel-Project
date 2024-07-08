<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\JobPost;
use App\Models\JobProve;
use App\Models\User;
use App\Models\Language;
use App\Models\Page;
use App\Models\Referral;
use App\Models\SubCategory;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;




class SiteController extends Controller
{
    public function index()
    {
        $pageTitle  = 'Home';
        $sections   = Page::where('tempname', $this->activeTemplate)->where('slug', '/')->first();
        $categories = Category::active()->orderBy('name')->get();
        $keywords   = JobPost::approved()->groupBy('category_id')->with('category')->selectRaw('count(*) as count, category_id')->orderBy('count', 'desc')->take(4)->get();
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'categories', 'keywords'));
    }

    public function pages($slug)
    {
        $page      = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections  = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact', compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);
        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket           = new SupportTicket();
        $ticket->user_id  = auth()->id() ?? 0;
        $ticket->name     = $request->name;
        $ticket->email    = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;

        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title     = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message                    = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message           = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id)
    {
        $policy    = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate . 'policy', compact('policy', 'pageTitle'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();

        if (!$language) {
            $lang = 'en';
        }

        session()->put('lang', $lang);
        return back();
    }

    public function blogDetails($slug, $id)
    {
        $pageTitle                         = "Blog Details";
        $blog                              = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $blogs                             = Frontend::where('data_keys', 'blog.element')->where('id', '!=', $id)->orderBy('id', 'desc')->take(5)->get();
        $seoContents['keywords']           = explode(' ', $blog->data_values->title) ?? [];
        $seoContents['social_title']       = $blog->data_values->title;
        $seoContents['description']        = strLimit(strip_tags($blog->data_values->description), 150);
        $seoContents['social_description'] = strLimit(strip_tags($blog->data_values->description), 150);
        $seoContents['image']              = getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '800x600');
        $seoContents['image_size']         = '800x600';
        return view($this->activeTemplate . 'blog_details', compact('blog', 'blogs', 'pageTitle', 'seoContents'));
    }

    public function blogs()
    {
        $pageTitle = "Blogs";
        $blogs     = Frontend::where('data_keys', 'blog.element')->orderBy('id', 'desc')->paginate(getPaginate(9));
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        return view($this->activeTemplate . 'blogs', compact('pageTitle', 'blogs', 'sections'));
    }

    public function cookieAccept()
    {
        $general = gs();
        Cookie::queue('gdpr_cookie', $general->site_name, 43200);
    }

    public function cookiePolicy()
    {
        $pageTitle = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        return view($this->activeTemplate . 'cookie', compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null)
    {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);

        if ($fontSize <= 9) {
            $fontSize = 9;
        }

        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general   = gs();

        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }

    public function allJobs()
    {
        $pageTitle  = "All Jobs";

        if (Auth::check()) {
            $jobs       = JobPost::approved()->where('vacancy_available', '>', 0)->where('job_block_status', 0)->orderBy('id', 'desc')->paginate(getPaginate(9));
            $categories = Category::active()->orderBy('name')->take(20)->get();
        } else {


            $jobs       = JobPost::approved()
                                    ->where('is_hidden', 0)
                                    ->whereHas('category', function($query) {
                                        $query->where('is_hidden', 0);
                                    })
                                    ->where('vacancy_available', '>', 0)
                                    ->where('job_block_status', 0)
                                    ->orderBy('id', 'desc')
                                    ->paginate(getPaginate(9));


            $categories = Category::active()->where('is_hidden', '=', 0)->orderBy('name')->take(20)->get();
        }

        return view($this->activeTemplate . 'job.index', compact('pageTitle', 'jobs', 'categories'));
    }

    public function jobDetails($id, $title)
    {
        $pageTitle = 'Job Details';

        if (Auth::check()) {
            $job       = JobPost::where('id', $id)->where('job_block_status', '=', 0)->firstOrFail();
        } else {
            $job       = JobPost::where('id', $id)->where('is_hidden', 0)->where('job_block_status', '=', 0)->firstOrFail();
        }

        $completedJobsCount = JobProve::where('user_id', $job->user_id)->where('status', 1)->count();
        $rejectedJobsCount = JobProve::where('user_id', $job->user_id)->where('status', 2)->count();
        $pendingJobsCount = JobProve::where('user_id', $job->user_id)->where('status', 0)->count();

        $userDataWithCounts = User::where('id', $job->user_id)->withCount(['jobs','pause', 'pending', 'approved', 'completed', 'rejected'])->get();

        $jobsCount    = $userDataWithCounts->pluck('jobs_count')->sum();
        $pendingJobsCount    = $userDataWithCounts->pluck('pending_count')->sum();
        $approvedJobsCount   = $userDataWithCounts->pluck('approved_count')->sum();
        $pauseJobsCount   = $userDataWithCounts->pluck('pause_count')->sum();
        //$completedJobsCount   = $userDataWithCounts->pluck('completed_count')->sum();
        //$rejectedJobsCount   = $userDataWithCounts->pluck('rejected_count')->sum();


       //$userData['name'] = $userDataWithCounts->firstname . ' ' . $userDataWithCounts->lastname;
       $userData['jobsCount']           = $jobsCount;
       $userData['pendingJobsCount']    = $pendingJobsCount;
       $userData['approvedJobsCount']   = $approvedJobsCount;
       $userData['pauseJobsCount']      = $pauseJobsCount;
       $userData['completedJobsCount']  = $completedJobsCount;
       $userData['rejectedJobsCount']   = $rejectedJobsCount;


        $seoContents['keywords']           = explode(' ', $job->title) ?? [];
        $seoContents['social_title']       = $job->title;
        $seoContents['description']        = strLimit(strip_tags($job->description), 150);
        $seoContents['social_description'] = strLimit(strip_tags($job->description), 150);
        $seoContents['image']              = getImage('assets/images/job/' . @$job->attachment, '550x400');
        $seoContents['image_size']         = '600x400';

        return view($this->activeTemplate . 'job.details', compact('pageTitle', 'job', 'seoContents', 'userData'));
    }

    public function subcategories($id, $title)
    {
        $pageTitle = ucwords(str_replace('-', ' ', $title));
        $category  = Category::active()->withCount('subcategory as subcategory')->findOrFail($id);
        if (!$category->subcategory) {
            return to_route('category.jobs', ['name' => slug($category->name), 'id' => $category->id]);
        }

        $subCategories = SubCategory::active()->where('category_id', $id)->with('posts')->withCount([
            'posts as jobApprove' => function ($jobPost) {
                $jobPost->approved();
            },
        ])->paginate(getPaginate());

        return view($this->activeTemplate . 'subcategories', compact('pageTitle', 'subCategories'));
    }

    public function categories()
    {
        $pageTitle  = "All Categories";

        if (Auth::check()) {
            $categories = Category::active()->with('jobPosts')->orderBy('name')->paginate(getPaginate());
        } else {
            $categories = Category::active()->where('is_hidden', '=', 0)->with('jobPosts')->orderBy('name')->paginate(getPaginate());
        }

        return view($this->activeTemplate . 'categories', compact('pageTitle', 'categories'));
    }

    public function subcategoryJobs($id, $name)
    {

        $pageTitle  = ucwords(str_replace('-', ' ', $name));
        $jobs       = JobPost::approved()
                        ->where('is_hidden', '=', 0)
                        ->whereHas('category', function($query) {
                            $query->where('is_hidden', 0);
                        })->where('subcategory_id', $id)->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::featured()->orderBy('name')->get();
        return view($this->activeTemplate . 'job.index', compact('pageTitle', 'jobs', 'categories'));
    }

    public function categoryJobs($id, $name)
    {
        $pageTitle  = ucwords(str_replace('-', ' ', $name));
        $jobs       = JobPost::approved()->where('category_id', $id)->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::featured()->orderBy('name')->get();
        return view($this->activeTemplate . 'job.index', compact('pageTitle', 'jobs', 'categories'));
    }

    public function sortJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'nullable|string|in:today,monthly,weekly',
            'sort' => 'nullable|string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $date       = $request->get('date');
        $sort       = $request->get('sort');
        $categoryId = $request->get('category_id');

        if (Auth::check()) {
            $jobs = JobPost::where('vacancy_available', '>', 0)->where('job_block_status', 0);
        }
        else{

            $jobs = JobPost::where('is_hidden', 0)
                            ->whereHas('category', function($query) {
                                $query->where('is_hidden', 0);
                            })
                            ->where('vacancy_available', '>', 0)
                            ->where('job_block_status', 0);
        }

        if ($request->ajax()) {
            $jobs = $this->filterJob($jobs, $categoryId, $sort, $date);
        }

        $jobs = $jobs->approved()->paginate(getPaginate(9));

        return view($this->activeTemplate . 'partials.jobs', compact('jobs'));
    }

    public function jobSearch()
    {
        $category  = request()->category;
        $search    = request()->search;
        $pageTitle = "Search Result";


        if (Auth::check()) {
            $jobs      = JobPost::query();

        }
        else{

            if ($category) {
                $catFind = Category::active()->where('id', $category)->firstOrFail();
                if (isset($catFind) && $catFind->is_hidden == 1) {
                    return to_route('user.login');
                }
            }

            $jobs      = JobPost::where('is_hidden', '=', 0)->whereHas('category', function($query) {
                $query->where('is_hidden', 0);
            });
        }


        if ($search) {
            $jobs = $jobs
            ->where('title', 'LIKE', '%' . $search . '%');
        }

        if ($category) {
            $jobs = $jobs->where('category_id', $category);
        }


        $jobs       = $jobs->approved()->paginate(getPaginate());
        $categories = Category::active()->get();
        return view($this->activeTemplate . 'job.index', compact('jobs', 'categories', 'pageTitle'));
    }

    protected function filterJob($jobs, $categoryId, $sort, $date)
    {

        if ($categoryId && !in_array('all', $categoryId)) {
            $jobs = $jobs->whereIn('category_id', $categoryId);
        }
        if ($sort) {
            $jobs = $jobs->orderBy('rate', $sort);
        }
        if ($date) {
            if ($date == 'today') {
                $jobs = $jobs->whereDate('created_at', Carbon::today()->format('Y-m-d H:i:s'));
            }
            if ($date == 'weekly') {
                $jobs = $jobs->whereBetween('created_at', [Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')]);
            }
            if ($date == 'monthly') {
                $jobs = $jobs->whereDate('created_at', '>=', Carbon::now()->subDay(30)->format('Y-m-d H:i:s'));
            }
        }
        return $jobs;
    }

    /**
     * Assign a referral code to the user.
     *
     * @param  string  $referralCode
     * @return RedirectResponse
     */
    public function assignReferrer($referralCode)
    {

        if ( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ) {
            $httpReferrer = $_SERVER['HTTP_REFERER'];
        }
        else {
            $httpReferrer = '';
        }

        $refCookieName = config('referral.cookie_name');
        $refCookieHttpReferrerName = config('referral.cookie_http_referrer_name');

        $refCookieExpiry = config('referral.cookie_expiry');


        $refCookieHttpReferrerName = config('referral.cookie_http_referrer_name');


        if (Cookie::has($refCookieName)) {

            Cookie::queue($refCookieHttpReferrerName, $httpReferrer, $refCookieExpiry);

           // $httpReferrer = Cookie::get($refCookieHttpReferrerName);

           // dd($httpReferrer);
            // Referral code cookie already exists, redirect to configured route
            return redirect()->route(config('referral.redirect_route'));
        } else {

            Cookie::queue($refCookieName, $referralCode, $refCookieExpiry);
            Cookie::queue($refCookieHttpReferrerName, $httpReferrer, $refCookieExpiry);


            // Create a referral code cookie and redirect to configured route
           // $ck = Cookie::make($refCookieName, $referralCode, $refCookieExpiry);
            //Cookie::make($refCookieHttpReferrerName, $httpReferrer, $refCookieExpiry);

           // $httpReferrer = Cookie::get($refCookieHttpReferrerName);

           // dd($httpReferrer);

            return redirect()->route(config('referral.redirect_route'));

            //return redirect()->route(config('referral.redirect_route'))->withCookie($ck);
        }
    }

    public function updateReferenceLink(Request $request)
    {

        $user      = auth()->user();
        $user_id = $user->id;
        $reference = Referral::where("user_id", $user_id)->first();

        if(!preg_match('/^[\w-]+$/', $request->referral_code)){
            return response()->json(["success"=> false, 'message' => 'Spaces and Special charcters not allowed.'], 200);
        }

        if($request->referral_code == $reference->referral_code){
            return response()->json(["success"=> false, 'message' => 'You are already using this Referral Code.'], 200);
        }

        $settings = GeneralSetting::where("id",1)->first();
        $badwords = explode(",",$settings->bad_words);

        if(in_array($request->referral_code,$badwords)){
            return response()->json(["success"=> false, 'message' => 'You have used forbidden words. Please use ethical words.'], 200);
        }
        else{
            $refCount = Referral::where("referral_code", $request->referral_code)->where('old_referral_code', '!=', $request->referral_code)->where('user_id', '!=', $user_id)->count();
            if($refCount == 0){
                $reference->old_referral_code = $reference->referral_code;
                $reference->referral_code = $request->referral_code;
                $reference->save();

                return response()->json(["success"=> true,'message' => 'Reference link updated successfully'], 200);
            }
            else{
                return response()->json(["success"=> false, 'message' => 'The code is already in use please use some other code.'], 200);
            }
        }
    }

    public function profileDetails(Request $request, $id, $name)
    {
        $pageTitle = 'User Profile';

        $user = User::findOrFail($id);

        $averageRating = $user->calculateRating($id);

        $reviewsFilter = $request->input('reviews_filter');
        $ratingFilter = $request->input('rating_filter');

        $jobIds = $user->getUserJobsWithRating($id, $ratingFilter, $reviewsFilter);

        $jobIds = $jobIds->unique()->values()->toArray();

        //dd($uniqueArray);

        $jobs  = JobPost::whereIn('id', $jobIds)->with('proves')->latest()->paginate(getPaginate());

        return view($this->activeTemplate . 'user.profile', compact('pageTitle', 'id', 'user', 'jobs', 'averageRating', 'ratingFilter', 'reviewsFilter'));

    }

    public function ratingOnJobCompleted($id, $name)
    {
        $pageTitle = 'Ratings On Job Performed';

        $jobProves  = JobProve::where('user_id', auth()->id())->with(['job', 'job.user'])->orderBy('id', 'desc')->paginate(getPaginate());

        //dd($jobProves);

        return view($this->activeTemplate . 'user.rating-received', compact('pageTitle', 'jobProves'));
    }

    public function ratingOnJobPosted($id, $name)
    {
        $pageTitle = 'Ratings Received';

        $jobs      = JobPost::searchable(['job_code', 'title'])->where('user_id', auth()->id())->with('proves')->latest()->paginate(getPaginate());

        return view($this->activeTemplate . 'user.rating-given', compact('pageTitle', 'jobs'));
    }


}
