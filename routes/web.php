<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'locale'], function () {

    Route::get('change-language/{lang}', 'IndexController@getChangeLanguage')->name('home.change-language');

    Route::get('/', 'IndexController@getHome')->name('home.index');

    Route::get('/ve-chung-toi', 'IndexController@getListAbout')->name('home.about');

    Route::get('/faqs', 'IndexController@getListFaq')->name('home.faqs');

    Route::get('/danh-muc-san-pham/{slug}', 'IndexController@getCatetoryProducts')->name('home.category-product');

    Route::get('/san-pham/{slug}', 'IndexController@getSingleProduct')->name('home.SingleProduct');

    Route::get('/san-pham', 'IndexController@getListProducts')->name('home.product');

    Route::get('/tuyen-dung/{slug}', 'IndexController@getSingleRecruitment')->name('home.single-recruitment');

    Route::get('/tuyen-dung', 'IndexController@getListRecruitment')->name('home.recruitment');

    Route::get('/danh-muc-tuyen-dung/{slug}', 'IndexController@getCategoryRecruitment')->name('home.category-recruitment');

    Route::get('/ung-tuyen/{slug}', 'IndexController@getFormRecruitment')->name('home.form-recruitment');

    Route::post('/ung-tuyen', 'IndexController@postRecruitment')->name('home.post-recruitment');

    Route::get('/tin-tuc', 'IndexController@getListNew')->name('home.news');

    Route::get('/tin-tuc/{slug}', 'IndexController@getSingleNews')->name('home.single-news');

    Route::get('/lien-he', 'IndexController@getContact')->name('home.contact');

    Route::post('/lien-he', 'IndexController@postContact')->name('home.post-contact');

    Route::post('/contact', 'IndexController@postContactAll')->name('home.post-contact-all');

    Route::post('/san-pham', 'IndexController@postContactProduct')->name('home.post-contact-product');

    Route::get('/trang-cam-on', 'IndexController@pageThanks')->name('home.page-thanks');

    Route::post('/dang-ky', 'IndexController@postRegistration')->name('home.post-registration');

    Route::post('/dang-nhap', 'IndexController@postLogin')->name('home.login');

    Route::get('/dang-xuat', 'IndexController@postLogout')->name('home.logout');

    Route::get('/quan-ly-tai-khoan', 'IndexController@manageAccount')->name('home.manage-account');

    Route::post('/quan-ly-tai-khoan', 'IndexController@postManageAccount')->name('home.post-manage-account');

    Route::post('/thay-doi-mat-khau', 'IndexController@postChangePassword')->name('home.post-change-password');

    Route::get('/tim-kiem-don-hang', 'IndexController@searchOrder')->name('home.search-order');

    Route::get('/tim-kiem', 'IndexController@searchAll')->name('home.search-all');

    Route::post('quen-mat-khau', 'IndexController@sendForgotPassword')->name('home.send-forgot-password');

    Route::get('/resetPassword/{token}', 'IndexController@resetPassword')->name('home.resetPassword');

    Route::post('/new-password', 'IndexController@newPassword')->name('home.new-password');

    Route::post('/dat-hang', 'IndexController@postOrder')->name('home.post-order');

    Route::get('/thong-bao', 'IndexController@getNotifications')->name('home.notifications');

    Route::get('/chinh-sach-bao-mat', 'IndexController@getPrivacyPolicy')->name('home.privacy-policy');

    Route::get('/du-an', 'IndexController@getListProject')->name('home.projects');

    Route::get('/du-an/{slug}', 'IndexController@getSingleProject')->name('home.single-project');

    Route::get('/truyen-thong', 'IndexController@getListMedia')->name('home.media');

    Route::get('/truyen-thong/{slug}', 'IndexController@getSingleMedia')->name('home.single-media');

    Route::get('/download', 'IndexController@getListDownload')->name('home.download');

    Route::get('/download/{slug}', 'IndexController@getSingleDownload')->name('home.single-download');

});


Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        Route::resource('image', 'ImageController', ['except' => [
            'show'
        ]]);
        Route::post('image/postMultiDel', ['as' => 'image.postMultiDel', 'uses' => 'ImageController@deleteMuti']);

        // tuyển dụng
        Route::resource('recruitment', 'RecruitmentController', ['except' => ['show']]);
        Route::post('recruitment/postMultiDel', ['as' => 'recruitment.postMultiDel', 'uses' => 'RecruitmentController@deleteMuti']);
        Route::get('recruitment/get-slug', 'RecruitmentController@getAjaxSlug')->name('recruitment.get-slug');

        Route::resource('categories-recruitment', 'CategoriesRecruitmentController', ['except' => ['show']]);

        // Bài viết
        Route::resource('posts', 'PostController', ['except' => ['show']]);
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');
        

        // Sản phẩm
        Route::resource('products', 'ProductController', ['except' => ['show']]);
        Route::post('products/postMultiDel', ['as' => 'products.postMultiDel', 'uses' => 'ProductController@deleteMuti']);
        Route::get('products/get-slug', 'ProductController@getAjaxSlug')->name('products.get-slug');

        Route::resource('category', 'CategoryController', ['except' => ['show']]);

        // Dự án
        Route::resource('projects', 'ProjectController', ['except' => ['show']]);
        Route::post('projects/postMultiDel', ['as' => 'projects.postMultiDel', 'uses' => 'ProjectController@deleteMuti']);
        Route::get('projects/get-slug', 'ProjectController@getAjaxSlug')->name('projects.get-slug');

        // Truyền thông
        Route::resource('media', 'MediaController', ['except' => ['show']]);
        Route::post('media/postMultiDel', ['as' => 'media.postMultiDel', 'uses' => 'MediaController@deleteMuti']);
        Route::get('media/get-slug', 'MediaController@getAjaxSlug')->name('media.get-slug');

        // Download
        Route::resource('downloads', 'DownloadsController', ['except' => ['show']]);
        Route::post('downloads/postMultiDel', ['as' => 'downloads.postMultiDel', 'uses' => 'DownloadsController@deleteMuti']);
        Route::get('downloads/get-slug', 'DownloadsController@getAjaxSlug')->name('downloads.get-slug');
        
        // Đơn ứng tuyển
        Route::group(['prefix' => 'apply-job'], function() {
            Route::get('/', ['as' => 'get.list.job', 'uses' => 'ApplyJobController@getList']);
            Route::get('edit/{id}', ['as' => 'get.edit.job', 'uses' => 'ApplyJobController@getEdit']);
            Route::post('edit/{id}', ['as' => 'post.edit.job', 'uses' => 'ApplyJobController@postEdit']);
            Route::post('/delete-muti', ['as' => 'apply-job.postMultiDel', 'uses' => 'ApplyJobController@postDeleteMuti']);
            Route::delete('{id}/delete', ['as' => 'apply-job.destroy', 'uses' => 'ApplyJobController@getDelete']);
        });

        // FAQs
        Route::resource('faqs', 'FaqsController', ['except' => ['show']]);
        Route::post('faqs/postMultiDel', ['as' => 'faqs.postMultiDel', 'uses' => 'FaqsController@deleteMuti']);

        // Thông báo
        Route::resource('notifications', 'NotificationsController', ['except' => ['show']]);
        Route::post('notifications/postMultiDel', ['as' => 'notifications.postMultiDel', 'uses' => 'NotificationsController@deleteMuti']);

        Route::get('/notification', 'NotificationsController@notification')->name('notification');
        Route::post('/store-token', 'NotificationsController@storeToken')->name('store.token');
        Route::post('/send-web-notification', 'NotificationsController@sendWebNotification')->name('send.web-notification');
        
        // Liên hệ
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'get.list.contact', 'uses' => 'ContactController@getListContact']);
            Route::post('/delete-muti', ['as' => 'contact.postMultiDel', 'uses' => 'ContactController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@getEdit']);
            Route::post('{id}/edit', ['as' => 'contact.post', 'uses' => 'ContactController@postEdit']);
            Route::delete('{id}/delete', ['as' => 'contact.destroy', 'uses' => 'ContactController@getDelete']);
        });

        // Đăng ký đại lý
        Route::group(['prefix' => 'register'], function () {
            Route::get('/', ['as' => 'get.list.register', 'uses' => 'RegisterController@getListRegister']);
            Route::post('/delete-muti', ['as' => 'register.postMultiDel', 'uses' => 'RegisterController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'register.edit', 'uses' => 'RegisterController@getEdit']);
            Route::post('{id}/edit', ['as' => 'register.post', 'uses' => 'RegisterController@postEdit']);
            Route::delete('{id}/delete', ['as' => 'register.destroy', 'uses' => 'RegisterController@getDelete']);
        });

        // Đơn hàng
        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', ['as' => 'order.index', 'uses' => 'OrdersController@getList']);
            Route::get('edit/{id}', ['as' => 'order.edit', 'uses' => 'OrdersController@getEdit']);
            Route::post('edit/{id}', ['as' => 'order.edit.post', 'uses' => 'OrdersController@postEdit']);
            Route::delete('delete/{id}', ['as' => 'order.destroy', 'uses' => 'OrdersController@postDelete']);
            Route::post('delete-multi', ['as' => 'order.postMultiDel', 'uses' => 'OrdersController@deleteMuti']);
        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/developer-config', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

        Route::group(['prefix' => 'backup'], function() {
            Route::get('/', ['as' => 'setting.backup', 'uses' => 'BackupController@getBackup']);
            Route::get('/backup-source', ['as' => 'setting.backup-source', 'uses' => 'BackupController@backupSource']);
            Route::post('/backup-db', ['as' => 'setting.backup-db', 'uses' => 'BackupController@backupDB']);
            Route::delete('delete/{id}', ['as' => 'setting.destroy.backup', 'uses' => 'BackupController@destroy']);

        });

        /* Route thành viên */
        Route::resource('account', 'AccountController', ['except' => ['show']]);
        Route::get('account/lock/{id}', 'AccountController@lockMember')->name('account.lock');
        Route::get('account/unlock/{id}', 'AccountController@unlocklockMember')->name('account.unlock');
        Route::get('account/detail/{id}', 'AccountController@accountDetail')->name('account.detail');

       Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');


    });
});

Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);
