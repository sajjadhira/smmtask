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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes(['verify' => true]);


// Route::get('/', function () {
//     return redirect('login');
// });

Route::get('clear', function () {
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
});



Route::get('api/{api}', 'HomeController@front');
Route::get('api/category/{category}/{api}', 'HomeController@category');
Route::get('api/product/{name}/{id}/{api}', 'HomeController@product');

Route::get('/', 'HomeController@front');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('sitemap.xml', 'DashboardController@index');
Route::get('dashboard', 'DashboardController@index');
Route::get('about-us', 'HomeController@about_us');
Route::get('contact-us', 'HomeController@contact_us');
Route::get('terms-and-conditions', 'HomeController@tos');
Route::get('privacy-policy', 'HomeController@privacy');

Route::get('reffer/{id}', 'HomeController@reffer');
Route::get('task/skip/{id}', 'UsersController@skipTask');


Route::get('task.js', 'UsersController@info');

// commerce routes
Route::get('category/{category}', 'HomeController@category');

Route::get('product/{name}/{id}', 'HomeController@product');

// cart add
Route::get('product/add-cart/{id}/{license}', 'HomeController@addToCart');

// cart removeing
Route::get('convert', 'UsersController@convertpoints');
Route::patch('user/convert/point/submit', 'UsersController@convertaction');

Route::get('withdraw', 'UsersController@withdraw');
Route::patch('withdraw-submit', 'UsersController@withdrawrequest');
Route::get('payment-method', 'UsersController@paymentmethod');
Route::patch('payment-method/update', 'UsersController@paymentmethodsave');

// publish task
Route::get('get/channel/information', 'UsersController@channel_info');

Route::get('dotasks', 'UsersController@dotask')->middleware('verified');
Route::get('mytasks', 'UsersController@mytask');
Route::get('newtask', 'UsersController@newtask');
Route::get('payments', 'UsersController@payments');
Route::patch('newtask/store', 'UsersController@storetask');
Route::get('mytasks/edit/{id}', 'UsersController@mytask_edit');
Route::patch('mytasks/update/{id}', 'UsersController@mytask_update');
Route::get('mytasks/status/{id}/{code}', 'UsersController@set_status');
// go to task

Route::get('go/task/{id}', 'UsersController@go');

// cart list
Route::get('cart', 'HomeController@cart');

// placinmg order
Route::get('place-order', 'HomeController@place_order');
Route::get('order/{id}', 'HomeController@order');
Route::get('claim/reward/{id}', 'UsersController@claim');
Route::get('invoice/{id}', 'HomeController@invoice');


// rating section
Route::get('item/rating/{id}', 'UsersController@ratings');
Route::patch('item/rating/submit/{id}', 'UsersController@submit_rating');


// user section

Route::get('orders', 'UsersController@my_orders');
Route::get('my-account', 'UsersController@my_account');


// balance deposit
Route::get('deposit', 'UsersController@deposit');
Route::patch('deposit-submit', 'UsersController@depositSubmit');
Route::get('deposit-preview', 'UsersController@depositPreview');
Route::get('deposit-confirm', 'UsersController@depositConfirm');
Route::get('deposit-success', 'UsersController@depositSuccess');

Route::get('verification', 'UsersController@verification');
Route::patch('verify', 'UsersController@verify');
Route::get('cupon', 'HomeController@get_cpoun_info');

Route::get('downloads', 'UsersController@downloads');
Route::get('my-items', 'UsersController@downloads');
Route::get('downloads/item/{license}', 'UsersController@downloads_item');

Route::get('dashboard/reports', 'ReportingController@index');


/* API */
Route::get('api/product-search', 'HomeController@products_find');


Route::get('settings', 'DashboardController@settings');
Route::patch('settings/update', 'DashboardController@settingsUpdate');

Route::get('dashboard/products', 'ProductsController@index');
Route::get('dashboard/products/create', 'ProductsController@create');
Route::patch('dashboard/products/store', 'ProductsController@store');
Route::get('dashboard/products/edit/{id}', 'ProductsController@edit');
Route::patch('dashboard/products/update/{id}', 'ProductsController@update');
Route::get('dashboard/invoices', 'InvoicesController@orders');
Route::get('dashboard/invoices/edit/{id}', 'InvoicesController@orders_edit');
Route::patch('dashboard/invoices/update/{id}', 'InvoicesController@order_update');
Route::get('dashboard/payment/confirm/{id}', 'InvoicesController@payment_done');

Route::get('dashboard/delivery-agents', 'DeliveryagentsController@index');
Route::get('dashboard/delivery-agents/create', 'DeliveryagentsController@create');
Route::patch('dashboard/delivery-agents/store', 'DeliveryagentsController@store');
Route::get('dashboard/delivery-agents/edit/{id}', 'DeliveryagentsController@edit');
Route::patch('dashboard/delivery-agents/update/{id}', 'DeliveryagentsController@update');


Route::get('dashboard/vendors', 'VendorsController@index');
Route::get('dashboard/vendors/create', 'VendorsController@create');
Route::patch('dashboard/vendors/store', 'VendorsController@store');
Route::get('dashboard/vendors/edit/{id}', 'VendorsController@edit');
Route::patch('dashboard/vendors/update/{id}', 'VendorsController@update');


Route::get('dashboard/expenditures', 'ExpensesController@index');
Route::get('dashboard/expenditures/create', 'ExpensesController@create');
Route::patch('dashboard/expenditures/store', 'ExpensesController@store');
Route::get('dashboard/expenditures/edit/{id}', 'ExpensesController@edit');
Route::patch('dashboard/expenditures/update/{id}', 'ExpensesController@update');

Route::get('dashboard/expenditures/categories', 'ExpensecategoriesController@index');
Route::get('dashboard/expenditures/categories/create', 'ExpensecategoriesController@create');
Route::patch('dashboard/expenditures/categories/store', 'ExpensecategoriesController@store');
Route::get('dashboard/expenditures/categories/edit/{id}', 'ExpensecategoriesController@edit');
Route::patch('dashboard/expenditures/categories/update/{id}', 'ExpensecategoriesController@update');

Route::get('dashboard/cupons', 'CuponsController@index');
Route::get('dashboard/cupons/create', 'CuponsController@create');
Route::patch('dashboard/cupons/store', 'CuponsController@store');
Route::get('dashboard/cupons/edit/{id}', 'CuponsController@edit');
Route::patch('dashboard/cupons/update/{id}', 'CuponsController@update');


Route::get('dashboard/categories', 'CategoriesController@index');
Route::get('dashboard/categories/create', 'CategoriesController@create');
Route::patch('dashboard/categories/store', 'CategoriesController@store');
Route::get('dashboard/categories/edit/{id}', 'CategoriesController@edit');
Route::patch('dashboard/categories/update/{id}', 'CategoriesController@update');


Route::get('dashboard/companies', 'CompaniesController@index');
Route::get('dashboard/companies/create', 'CompaniesController@create');
Route::patch('dashboard/companies/store', 'CompaniesController@store');
Route::get('dashboard/companies/edit/{id}', 'CompaniesController@edit');
Route::patch('dashboard/companies/update/{id}', 'CompaniesController@update');


Route::get('dashboard/subcategories', 'SubcategoriesController@index');
Route::get('dashboard/subcategories/create', 'SubcategoriesController@create');
Route::patch('dashboard/subcategories/store', 'SubcategoriesController@store');
Route::get('dashboard/subcategories/edit/{id}', 'SubcategoriesController@edit');
Route::patch('dashboard/subcategories/update/{id}', 'SubcategoriesController@update');


Route::get('dashboard/subcates/{id}', 'HomeController@get_subcategories');


Route::patch('images/store', 'ImagesController@store');
Route::get('images/edit/{id}', 'ImagesController@edit');
Route::patch('images/update/{id}', 'ImagesController@update');
Route::delete('images/destroy/{id}', 'ImagesController@destroy');

Route::get('dashboard/users', 'UsersController@index');
Route::get('dashboard/users/create', 'UsersController@create');
Route::get('dashboard/users/find', 'UsersController@find');
Route::patch('dashboard/users/store', 'UsersController@store');
Route::get('dashboard/users/edit/{id}', 'UsersController@edit');
Route::patch('dashboard/users/update/{id}', 'UsersController@update');
Route::delete('dashboard/users/destroy/{id}', 'UsersController@destroy');
Route::get('dashboard/users/{role}', 'UsersController@index');
Route::get('profile/update', 'UsersController@updateprofile')->name('updateprofile');
Route::patch('profile/update/store', 'UsersController@updatestore')->name('updatestore');

Route::get('reporting/adjust', 'ReportingController@adjust');
Route::get('transactions/generate', 'TransactionsController@generate');

Route::get('dashboard/transactions/{type}','TransactionsController@list');
Route::get('dashboard/transactions/payment/{id}/{status}','TransactionsController@payment_done');
Route::get('dashboard/transactions/{type}','TransactionsController@list');

Route::get('transactions','TransactionsController@index');
Route::get('transactions/pay/{id}','TransactionsController@pay');
Route::get('transactions/{type}','TransactionsController@index');
Route::patch('transactions/update/{id}', 'TransactionsController@update');
Route::get('transactions/{type}/{group}','TransactionsController@index');
Route::get('system/generate/payment','TransactionsController@generate');

