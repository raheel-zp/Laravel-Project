<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
});

Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->group(function () {

        Route::get('user-data', 'User\UserController@userData')->name('data');
        Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->namespace('User')->group(function () {

            Route::controller('UserController')->group(function () {
                Route::get('dashboard', 'home')->name('home');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                Route::get('kyc-form','kycForm')->name('kyc.form');
                Route::get('kyc-data','kycData')->name('kyc.data');
                Route::post('kyc-submit','kycSubmit')->name('kyc.submit');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');

                Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });


            Route::middleware(['block.status'])->group(function () {
                //Manage Job
                Route::controller('JobPostController')->prefix('job')->name('job.')->group(function () {
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('history', 'history')->name('history');
                    Route::get('edit/{id}', 'edit')->name('edit');
                    Route::post('update/{id}', 'update')->name('update');
                  
                    Route::post('status/{id}', 'status')->name('status');
                    Route::get('details/{id}', 'details')->name('details');
                    Route::get('rating/{id}', 'rating')->name('rating');
                    Route::get('finished', 'finished')->name('finished');
                    Route::get('apply', 'apply')->name('apply');
                    Route::get('attachment/{id}', 'attachment')->name('attachment');
                    Route::get('attachment/download/{id}', 'downloadAttachment')->name('download.attachment');
                    Route::post('approve/{id}', 'approve')->name('approve');
                    Route::post('rejected/{id}', 'rejected')->name('rejected');
                    Route::post('review-store/{id}', 'reviewStore')->name('review.store');
                });

            });

            Route::middleware(['block.execution.status'])->group(function () {
                Route::controller('JobPostController')->prefix('job')->name('job.')->group(function () {
                    Route::post('prove/{id}', 'prove')->name('prove');
                });
            });

            Route::controller('ReferralController')->prefix('referral')->name('referral.')->group(function () {
                Route::get(config('referral.route_prefix') . '/{referralCode}', 'assignReferrer')->name('referralLink');
                Route::get('generate-ref-accounts', 'createReferralCodeForExistingUsers')->name('generateReferralCodes');
                Route::get('get-ref-link', 'getReferralLink')->name('getReferralLink');
                Route::get('user-referrals', 'getUserReferrals')->name('getUserReferrals');

            });


            // Withdraw
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function () {
                Route::middleware('kyc')->group(function(){
                    Route::get('/', 'withdrawMoney');
                    Route::post('/', 'withdrawStore')->name('.money');
                    Route::get('preview', 'withdrawPreview')->name('.preview');
                    Route::post('preview', 'withdrawSubmit')->name('.submit');
                });
                Route::get('history', 'withdrawLog')->name('.history');
            });
        });

        // Payment
        Route::middleware('registration.complete')->prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function () {
            Route::any('/', 'deposit')->name('index');
            Route::post('insert', 'depositInsert')->name('insert');
            Route::get('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });
    });
});
