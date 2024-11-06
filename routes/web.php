<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

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

Route::get('/', [
    'uses' => 'frontEndDataController@laodWelcomeData',
    'us' => 'laodWelcomeData'
])->name('welcome');

Route::get('/project/{id}/{title}', [
    'uses' => 'frontEndDataController@singleproject',
    'us' => 'singleproject'
])->name('project');

Route::get('/product/{id}/{title}', [
    'uses' => 'frontEndDataController@singleObjectSell',
    'us' => 'singleObjectSell'
])->name('singleObjectSell');

Route::get('/all-projects', [
    'uses' => 'frontEndDataController@allElearnings',
    'as' => 'learnings'
])->name('unprojects');


Route::get('/products', [
    'uses' => 'frontEndDataController@allSellObject',
    'as' => 'allSellObject'
])->name('allSellObject');

Route::get('/request-for-quotation', [
    'uses' => 'frontEndDataController@requestQuotation',
    'as' => 'requestQuotation'
])->name('rfq');

Route::get('/products/category/{id}/{name}', [
    'uses' => 'frontEndDataController@productByCategory',
    'as' => 'productByCategory'
])->name('productByCategory');


Route::get('/contact', [
    'uses' => 'frontEndDataController@contact',
    'as' => 'learnings'
])->name('contact');

Route::post("/postcontact", ['uses' => 'frontEndDataController@postcontact'])->name('postcontact');

Route::get('/search', ['uses' => 'frontEndDataController@search'])->name('search');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/intromanagement',
    ['uses' => 'frontEndDataController@renderIntroManagement']
)->name('mintro');
Route::post("/postnewsletter", ['uses' => 'frontEndDataController@postnewsletter'])->name('postnewsletter');

Route::post('/rfq/send', ['uses' => 'rfqController@store'])->name('rfqstore');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    /** dashboard management routes */
    Route::get("/dashboard", 'frontEndDataController@dashboard')->name("dashboard");

    /** Intro management routes */
    Route::post("/newintro", 'frontEndDataController@saveintro')->name("newintro");
    Route::post("/updateIntro", 'frontEndDataController@updateIntro')->name('updateIntro');
    Route::delete("/deleteIntro", 'frontEndDataController@deleteIntro')->name('deleteIntro');

    /** Services management routes */
    Route::get("/services", 'servicesController@index')->name('mServices');
    Route::post("/newservice", 'servicesController@store')->name("newservice");
    Route::post("/updateservice", 'servicesController@updateservice')->name('updateservice');
    Route::delete("/deleteservice", 'servicesController@deleteervice')->name('deleteervice');

    /** Projects management routes */
    Route::get("/projects", 'projectsController@index')->name('mProject');
    Route::post("/newProject", 'projectsController@store')->name("newProject");
    Route::post("/updateprojects", 'projectsController@updateproject')->name('updateproject');
    Route::delete("/deleteprojects", 'projectsController@deleteProject')->name('deleteProject');

    /** Row sections management routes */
    Route::get("/rowsection", 'rowSectionController@index')->name('rowsection');
    Route::post("/newrowsection", 'rowSectionController@store')->name("newrowsection");
    Route::post("/updaterowsection", 'rowSectionController@update')->name('updaterowsection');
    Route::delete("/deleterowsection", 'rowSectionController@deleteRowService')->name('deleteRowService');

    /** Object sells management routes */
    Route::get("/sellobject", 'sellobjectController@index')->name('sellobject');
    Route::post("/newsellobject", 'sellobjectController@newsellobject')->name("newsellobject");
    Route::post("/updateellobject", 'sellobjectController@updateellobject')->name("updateellobject");
    //updateellobject
    Route::post("/newpps", 'sellobjectController@newpps')->name("newpps");

    Route::post("/updatesellobject", 'sellobjectController@updatesellobject')->name('updatesellobject');
    Route::delete("/deleteObj", 'sellobjectController@deleteObj')->name('deleteObj');
    Route::post("/updateplan", 'sellobjectController@updateplan')->name('updateplan');
    Route::post("/deletepp", 'sellobjectController@deletepp')->name('deletepp');


    /** Categpries management routes */
    Route::get("/categories", 'categoriesController@index')->name('mcategories');
    Route::post("/newCategory", 'categoriesController@newCategory')->name("newCategory");
    Route::post("/updateCategory", 'categoriesController@updateCategory')->name('updateCategory');
    Route::delete("/deleteCategory", 'categoriesController@deletCategory')->name('deletCategory');

    /** Customers management routes */
    Route::get("/customers", 'customerController@index')->name('mcustomers');
    Route::post("/newCustomer", 'customerController@newCustomer')->name("newCustomer");
    Route::post("/updateCustomer", 'customerController@updateCustomer')->name('updateCustomer');
    Route::delete("/deleteCustomer", 'customerController@deletCustomer')->name('deletCustomer');


    /** msettings */
    Route::get("/msettings", 'settingsController@index')->name('msettings');
    Route::post("/updateSettings", 'settingsController@updateSettings')->name('updateSettings');

    /**  */
});
