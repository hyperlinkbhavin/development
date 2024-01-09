<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\{AdminAuthController,DashboardConroller,CustomerController,ServiceProviderController,faqcontroller,PageController,ContactUsController,AdvertiseController,ServiceCatController,SubCatController,StoryReelController,NotificationController,CoinsController,SubAdminControllr,ChatController,Servicecontroller};
use App\Http\Controllers\ForgotPasswordController;

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

Route::get('/view', [ForgotPasswordController::class,'view'])->name('view');
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/newUser', [ForgotPasswordController::class, 'newUser'])->name('newUser');
Route::Post('/addUserData', [ForgotPasswordController::class, 'addUserData'])->name('addUserData');
Route::get('/thankyou', [ForgotPasswordController::class, 'thankyou'])->name('thankyou');
     
     
   //Route::get('/new-user', [AdminAuthController::class, 'newUser'])->name('newUser');
         
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // Route::middleware(['web', 'auth:admin'])->group(function () 
       
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logout', [AdminAuthController::class,'Logout'])->name('Logout');

    Route::group(['middleware' => 'adminauth'], function () {

        Route::get('/dashboard', [DashboardConroller::class, 'index'])->name('dashboard');
        // Route::get('/date','date');
        
        //manage profile details
        Route::get('/profile_details', [AdminAuthController::class,'profile_detail'])->name('profile_details');
        Route::get('/profile', [AdminAuthController::class,'profile'])->name('profile');
        Route::get('/profile_edit/{id}', [AdminAuthController::class,'profile_edit'])->name('profile_edit');
        Route::post('/profile_update', [AdminAuthController::class, 'profile_update'])->name('profile_update');

        // change password
         Route::get('/change_password', [AdminAuthController::class,'change_password'])->name('change_password');
         Route::post('/update_password', [AdminAuthController::class,'update_password'])->name('update_password');

        //manage coustomer
        Route::get('/customers', [CustomerController::class, 'customers'])->name('customers');
        Route::get('/view_user_data/{id}', [CustomerController::class, 'viewUserData'])->name('view_user_data');
        Route::post('/User_Status', [CustomerController::class,'change_User_status'])->name('User_Status');
        Route::get('/video_delete/{id}', [CustomerController::class,'delete_customer'])->name('video_delete');
        Route::post('/User_block_Status', [CustomerController::class,'change_block_status'])->name('User_block_Status');
        Route::get('/customer_edit/{id}', [CustomerController::class, 'customer_edit'])->name('customer_edit');
        Route::post('/update_customer', [CustomerController::class, 'update_customer'])->name('update_customer');


        //service provider 
        Route::get('/service_provider', [ServiceProviderController::class, 'service_provider'])->name('service_provider');
        Route::post('/service_provider_filter', [ServiceProviderController::class,'service_provider_filter'])->name('service_provider_filter');

        Route::get('/view_provider_data/{id}', [ServiceProviderController::class, 'view_provider_data'])->name('view_provider_data');
        Route::post('/provider_Status', [ServiceProviderController::class,'provider_Status'])->name('provider_Status');
        Route::post('/provider_Approve', [ServiceProviderController::class,'provider_Approve'])->name('provider_Approve');
        Route::get('/provider_delete/{id}', [ServiceProviderController::class,'provider_delete'])->name('provider_delete');
        Route::post('/provider_list', [ServiceProviderController::class,'provider_list'])->name('provider_list');
        Route::post('/provider_business_list', [ServiceProviderController::class,'provider_business_list'])->name('provider_business_list');
        Route::post('/provider_time_view', [ServiceProviderController::class,'provider_time_view'])->name('provider_time_view');
        Route::get('/provider_time/{id}', [ServiceProviderController::class,'provider_time'])->name('provider_time');
        Route::get('/close_time', [ServiceCatController::class, 'close_time'])->name('close_time');
        Route::get('/provider_edit/{id}', [ServiceProviderController::class, 'provider_edit'])->name('provider_edit');
        Route::post('/update_provider', [ServiceProviderController::class, 'update_provider'])->name('update_provider');


        Route::get('/business_edit/{id}', [ServiceProviderController::class, 'business_edit'])->name('business_edit');
        Route::post('/update_business', [ServiceProviderController::class, 'update_business'])->name('update_business');
        
        Route::get('/provider_images/{id}', [ServiceProviderController::class,'provider_images'])->name('provider_images');
        Route::post('/change_provider_status', [CustomerController::class,'change_provider_status'])->name('change_provider_status');

        Route::view('access_denied','access_denied');
        Route::view('send_n_d','send_n_d');
        Route::view('admin_contact','admin_contact')->name('admin_contact');

        //service
        Route::get('/service_list', [Servicecontroller::class,'service_list'])->name('service_list');
        Route::post('/date_filter', [Servicecontroller::class,'date_filter'])->name('date_filter');
        Route::get('/review/{id}', [Servicecontroller::class,'review'])->name('review');

        
        //service categories
        Route::get('/service_categories', [ServiceCatController::class, 'service_categories'])->name('service_categories');
        Route::get('/view_image/{img}', [ServiceCatController::class, 'view_image'])->name('view_image');

        Route::get('/view_categories_data/{id}', [ServiceCatController::class, 'view_categories_data'])->name('view_categories_data');
        Route::get('/categories_delete/{id}', [ServiceCatController::class,'categories_delete'])->name('categories_delete');
        Route::post('/categories_Status', [ServiceCatController::class,'categories_Status'])->name('categories_Status');
        Route::get('/categories_edit/{id}', [ServiceCatController::class, 'categories_edit'])->name('categories_edit');
        Route::post('/update_categories', [ServiceCatController::class, 'update_categories'])->name('update_categories');
        Route::get('/add_cat',[ServiceCatController::class, 'add_cat'])->name('add_cat');
        Route::post('/add_categories', [ServiceCatController::class, 'add_categories'])->name('add_categories');


        //service sub category
        Route::get('/service_subcategories', [SubCatController::class, 'service_subcategories'])->name('service_subcategories');
        Route::get('/view_subcategories_data/{id}', [SubCatController::class, 'view_subcategories_data'])->name('view_subcategories_data');
        Route::get('/subcategories_delete/{id}', [SubCatController::class,'subcategories_delete'])->name('subcategories_delete');
        Route::post('/subcategories_Status', [SubCatController::class,'subcategories_Status'])->name('subcategories_Status');
        Route::get('/subcategories_edit/{id}', [SubCatController::class, 'subcategories_edit'])->name('subcategories_edit');
        Route::post('/update_subcategories', [SubCatController::class, 'update_subcategories'])->name('update_subcategories');
        Route::get('/add_subcat',[SubCatController::class, 'add_subcat'])->name('add_subcat');
        Route::post('/add_subcategories', [SubCatController::class, 'add_subcategories'])->name('add_subcategories');

        //manage chat
        Route::get('/manage_chat', [ChatController::class, 'manage_chat'])->name('manage_chat');
        Route::get('/chat_view/{chat_id}', [ChatController::class, 'chat_view'])->name('chat_view');


        //manage advertisements
        Route::get('/advertisement_list', [AdvertiseController::class,'advertisement_list'])->name('advertisement_list');
        Route::get('/view_advertisements_data/{id}', [AdvertiseController::class, 'view_advertisements_data'])->name('view_advertisements_data');
        Route::get('/advertisement_edit/{id}', [AdvertiseController::class, 'advertisement_edit'])->name('advertisement_edit');
        Route::post('/update_advertisement', [AdvertiseController::class, 'update_advertisement'])->name('update_advertisement');
        Route::post('/advertisement_Status', [AdvertiseController::class,'advertisement_Status'])->name('advertisement_Status');
        Route::get('/advertisements_delete/{id}', [AdvertiseController::class,'advertisements_delete'])->name('advertisements_delete');
        Route::get('/add_advertisements',[AdvertiseController::class, 'add_advertisements'])->name('add_advertisements');
        Route::post('/add_data', [AdvertiseController::class, 'add_data'])->name('add_data');

        //notification
        Route::get('/view_notification', [NotificationController::class,'view_notification'])->name('view_notification');
        Route::post('/store', [NotificationController::class,'store'])->name('store');
        Route::post('/get_notification', [NotificationController::class,'get_notification'])->name('get_notification');
        Route::post('/get_data', [NotificationController::class,'get_data'])->name('get_data');
        Route::post('/get_provider_data', [NotificationController::class,'get_provider_data'])->name('get_provider_data');
        Route::post('/get_provider_notification', [NotificationController::class,'get_provider_notification'])->name('get_provider_notification');
        Route::get('/view_customer_notification/{id}', [NotificationController::class,'view_customer_notification'])->name('view_customer_notification');
        Route::post('/customer_notification_table', [NotificationController::class,'customer_notification_table'])->name('customer_notification_table');
        Route::post('/provider_notification_table', [NotificationController::class,'provider_notification_table'])->name('provider_notification_table');
        Route::get('/view_provider_notification/{id}', [NotificationController::class,'view_provider_notification'])->name('view_provider_notification');
        
           
        //manage Reels
        Route::get('/reel_list', [StoryReelController::class,'reel_list'])->name('reel_list');
        Route::get('/view_reel/{id}', [StoryReelController::class, 'view_reel'])->name('view_reel');
        Route::get('/reel_delete/{id}', [StoryReelController::class,'reel_delete'])->name('reel_delete');
        Route::post('/reel_Status', [StoryReelController::class,'reel_Status'])->name('reel_Status');

        //FAQ's
        Route::get('/faqlist',[faqcontroller::class,'faqlist'])->name('faqlist');
        Route::get('/faq_view/{id}',[faqcontroller::class,'view_faq'])->name('faq_view');
        Route::get('/add_faq',[faqcontroller::class, 'add_faq'])->name('add_faq');
        Route::post('/add_post_faq', [faqcontroller::class, 'add_post_faq'])->name('add_post_faq');
        Route::get('/edit_faq/{id}', [faqcontroller::class, 'edit_faq'])->name('edit_faq');
        Route::post('/update_post_faq', [faqcontroller::class, 'update_post_faq'])->name('update_post_faq');
        Route::get('/delete_faq/{id}', [FaqController::class, 'delete_faq'])->name('delete_faq');

         //contact us
         Route::get('/contactus', [ContactUsController::class,'contactus'])->name('contactus');
         Route::get('/contactusview/{id}', [ContactUsController::class,'contactusview'])->name('contactusview');
         Route::post('/contactus_status', [ContactUsController::class,'contactus_status'])->name('contactus_status');
         Route::post('/closed_status', [ContactUsController::class,'closed_status'])->name('closed_status');
         Route::get('/contactus_mail_view/{id}', [ContactUsController::class,'contactus_mail_view'])->name('contactus_mail_view');
         Route::post('/send_mail', [ContactUsController::class,'send_mail'])->name('send_mail');


        //about us
        Route::get('aboutus', [PageController::class, 'aboutus'])->name('aboutus');
        Route::post('update_page', [PageController::class, 'update_page'])->name('update_page');
      
        //terms_and_condition
        Route::get('terms_and_condition', [PageController::class, 'terms_and_condition'])->name('terms_and_condition');
      
        //priacy policy
        Route::get('privacy_policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');

       // coins
       Route::get('/view_coins', [CoinsController::class,'view_coins'])->name('view_coins');
       Route::post('/update_coins', [CoinsController::class,'update_coins'])->name('update_coins');


       //sub admin 
       Route::get('/view_page',[SubAdminControllr::class,'view_page'])->name('view_page');
       Route::get('/view_admin_list',[SubAdminControllr::class,'view_admin_list'])->name('view_admin_list');
       Route::post('/add_sub_admin',[SubAdminControllr::class,'add_sub_admin'])->name('add_sub_admin');
       Route::post('/subadmin_Status', [SubAdminControllr::class,'subadmin_Status'])->name('subadmin_Status');
       Route::get('/permissions/{id}',[SubAdminControllr::class,'permissions'])->name('permissions');
       Route::post('store_permissions/{id}', [SubAdminControllr::class, 'store_permissions'])->name('store_permissions');
       Route::get('/subadmin_delete/{id}', [SubAdminControllr::class,'subadmin_delete'])->name('subadmin_delete');

       
    });
});


