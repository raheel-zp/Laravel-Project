<?php


use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('close/{ticket}', 'closeTicket')->name('close');
    Route::get('download/{ticket}', 'ticketDownload')->name('download');
});

Route::controller('ContestController')->prefix('contest')->name('contest.')->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('home', 'home')->name('home');
    Route::get('addingJobs', 'addingJobs')->name('addingJobs');
    Route::get('makingJobs', 'makingJobs')->name('makingJobs');
    Route::get('contest-winner', 'contestWinner')->name('contestWinner');
});

Route::controller('DisputeController')->prefix('dispute')->name('dispute.')->group(function () {
    Route::get('index/{id}', 'index')->name('index');
    Route::post('create', 'create')->name('create');
    Route::post('addMessage', 'addMessage')->name('addMessage');
    Route::post('resolve', 'resolveDispute')->name('resolve');
    Route::post('adminHelp', 'adminHelp')->name('adminHelp');
    Route::get('dispute-detail/{id}', 'disputeDetails')->name('disputeDetails');
    Route::get('dispute-approve/{id}', 'disputeApprove')->name('disputeApprove');

});


Route::controller('SiteController')->group(function () {

    Route::get('contact', 'contact')->name('contact');
    Route::post('contact', 'contactSubmit');
    Route::get('change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('category/list', 'categories')->name('category.list');
    Route::get('category/job/{id}/{name}', 'categoryJobs')->name('category.jobs');
    Route::get('subcategory/{id}/{title}', 'subcategories')->name('subcategory.list');
    Route::get('subcategory/job/{id}/{name}', 'subcategoryJobs')->name('subcategory.jobs');


    Route::get('blogs', 'blogs')->name('blogs');
    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');
    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');


    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');
    Route::get('/{slug}', 'pages')->name('pages');

    Route::get('/', 'index')->name('home');

    Route::get('job/list', 'allJobs')->name('job.list');
    Route::middleware(['block.execution.status'])->group(function () {
        Route::get('job-details/{id}/{title}', 'jobDetails')->name('job.details');
    });
    Route::get('job/sort', 'sortJob')->name('job.sort');
    Route::get('job/pagination', 'sortJob');
    Route::get('job/search', 'jobSearch')->name('job.search');

    Route::get(config('referral.route_prefix') . '/{referralCode}', 'assignReferrer')->name('referralLink');
    Route::post('update-reference-link', 'updateReferenceLink')->name('updateReferenceLink');

    Route::get('profile-details/{id}/{name}', 'profileDetails')->name('profile.details');
    Route::post('profile-details/{id}/{name}', 'profileDetails')->name('profile.details');
    Route::get('rating-on-job-completed/{id}/{name}', 'ratingOnJobCompleted')->name('profile.ratingOnJobCompleted');
    Route::get('rating-on-job-posted/{id}/{name}', 'ratingOnJobPosted')->name('profile.ratingOnJobPosted');
});
