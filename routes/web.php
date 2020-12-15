<?php
use Illuminate\Support\Facades\Route;
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
/*
 * Admin Routes
*/



Route::post('/SetClientTimezoneSession', 'SetClientTimezoneSessionController@index')->name('SetClientTimezoneSession'); 
Route::prefix('admin')->group(function ()
{
    Route::middleware('auth:admin')->group(function ()
    {
        // Dashboard
        Route::get('/', 'DashboardController@index');
        // Logout
        Route::get('/logout', 'AdminUserController@logout')
            ->name('admin-logout');
        /*
         *
         *user and role mange mangement
         *
        */
        Route::get('/user_mangement', 'User_mangement\dashboardController@index')
            ->name('user_mangement_homepanel');


            Route::get('/getall_user_ajax', 'User_mangement\dashboardController@getall_user_ajax')
            ->name('getall_user_ajax');

           Route::post('/delete_user_ajax', 'User_mangement\CreateuserController@delete_user_ajax')->name('delete_user_ajax');

      Route::get('/edit_user_data{id}', 'User_mangement\CreateuserController@edit_user_data')->name('edit_user_data');

        Route::post('/role', 'User_mangement\RoleController@insert')
            ->name('insert_user_role');
        Route::get('role/delete/{id}', 'User_mangement\RoleController@destroy')
            ->name('delete_role');
        Route::post('role/edit/{id}', 'User_mangement\RoleController@update')
            ->name('edit_role');
        Route::post('/', 'User_mangement\CreateuserController@insert')
            ->name('insert_user');
        Route::post('addauthority', 'User_mangement\CreateuserController@add_authority')
            ->name('addauthority');
        Route::get('user/delete/{id}', 'User_mangement\CreateuserController@destroy')
            ->name('delete_user');
        Route::post('user/edit/{id}', 'User_mangement\CreateuserController@update')
            ->name('edit_user');
        Route::post('checkrole', 'User_mangement\CreateuserController@check_role')
            ->name('checkrole');
        Route::get('getauthority', 'User_mangement\dashboardController@get_authority')
            ->name('getauthority');
        Route::middleware('postTypeExist')->group(function ()
        {
            /*
             *
             *Auction And Auction item
             *
            */
            Route::get('/get_specific_Auctions_item_ajax', 'Auction\AuctionController@get_specific_Auctions_item_ajax')
                ->name('get_specific_Auctions_item_ajax');
            Route::get('/addItemFromAuction/{id}', 'Auction\AuctionController@addItemFromAuction')
                ->name('addItemFromAuction');
            Route::get('/ItemFromAuction/{id}', 'Auction\AuctionController@ItemFromAuction')
                ->name('ItemFromAuction');
            Route::get('/auction', 'Auction\AuctionController@index')
                ->name('auction_dashboard');
            Route::get('/getall_Auctions_ajax', 'Auction\AuctionController@getall_Auctions_ajax')
                ->name('getall_Auctions_ajax');
            Route::post('/delete_Auctions_ajax', 'Auction\AuctionController@delete_Auctions_ajax')
                ->name('delete_Auctions_ajax');
            Route::get('/addnew', 'Auction\AuctionController@addnew')
                ->name('auction_addnew');
            Route::get('/edit_auction/{id}', 'Auction\AuctionController@edit_auction')
                ->name('edit_auction');
            Route::post('/update_Auction', 'Auction\AuctionController@update_Auction')
                ->name('update_Auction');
            Route::post('/insert_Auction', 'Auction\AuctionController@insert_Auction')
                ->name('insert_Auction');


            Route::post('/get_specific_Auctions_Date_Time_ajax', 'Auction\AuctionController@get_specific_Auctions_Date_Time_ajax')
                ->name('get_specific_Auctions_Date_Time_ajax');



            Route::post('/get_Auctions_for_winner_ajax', 'Auction\AuctionController@get_Auctions_for_winner_ajax')
                ->name('get_Auctions_for_winner_ajax');
            //////////////////////////////////////////////////////////////////////////////////////////////////////
            /*
             *
             *Auction item
             *
            */
            Route::get('/auction_item', 'AuctionItems\AuctionItemController@index')
                ->name('auction_item_dashboard');
            Route::get('/getall_Auctions_item_ajax', 'AuctionItems\AuctionItemController@getall_Auctions_item_ajax') 
                ->name('getall_Auctions_item_ajax');
            Route::post('/delete_Auctions_item_ajax', 'AuctionItems\AuctionItemController@delete_Auctions_item_ajax')
                ->name('delete_Auctions_item_ajax');
            Route::get('/addnew_auction_item', 'AuctionItems\AuctionItemController@addnew_item')
                ->name('addnew_auction_item');
            Route::get('/edit_auction_item/{id}', 'AuctionItems\AuctionItemController@edit_auction_item')
                ->name('edit_auction_item');
            Route::get('/view_auction_item/{id}', 'AuctionItems\AuctionItemController@view_auction_item')
                ->name('view_auction_item');
   
            Route::post('/update_Auction_item', 'AuctionItems\AuctionItemController@update_Auction_item')
                ->name('update_Auction_item');

 
            

            Route::post('/insert_Auction_item', 'AuctionItems\AuctionItemController@insert_Auction_item')
                ->name('insert_Auction_item');
            //////////////////////////////////////////////////////////////////////////////////////////////////
            Route::get('/addnew_customField', 'CustomFields\AuctionCustomFieldController@addnew_customField')
                ->name('addnew_customField');
            Route::post('/insert_Auction_customField', 'CustomFields\AuctionCustomFieldController@insert_Auction_customField')
                ->name('insert_Auction_customField');
        });
        /*
         *
         *Auction Custom Fields And Post type
         *
        */
        Route::get('/acf', 'CustomFields\AuctionCustomFieldController@index')
            ->name('acf_dashboard');
        Route::get('/getall_Auctions_customFields_ajax', 'CustomFields\AuctionCustomFieldController@getall_Auctions_customFields_ajax')
            ->name('getall_Auctions_customFields_ajax');
        Route::post('/delete_Auctions_customfields_ajax', 'CustomFields\AuctionCustomFieldController@delete_Auctions_customfields_ajax')
            ->name('delete_Auctions_customfields_ajax');
        Route::get('/edit_auction_customFields/{id}', 'CustomFields\AuctionCustomFieldController@edit_auction_customFields')
            ->name('edit_auction_customFields');
        Route::get('/allposts', 'CustomFields\AuctionCustomFieldController@allposts')
            ->name('allposts');
        Route::get('/getall_post_ajax', 'CustomFields\AuctionCustomFieldController@getall_post_ajax')
            ->name('getall_post_ajax');
        Route::post('/delete_getall_post_ajax', 'CustomFields\AuctionCustomFieldController@delete_getall_post_ajax')
            ->name('delete_getall_post_ajax');
        Route::get('/add_post', 'CustomFields\AuctionCustomFieldController@add_post')
            ->name('add_post');
        Route::post('/insert_post', 'CustomFields\AuctionCustomFieldController@insert_post')
            ->name('insert_post');
        Route::post('/Update_Acf_fields', 'CustomFields\AuctionCustomFieldController@Update_Acf_fields')
            ->name('Update_Acf_fields');
        Route::post('/addnew_customFieldTo_Post_ajax', 'CustomFields\AuctionCustomFieldController@addnew_customFieldTo_Post_ajax')
            ->name('addnew_customFieldTo_Post_ajax');
        Route::post('/edit_customFieldTo_Post_ajax', 'CustomFields\AuctionCustomFieldController@edit_customFieldTo_Post_ajax')
            ->name('edit_customFieldTo_Post_ajax');
       
        //////////////////////////////////////////////////////////////////////////////////////////////////

   

   /*
             *
             *News Bolg 
             *
            */

  

   Route::get('/getallnews_admin', 'News\FrontNewsController@index')->name('getallnews_admin');
   Route::get('/getallnews_admin_ajax', 'News\FrontNewsController@getall_news_ajax')->name('getallnews_admin_ajax');
   Route::get('/addnews_admin', 'News\FrontNewsController@addnew')->name('addnews_admin');
   Route::post('/insertnews_admin', 'News\FrontNewsController@insert_news')->name('insertnews_admin');
   Route::get('/editnews_admin{id}', 'News\FrontNewsController@edit_news')->name('editnews_admin');
   Route::post('/updatenews_admin', 'News\FrontNewsController@update_news')->name('updatenews_admin');
   Route::post('/deletenews_admin_ajax', 'News\FrontNewsController@delete_news_ajax')->name('deletenews_admin_ajax');




     // *
     //         *
     //         *  Bid Admin 
     //        */

   

   Route::get('/bidAdmin', 'AdminBid\AdminBidController@index')->name('bidAdmin');
   Route::get('/bidAdmin_ajax', 'AdminBid\AdminBidController@bidAdmin_ajax')->name('bidAdmin_ajax');
 Route::post('/dataAjaxBiddingSelect2', 'AdminBid\AdminBidController@dataAjaxBiddingSelect2')->name('dataAjaxBiddingSelect2');

Route::get('/bidAdminEdit{id}', 'AdminBid\AdminBidController@bidAdminEdit')->name('bidAdminEdit');

Route::post('/bidAdminUpdate', 'AdminBid\AdminBidController@bidAdminUpdate')->name('bidAdminUpdate');

Route::post('/bidAdminDelete', 'AdminBid\AdminBidController@bidAdminDelete')->name('bidAdminDelete');


 Route::post('/dataAjaxAC_itemBiddingSelect2', 'AdminBid\AdminBidController@dataAjaxAC_itemBiddingSelect2')->name('dataAjaxAC_itemBiddingSelect2');


Route::post('/dataAjaxAC_itemChangeBiddingSelect2', 'AdminBid\AdminBidController@dataAjaxAC_itemChangeBiddingSelect2')->name('dataAjaxAC_itemChangeBiddingSelect2');

 
   /*
             *
             *Sucriber
             *
            */


   Route::get('/subscriber_admin', 'Subscriber\FrontSubscriberController@index')->name('subscriber_admin');

   Route::get('/subscriber_admin_ajax', 'Subscriber\FrontSubscriberController@subscriber_admin_ajax')->name('subscriber_admin_ajax');

   Route::get('/add_subscriber_admin', 'Subscriber\FrontSubscriberController@add_subscriber_admin')->name('add_subscriber_admin');
   Route::post('/insert_subscriber_admin', 'Subscriber\FrontSubscriberController@insert_subscriber_admin')->name('insert_subscriber_admin');

   Route::get('/edit_subscriber_admin{id}', 'Subscriber\FrontSubscriberController@edit_subscriber_admin')->name('edit_subscriber_admin');

   Route::post('/update_subscriber_admin', 'Subscriber\FrontSubscriberController@update_subscriber_admin')->name('update_subscriber_admin');

   Route::post('/delete_subscriber_admin_ajax', 'Subscriber\FrontSubscriberController@delete_subscriber_admin_ajax')->name('delete_subscriber_admin_ajax');
     
  

  Route::post('/sendmail_subscriber_admin_ajax', 'Subscriber\FrontSubscriberController@sendmail_subscriber_admin_ajax')->name('sendmail_subscriber_admin_ajax');





     /*
             *
             *Contact
             *
            */


   Route::get('/contact_admin', 'Contact\FrontContactController@index')->name('contact_admin');

   Route::get('/contact_admin_ajax','Contact\FrontContactController@contact_admin_ajax')->name('contact_admin_ajax');

   Route::get('/add_contact_admin','Contact\FrontContactController@add_contact_admin')->name('add_contact_admin');

   Route::post('/insert_contact_admin','Contact\FrontContactController@insert_contact_admin')->name('insert_contact_admin');

   Route::get('/edit_contact_admin{id}','Contact\FrontContactController@edit_contact_admin')->name('edit_contact_admin');

   Route::post('/update_contact_admin','Contact\FrontContactController@update_contact_admin')->name('update_contact_admin');

   Route::post('/delete_contact_admin_ajax','Contact\FrontContactController@delete_contact_admin_ajax')->name('delete_contact_admin_ajax');



 // Admin Auction Result
 Route::get('/auctionResult_admin_ajax','AuctionResultController@auctionResult_admin_ajax')->name('auctionResult_admin_ajax');




     // Admin GeneralsController
    Route::get('/generals','GeneralsController@index')->name('generals');


     Route::post('/setEnvironmentValueandGenerals','GeneralsController@setEnvironmentValueandGenerals')->name('setEnvironmentValueandGenerals');

 

    });

 


 


    // Admin Login
    Route::get('/login', 'AdminUserController@index')
        ->name('admin-login');
    Route::post('/login', 'AdminUserController@store')
        ->name('admin-loginAttempt');
}); 
/*
 * front End Routes
*/





Route::get('/', 'FrontHome\FrontHomeController@index')->name('front-home');

Route::group(['middleware' => 'checktimezoneset'], function () {

Route::post('/frontAuctionFilter', 'FrontHome\FrontHomeController@frontAuctionFilter')->name('frontAuctionFilter');


Route::get('/single-auction/{id}/type/{post_type}', 'FrontHome\FrontHomeController@single_auction')->name('single-auction');
 
Route::get('/single-auction-item/{id}/auctionId/{auctionId}/type/{post_type}', 'FrontHome\FrontHomeController@single_auction_item')->name('single-auction-item');

 Route::get('/news', 'FrontHome\FrontHomeController@news_frontend')->name('news');

 Route::get('/singlenews/{id}', 'FrontHome\FrontHomeController@single_news_frontend')->name('single_news_frontend');  

Route::post('/postContactFront', 'FrontHome\FrontHomeController@postContactFront')->name('postContactFront');

Route::post('/postSubscribeFront', 'FrontHome\FrontHomeController@postSubscribeFront')->name('postSubscribeFront');

Route::post('/postfilterFrontsSidebar', 'FrontHome\FrontHomeController@postfilterFrontsSidebar')->name('postfilterFrontsSidebar');


Route::post('/postfilterFrontsSingleac', 'FrontHome\FrontHomeController@postfilterFrontsSingleac')->name('postfilterFrontsSingleac');


Route::post('/Validate_Bidding_Conditions', 'Bid\FrontBidController@Validate_Bidding_Conditions')->name('Validate_Bidding_Conditions');


Route::post('/GO_Bidding', 'Bid\FrontBidController@GO_Bidding')->name('GO_Bidding');

Route::post('/GO_BiddingSendMails', 'Bid\FrontBidController@GO_BiddingSendMails')->name('GO_BiddingSendMails');

Route::post('/addWhishlist', 'WishlistController@addWhishlist')->name('addWhishlist');

Route::post('/remWhishlist', 'WishlistController@remWhishlist')->name('remWhishlist');

Route::get('/whishlist', 'Account\ProfileController@whishlist')->name('whishlist');



});





Route::get('/howTobid', 'HowToBidController@index')->name('bid');

Route::get('/contact', 'ContactusController@index')->name('contact');


 


Auth::routes(['verify' => true]); 
/*
 * front End Authenticated  Routes
*/





Route::get('/register', 'Auth\RegisterController@getRegister')
        ->name('register');

Route::middleware('auth')->group(function ()
{

Route::get('/myaccount','Account\ProfileController@index')->name('myaccount')->middleware('verified');
Route::post('/myaccountUpdate','Account\ProfileController@myaccountUpdate')->name('myaccountUpdate')->middleware('verified');

Route::get('/myaccountWinningBids','Account\ProfileController@myaccountWinningBids')->name('myaccountWinningBids')->middleware('verified');

Route::get('/myaccountWhereBids','Account\ProfileController@myaccountWhereBids')->name('myaccountWhereBids')->middleware('verified');

});




// Route::get('command', function () {
    

//     /* php artisan migrate */
//     \Artisan::call('config:cache');
//     \Artisan::call('route:clear');
//      \Artisan::call('cache:clear');
//        \Artisan::call('view:clear');
//    return 'done';
// });