<?php

/* Admin login routes */

Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.post');
Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin/password/reset');


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {
    /** Dashboard route */
    Route::get('/dashboard', 'DashboardController@index')->name('admin_dashboard');
    /**User management route list */
    /**Product Category management route list */
    Route::group(['prefix' => 'user', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'UserController@index')->name('user.index');//->middleware(['role_or_permission:superadmin|product category view']);
        Route::get('create', 'UserController@create')->name('user.create');//->middleware(['role_or_permission:superadmin|product category create']);
        Route::get('edit/{uuid}', 'UserController@create')->name('user.edit');//->middleware(['role_or_permission:superadmin|product category edit'],'signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'UserController@store')->name('loan.user.store');
        Route::delete('delete', 'UserController@destroy')->name('user.delete');//->middleware(['role_or_permission:superadmin|product category delete']);
        Route::get('datatable', 'UserController@getdata')->name('user.datatable');
        Route::post('active_inactive', 'UserController@updateStatus')->name('user.active_inactive');//->middleware(['role_or_permission:superadmin|product category active inactive']);
        Route::post('multi_delete', 'UserController@multidelete')->name('user.multi_delete');//->middleware(['role_or_permission:superadmin|product category multiple delete|product category multiple active|product category multiple inactive']);
        Route::match(['post', 'PUT'],'document/{id?}','UserController@storeDoacument')->name('document.store');
    });

    Route::group(['prefix' => 'loan', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'LoanController@index')->name('loan.index');
        Route::get('datatable','LoanController@getdata')->name('loan.datatable');
        Route::get('create','LoanController@create')->name('loan.create');
        Route::get('edit/{uuid}', 'LoanController@create')->name('loan.edit');//->middleware(['role_or_permission:superadmin|product category edit'],'signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'LoanController@store')->name('loan.store');
        Route::delete('delete', 'LoanController@destroy')->name('loan.delete');//->middleware(['role_or_permission:superadmin|product category delete']);
        Route::post('active_inactive', 'LoanController@updateStatus')->name('loan.active_inactive');//->middleware(['role_or_permission:superadmin|product category active inactive']);
        Route::post('multi_delete', 'LoanController@multidelete')->name('loan.multi_delete');//->middleware(['role_or_permission:superadmin|product category multiple delete|product category multiple active|product category multiple inactive']);
        Route::get('approve/{uuid?}', 'LoanController@update')->name('loan.approve');
        Route::get('reject/{uuid?}','LoanController@update')->name('loan.reject');
        Route::post('docStatus','LoanController@docStatus')->name('doc.status');
        Route::get('export','LoanController@export')->name('loan.export');
        Route::get('transaction/{uuid?}','LoanController@getTransaction')->name('loan.transaction');
        Route::get('getTransactionData/{id?}','LoanController@getTransactionData')->name('get.loan.transaction');
        Route::post('storeTransactionData','LoanController@storeTransactionData')->name('store.loan.transaction');
    });

    /**Role management */
    Route::group(['prefix' => 'role'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {
            Route::get('/', 'RoleController@index')->middleware([])->name('role_index');
            Route::get('create', 'RoleController@create')->middleware([])->name('role_create');
            Route::get('edit/{id}', 'RoleController@create')->middleware([])->name('role_edit')->middleware('signed');
            Route::match(['post', 'PUT'], 'role/store', [
                'as' => 'role_store',
                'uses' => 'RoleController@store',
            ]);
            Route::delete('delete', 'RoleController@destroyRole')->middleware([])->name('role_delete');
            Route::get('role_datatable', 'RoleController@getdata')->middleware([])->name('role_datatable');
            Route::post('role_multi_delete', 'RoleController@multideleteRole')->middleware([])->name('role_multi_delete');
        });
    });
    /**Admin management */
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {

            Route::get('/', 'AdminController@index')->middleware([])->name('admin_index');
            Route::get('create', 'AdminController@create')->middleware([])->name('admin_create');
            Route::get('edit/{id}', 'AdminController@create')->middleware([])->name('admin_edit')->middleware('signed');
            Route::match(['post', 'PUT'], 'admin/store', [
                'as' => 'admin_store',
                'uses' => 'AdminController@store',
            ]);
            Route::delete('delete', 'AdminController@destroyAdmin')->middleware([])->name('admin_delete');
            Route::get('admin_datatable', 'AdminController@getdata')->middleware([])->name('admin_datatable');
            Route::post('active_inactive', 'AdminController@updateStatus')->middleware([])->name('admin_active_inactive');
            Route::post('admin_multi_delete', 'AdminController@multideleteAdmin')->middleware([])->name('admin_multi_delete');
        });

    });
    /**Permission route list */
    Route::group(['prefix' => 'permission'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {

            Route::get('/', 'PermissionController@index')->middleware([])->name('permission_index');
            Route::get('permission_create', 'PermissionController@create')->middleware([])->name('permission_create');
            Route::get('edit/{id}', 'PermissionController@create')->middleware([])->name('permission_edit')->middleware('signed');
            Route::match(['post', 'PUT'], 'store', [
                'as' => 'permission_store',
                'uses' => 'PermissionController@store',
            ]);
            Route::delete('delete', 'PermissionController@destroyPermission')->middleware([])->name('permission_delete');
            Route::get('permission_datatable', 'PermissionController@getdata')->middleware([])->name('permission_datatable');
            Route::post('permission_multi_delete', 'PermissionController@multideletePermission')->middleware([])->name('permission_multi_delete');
        });
    });

    /**CMS route list */
    Route::group(['prefix' => 'CMS'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {
            Route::get('/', 'CMSController@index')->middleware(['permission:page view'])->name('cms_index');
            Route::get('create', 'CMSController@create')->middleware(['permission:page create'])->name('cms_create');
            Route::get('edit/{uuid}', 'CMSController@create')->middleware(['permission:page edit'])->name('cms_edit')->middleware('signed');
            Route::match(['post', 'PUT'], 'store', [
                'as' => 'cms_store',
                'uses' => 'CMSController@store',
            ]);
            Route::delete('delete', 'CMSController@destroyCms')->middleware(['permission:page delete'])->name('cms_delete');
            Route::post('multi_delete', 'CMSController@multideleteCMS')->middleware(['permission:page multiple delete'])->name('cms_multi_delete');
            Route::get('/cms_datatable', 'CMSController@getdata')->middleware([])->name('cms_datatable');
            Route::post('active_inactive', 'CMSController@updateStatus')->name('cms_active_inactive');
        });
    });

    /**Contact Us route list */
    Route::group(['prefix' => 'contactus'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {

            Route::get('/', 'ContactUsController@index')->middleware([])->name('contact_us_index');
            Route::get('contact_us_create', 'ContactUsController@create')->middleware([])->name('contact_us_create');
            Route::match(['post', 'PUT'], 'store', [
                'as' => 'contact_us_store',
                'uses' => 'ContactUsController@store',
            ]);
            Route::get('edit/{uuid}', 'ContactUsController@create')->middleware([])->name('contact_us_edit')->middleware('signed');
            Route::post('contact_us_multi_delete', 'ContactUsController@multideleteContactUs')->middleware([])->name('contact_us_multi_delete');
            Route::delete('delete', 'ContactUsController@destroyContactUs')->middleware([])->name('contact_us_delete');
            Route::get('contact_us_datatable', 'ContactUsController@getdata')->middleware([])->name('contact_us_datatable');
            Route::get('detail/{uuid}', 'ContactUsController@detail')->name('contact_us_detail');
        });
    });

    Route::group(['prefix' => 'websetting', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'SettingController@index')->name('web_setting_index')->middleware(['permission:web setting view']);
        Route::match(['post', 'PUT'], '/store/{id?}', 'SettingController@store')->name('general_setting_store');
        Route::match(['post', 'PUT'], '/socialstore/{id?}', 'SettingController@socialStore')->name('social_setting_store');
    });

    /**Push Notification management */
    Route::group(['prefix' => 'notifications'], function () {
        Route::group(['middleware' => ['auth:admin']], function () {
            Route::get('/', 'PushNotificationController@index')->middleware([])->name('push_notification_index');
            Route::get('edit/{id}', 'PushNotificationController@create')->middleware([])->name('push_notification_edit')->middleware('signed');
            Route::match(['post', 'PUT'], 'role/store', [
                'as' => 'push_notification_store',
                'uses' => 'PushNotificationController@store',
            ]);
            Route::get('push_notification_datatable', 'PushNotificationController@getdata')->middleware([])->name('push_notification_datatable');
        });
    });

    /**Faq Category management route list */
    Route::group(['prefix' => 'faq-category', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'FaqCategoryController@index')->name('faq-category.index');
        Route::get('create', 'FaqCategoryController@create')->name('faq-category.create');
        Route::get('edit/{uuid}', 'FaqCategoryController@create')->name('faq-category.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'FaqCategoryController@store')->name('faq-category.store');
        Route::delete('delete', 'FaqCategoryController@destroy')->name('faq-category.delete');
        Route::get('datatable', 'FaqCategoryController@getdata')->name('faq-category.datatable');
        Route::post('active_inactive', 'FaqCategoryController@updateStatus')->name('faq-category.active_inactive');
        Route::post('multi_delete', 'FaqCategoryController@multidelete')->name('faq-category.multi_delete');
    });

    /**Faq Category management route list */
    Route::group(['prefix' => 'review', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'ReviewController@index')->name('review.index');
        Route::get('create', 'ReviewController@create')->name('review.create');
        Route::get('edit/{uuid}', 'ReviewController@create')->name('review.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'ReviewController@store')->name('review.store');
        Route::delete('delete', 'ReviewController@destroy')->name('review.delete');
        Route::get('datatable', 'ReviewController@getdata')->name('review.datatable');
        Route::post('active_inactive', 'ReviewController@updateStatus')->name('review.active_inactive');
        Route::post('multi_delete', 'ReviewController@multidelete')->name('review.multi_delete');
    });

    /**App management route list */
    Route::group(['prefix' => 'app', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'AppController@index')->name('app.index');
        Route::get('create', 'AppController@create')->name('app.create');
        Route::get('edit/{uuid}', 'AppController@create')->name('app.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'AppController@store')->name('app.store');
        Route::delete('delete', 'AppController@destroy')->name('app.delete');
        Route::get('datatable', 'AppController@getdata')->name('app.datatable');
        Route::post('active_inactive', 'AppController@updateStatus')->name('app.active_inactive');
        Route::post('multi_delete', 'AppController@multidelete')->name('app.multi_delete');
    });

    /**Earning management route list */
    Route::group(['prefix' => 'earning', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'EarningController@index')->name('earning.index');
        Route::get('create', 'EarningController@create')->name('earning.create');
        Route::get('edit/{uuid}', 'EarningController@create')->name('earning.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'EarningController@store')->name('earning.store');
        Route::delete('delete', 'EarningController@destroy')->name('earning.delete');
        Route::get('datatable', 'EarningController@getdata')->name('earning.datatable');
        Route::post('active_inactive', 'EarningController@updateStatus')->name('earning.active_inactive');
        Route::post('multi_delete', 'EarningController@multidelete')->name('earning.multi_delete');
    });

    /**User Earning management route list */
    Route::group(['prefix' => 'user-earning', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'UserEarningController@index')->name('user-earning.index');
        Route::get('create', 'UserEarningController@create')->name('user-earning.create');
        Route::get('edit/{uuid}', 'UserEarningController@create')->name('user-earning.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'UserEarningController@store')->name('user-earning.store');
        Route::delete('delete', 'UserEarningController@destroy')->name('user-earning.delete');
        Route::get('datatable', 'UserEarningController@getdata')->name('user-earning.datatable');
        Route::post('active_inactive', 'UserEarningController@updateStatus')->name('user-earning.active_inactive');
        Route::post('multi_delete', 'UserEarningController@multidelete')->name('user-earning.multi_delete');
        Route::post('appUser','UserEarningController@appUser')->name('user-earning.appuser');
    });

    /**Withdraw request management route list */
    Route::group(['prefix' => 'withdraw', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'WithdrawRequestController@index')->name('withdraw.index');
        Route::get('create', 'WithdrawRequestController@create')->name('withdraw.create');
        Route::get('edit/{uuid}', 'WithdrawRequestController@create')->name('withdraw.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'WithdrawRequestController@store')->name('withdraw.store');
        Route::delete('delete', 'WithdrawRequestController@destroy')->name('withdraw.delete');
        Route::get('datatable', 'WithdrawRequestController@getdata')->name('withdraw.datatable');
        Route::post('active_inactive', 'WithdrawRequestController@updateStatus')->name('withdraw.active_inactive');
        Route::post('multi_delete', 'WithdrawRequestController@multidelete')->name('withdraw.multi_delete');
    });

    /**Loan Category management route list */
    Route::group(['prefix' => 'loan-category', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'LoanCategoryController@index')->name('loan-category.index');
        Route::get('create', 'LoanCategoryController@create')->name('loan-category.create');
        Route::get('edit/{uuid}', 'LoanCategoryController@create')->name('loan-category.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'LoanCategoryController@store')->name('loan-category.store');
        Route::delete('delete', 'LoanCategoryController@destroy')->name('loan-category.delete');
        Route::get('datatable', 'LoanCategoryController@getdata')->name('loan-category.datatable');
        Route::post('active_inactive', 'LoanCategoryController@updateStatus')->name('loan-category.active_inactive');
        Route::post('multi_delete', 'LoanCategoryController@multidelete')->name('loan-category.multi_delete');
        Route::post('jobStatus', 'LoanCategoryController@jobStatus')->name('loan-category.jobstatus');
        Route::post('multipleJobStatus', 'LoanCategoryController@multipleJobStatus')->name('loan-category.multipleJobStatus');
    });

    /**Faq management route list */
    Route::group(['prefix' => 'faq', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'FaqController@index')->name('faq.index');
        Route::get('create', 'FaqController@create')->name('faq.create');
        Route::get('edit/{uuid}', 'FaqController@create')->name('faq.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'FaqController@store')->name('faq.store');
        Route::delete('delete', 'FaqController@destroy')->name('faq.delete');
        Route::get('datatable', 'FaqController@getdata')->name('faq.datatable');
        Route::post('active_inactive', 'FaqController@updateStatus')->name('faq.active_inactive');
        Route::post('multi_delete', 'FaqController@multidelete')->name('faq.multi_delete');
    });
    /**Email template management route list */
    Route::group(['prefix' => 'email-template', 'middleware' => ['auth:admin']], function () {
        Route::get('/', 'EmailTemplateController@index')->name('emailTemplate.index');
        Route::get('create', 'EmailTemplateController@create')->name('emailTemplate.create');
        Route::get('edit/{uuid}', 'EmailTemplateController@create')->name('emailTemplate.edit')->middleware('signed');
        Route::match(['post', 'PUT'], '/store/{id?}', 'EmailTemplateController@store')->name('emailTemplate.store');
        Route::delete('delete', 'EmailTemplateController@destroy')->name('emailTemplate.delete');
        Route::get('datatable', 'EmailTemplateController@getdata')->name('emailTemplate.datatable');
        Route::post('active_inactive', 'EmailTemplateController@updateStatus')->name('emailTemplate.active_inactive');
        Route::post('multi_delete', 'EmailTemplateController@multidelete')->name('emailTemplate.multi_delete');
    });
    /**Admin profile route list */
    Route::group([ 'prefix' => 'profile','middleware' => ['auth:admin']], function () {
        Route::get('/','AdminController@profile')->name('profile');//->middleware(['permission:profile view']);
        Route::match(['post', 'PUT'], '/store/{id}','AdminController@updateProfile')->name('profile_update');//->middleware(['permission:profile update']);
    });
});
