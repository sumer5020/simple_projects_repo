<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\CatiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GovController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotifiController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferRequestController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes(/*['verify' => true]*/);
/*
|--------------------------------------------------------------------------
| Get Methods
|--------------------------------------------------------------------------
*/
Route::get('PrivacyPolicy',function(){
    return view('components.Policy.index');
})->name('PrivacyPolicy');

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Route::get('language/{language}', [App\Http\Controllers\HomeController::class, 'language'])->name('language');
Route::get('/admin', [App\Http\Controllers\UserController::class, 'admin'])->name('admin');
Route::get('portfolio/more/{portfolio}', [App\Http\Controllers\PortfolioController::class, 'more'])->name('more');
Route::get('/supperAdmin', [App\Http\Controllers\UserController::class, 'supperAdmin'])->name('supperAdmin');
Route::get('/usersReport', [App\Http\Controllers\importExportController::class, 'usersReport'])->name('usersReport');

/*
|--------------------------------------------------------------------------
| Post Methods
|--------------------------------------------------------------------------
*/
Route::post('cardDestroySome', [App\Http\Controllers\CardsController::class, 'destroySome'])->name('cardDestroySome');
Route::post('portfolioDestroySome', [App\Http\Controllers\PortfolioController::class, 'destroySome'])->name('portfolioDestroySome');
Route::post('offerDestroySome', [App\Http\Controllers\OfferController::class, 'destroySome'])->name('offerDestroySome');
Route::post('countryDestroySome', [App\Http\Controllers\CountryController::class, 'destroySome'])->name('countryDestroySome');
Route::post('govDestroySome', [App\Http\Controllers\GovController::class, 'destroySome'])->name('govDestroySome');
Route::post('catiDestroySome', [App\Http\Controllers\CatiController::class, 'destroySome'])->name('catiDestroySome');
Route::post('chatDestroySome', [App\Http\Controllers\ChatController::class, 'destroySome'])->name('chatDestroySome');
Route::post('offerRequestDestroySome', [App\Http\Controllers\OfferRequestController::class, 'destroySome'])->name('offerRequestDestroySome');
Route::post('chatMessageDestroySome', [App\Http\Controllers\ChatMessageController::class, 'destroySome'])->name('chatMessageDestroySome');
Route::post('provDestroySome', [App\Http\Controllers\UserController::class, 'aDestroySome'])->name('provDestroySome');
Route::post('customerDestroySome', [App\Http\Controllers\UserController::class, 'cDestroySome'])->name('customerDestroySome');
Route::post('portfolioRate', [App\Http\Controllers\PortfolioController::class, 'rate'])->name('portfolioRate');
Route::post('offerNotify', [App\Http\Controllers\NotifiController::class, 'offerNotify'])->name('offerNotify');
Route::post('govsOfCountry', [App\Http\Controllers\ProfileController::class, 'govsOfCountry'])->name('govsOfCountry');
Route::post('rates', [App\Http\Controllers\HomeController::class, 'rates'])->name('rates');
Route::post('Messaging', [App\Http\Controllers\ChatController::class, 'messaging'])->name('Messaging');
Route::post('fresh', [App\Http\Controllers\ChatMessageController::class, 'fresh'])->name('fresh');
Route::post('Adminfresh', [App\Http\Controllers\ChatMessageController::class, 'Adminfresh'])->name('Adminfresh');
Route::post('getIdMessage', [App\Http\Controllers\ChatMessageController::class, 'getIdMessage'])->name('getIdMessage');
Route::post('freshCounts', [App\Http\Controllers\ChatMessageController::class, 'freshCounts'])->name('freshCounts');
Route::post('addfollow', [App\Http\Controllers\ContactController::class, 'addfollow'])->name('addfollow');

/*
|--------------------------------------------------------------------------
| Import and Export
|--------------------------------------------------------------------------
*/
//Export Excel
Route::get('userExport/{filter}', [App\Http\Controllers\importExportController::class, 'userExport'])->name('userExport');
Route::get('offerExport/{filter}', [App\Http\Controllers\importExportController::class, 'offerExport'])->name('offerExport');
Route::get('chatBotExport/{filter}', [App\Http\Controllers\importExportController::class, 'chatBotExport'])->name('chatBotExport');
Route::get('contentExport/{filter}', [App\Http\Controllers\importExportController::class, 'contentExport'])->name('contentExport');

//Import Excel
Route::post('userImport', [App\Http\Controllers\importExportController::class, 'userImport'])->name('userImport');

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
*/
Route::resource('portfolio', PortfolioController::class);
Route::resource('blog', BlogController::class);
Route::resource('chat', ChatController::class);
Route::resource('chat_message', ChatMessageController::class);
Route::resource('Cards', CardsController::class);
Route::resource('home', HomeController::class);
Route::resource('offer_request', OfferRequestController::class);
Route::resource('notifi', NotifiController::class);
Route::resource('offer', OfferController::class);
Route::resource('profile', ProfileController::class);
Route::resource('contact', ContactController::class);
Route::resource('cati', CatiController::class);
Route::resource('country', CountryController::class);
Route::resource('gov', GovController::class);
Route::resource('user', UserController::class);

