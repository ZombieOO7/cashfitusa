<?php

use Illuminate\Support\Facades\Artisan;

Route::get('/command/{slug}', function($command) {
    $status = Artisan::call($command);
    return '<h1>Command success</h1>';
});

Route::get('/admin', function () {
    if (\Auth::guard('admin')) {
        return redirect()->intended(route('admin_dashboard'));
    } else {
        return redirect('admin/login');
    }
})->name('/');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/','DashboardController@index')->name('loan');
    Route::get('/work-from-home','DashboardController@workFromHome')->name('work-from-home');
    Route::post('apply-loan','LoanController@applyLoan')->name('apply-loan');
    Route::get('calculate','LoanController@calculate')->name('calculate');
    Route::post('/apply-for-loan','LoanController@applyForLoan')->name('apply.loan.post');
    Route::get('/loan-detail','LoanController@loanDetail')->name('loan.detail');
    Route::post('/user/store','LoanController@store')->name('user.store');
    Route::post('/user/validate/email','LoanController@validateEmail')->name('validate.email');
});

Route::get('login', ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
// Route::post('login', ['as' => '','uses' => 'Auth\LoginController@login']);
Route::post('user-login', 'LoginController@authenticate')->name('user.login');
Route::get('register/user','Auth\LoginController@showRegisterForm')->name('register.form');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('user-logout', ['as' => 'user-logout','uses' => 'LoginController@logout']);

// Password Reset Routes...
Route::post('password/email', ['as' => 'password.email','uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request','uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => 'password.update','uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset','uses' => 'Auth\ResetPasswordController@showResetForm']);

Route::group(['middleware' => ['auth:web','active_user'], 'namespace' => 'Frontend'], function () {
    Route::get('/dashboard','DashboardController@dashboard')->name('dashboard');
    Route::get('/wallet','DashboardController@wallet')->name('wallet');
    Route::get('/home', 'DashboardController@dashboard')->name('home');
    Route::get('/profile','DashboardController@profile')->name('user.profile');
    Route::post('/profile-update','DashboardController@profileUpdate')->name('user.profile.update');
    Route::group(['prefix' => 'application', 'middleware' => ['auth:web']], function () {
        Route::get('/','LoanController@application')->name('application');
        Route::get('datatable','LoanController@getdata')->name('user.loan.datatable');
        Route::get('detail/{userId}','LoanController@detail')->name('application.view');
        Route::get('download/{userId}','LoanController@download')->name('application.download');
        Route::get('edit/{uuid}', 'LoanController@create')->name('application.edit');//->middleware(['role_or_permission:superadmin|product category edit'],'signed');
        Route::get('document/{id?}','LoanController@document')->name('upload.document');
        Route::post('document/upload','LoanController@documentUpload')->name('user.document.store');
        Route::get('identy/{uuid?}','LoanController@identy')->name('identy');
        Route::post('identy/store','LoanController@identyStore')->name('identy.store');
        Route::post('documentStore/{type?}','LoanController@documentStore')->name('store.loan.document');
        Route::get('receipt','LoanController@receipt')->name('receipt');
        Route::post('store-account-detail','AccountController@storeAccountDetail')->name('store-account-detail');
        Route::get('solution-for-you/{id?}','AccountController@solution')->name('solution-for-you');
        Route::get('document-verification/{id?}','AccountController@documentVerification')->name('document-verification');
        Route::get('bank-account-verification/{id?}','AccountController@bankAccountVerification')->name('account-verification');
        Route::get('link-bank/{id?}','AccountController@linkBank')->name('link.bank');
        Route::get('proceed/{uuid?}/{status?}','AccountController@proceedBankDetail')->name('proceed');
        // Route::get('verification-completed/{id?}','AccountController@verificationCompleted')->name('doc-verf-completed');
        Route::get('verification-rejected/{id?}','AccountController@verificationRejected')->name('doc-verf-rejected');
        Route::get('please-be-patience/{id?}','AccountController@pleaseBePatience')->name('please-be-patience');
    });
    Route::group(['prefix' => 'work', 'middleware' => ['auth:web']], function () {
    Route::get('/{slug?}','WorkController@index')->name('earning');
        Route::get('/apply/{slug?}','WorkController@create')->name('apply.work-from-home');
        Route::match(['post', 'PUT'],'/store/{id?}','WorkController@store')->name('work-from-home.store');
        Route::post('documentStore/{type?}','LoanController@documentStore')->name('store.earning.document');
        Route::get('datatable/{appId?}', 'WorkController@getdata')->name('app-earning.datatable');
        Route::get('withdrawRequest/{appId?}/{earningId?}','WorkController@withdrawRequest')->name('withdraw.request');
    });
    Route::get('updateProfile','DashboardController@updateProfile')->name('update-profile');
    Route::get('clearNotification/{type?}','WorkController@clearNotification')->name('clearNotification');
    Route::get('card-order/{uuid?}','AccountController@cardOrder')->name('card-order');
    Route::post('store-withdraw-info','AccountController@storeWithdrawInfo')->name('store-withdraw-info');

});
Route::get('contact-us','Frontend\DashboardController@contactPage')->name('get.contact-us');
Route::get('about-us','Frontend\DashboardController@aboutUs')->name('get.about-us');
Route::post('contact-us','Frontend\DashboardController@contactUs')->name('post.contact-us');
Route::get('terms-of-use','Frontend\DashboardController@cmsPages')->name('terms-of-use');
Route::get('security-and-privacy','Frontend\DashboardController@cmsPages')->name('security-and-privacy');
Route::get('terms-of-use',function(){
    return view('frontend/term_of_use',['title'=>'Terms of use']);
})->name('terms-of-use');
Route::get('security-privacy',function(){
    return view('frontend.security_privacy',['title'=>'Security Privacy']);
})->name('security-privacy');
Route::get('accessibility',function(){
    return view('frontend.accessibility',['title'=>'Accessibility']);
})->name('accessibility');

Route::get('do-not-sell-my-information',function(){
    return view('frontend.term_of_use',['title'=>'Do Not Sell My Information']);
})->name('do-not-sell-my-information');

Auth::routes(['verify' => true]);