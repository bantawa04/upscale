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
// Route::group(['prefix' => 'manage/laravel-filemanager', 'middleware' => ['auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
 Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
 });
Route::prefix('manage')->group(function () {
    Auth::routes(['register' => false]);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('carousel', 'CarouselsController');
        Route::resource('media', 'MediaController');
        Route::resource('accomodation', 'AccomodationController');
        Route::resource('meal', 'MealController');
        Route::resource('difficulty', 'DifficultyController');
        Route::resource('group', 'GroupController');
        Route::resource('include', 'IncludeController');
        Route::resource('exclude', 'ExcludeController');
        Route::resource('country', 'CountryController');
        Route::resource('tour-category', 'TourCategoryController');
        Route::resource('region', 'RegionController');
        Route::resource('location', 'LocationController');
        Route::resource('setting', 'SettingController');
        Route::resource('tour', 'TourController');
        Route::PUT('tour/publish/{publish}', 'TourController@publish');
        Route::PUT('tour/unpublish/{publish}', 'TourController@unpublish');
        Route::PUT('tour/feature/{feature}', 'TourController@feature');
        Route::PUT('tour/remove-feature/{feature}', 'TourController@removeFeature');
        Route::get('tours/promote', 'TourController@getPromoteds')->name('tour.promote');
        Route::PUT('tours/promote', 'TourController@promoteTour')->name('promote.store');
        Route::PUT('tours/remove-promote/{id}', 'TourController@removePromote')->name('promote.remove');
        
        Route::resource('page', 'PageController');
        Route::PUT('page/publish/{publish}', 'PageController@publish');
        Route::PUT('page/unpublish/{publish}', 'PageController@unpublish');

        Route::resource('departure', 'DepartureController');
        Route::delete('tour/departure/{tour}', 'DepartureController@deleteAll')->name('departure.delete');

        Route::get('tour/{id}/itinerary', 'ItineraryController@index')->name('itinerary.index');
        Route::post('tour/itinerary/store', 'ItineraryController@store')->name('itinerary.store');
        Route::delete('itinerary/{itinerary}', 'ItineraryController@destroy')->name('itinerary.destroy');
        Route::get('{id}/itinerary/{itinerary}', 'ItineraryController@edit')->name('itinerary.edit');
        Route::PUT('itinerary/{itinerary}', 'ItineraryController@update')->name('itinerary.update');

        Route::resource('blog-category', 'BlogCategoryController');
        Route::resource('tag', 'TagController');

        Route::resource('post', 'PostController');
        Route::PUT('post/publish/{publish}', 'PostController@publish');
        Route::PUT('post/unpublish/{publish}', 'PostController@unpublish');
        Route::PUT('post/feature/{feature}', 'PostController@feature');
        Route::PUT('post/remove-feature/{feature}', 'PostController@removeFeature');

        Route::resource('team', 'TeamController');
        Route::resource('type', 'TypeController');

        Route::resource('review', 'ReviewController');
        Route::get('review/approve/{slug}/{id}', 'ReviewController@approve')->name('review.approve');

        Route::resource('faq', 'FAQController');
        Route::resource('recommended', 'RecommendedController');

        // Route::get('profile/{profile}', 'ProfilesController@show')->name('profile.show');
        // Route::get('profile/{profile}/edit', 'ProfilesController@edit')->name('profile.edit');
        // Route::PATCH('profile/{profile}', 'ProfilesController@update')->name('profile.update');
        Route::resource('profile', 'ProfilesController');
        Route::resource('links', 'LinksController');
        Route::resource('newsletter', 'NewsletterController',['only' => ['index','destroy']]);
    });
});

Route::middleware('web')->group(function () {
    // Route::get('/lead', 'FrontendController@lead')->name('lead');    

    Route::name('page.')->group(function () {
        Route::get('/', 'FrontendController@index');
        Route::get('/search', 'FrontendController@search')->name('search');
        Route::get('/contact', 'FrontendController@contact')->name('contact');
        Route::get('/about-us', 'FrontendController@getAbout')->name('about-us');
        Route::get('/travel-special', 'FrontendController@getPromotedPackages')->name('lead');        
    });


    //By Country
    Route::prefix('destination')->group(function () {
        Route::get('/', 'FrontendController@allDestination')->name('destination');
        Route::get('/{country}', 'FrontendController@country')->name('country');
        Route::get('/{country}/{category}', 'FrontendController@countryCategory')->name('countryCategory');
    });

    Route::prefix('travel-style')->group(function () {
        Route::get('/', 'FrontendController@allActivities')->name('activities');
        Route::get('/{category}', 'FrontendController@byCategory')->name('byCategory');
        Route::get('/{category}/{region}', 'FrontendController@categoryRegion')->name('categoryRegion');
     });

    Route::prefix('package')->name('trip.')->group(function () {
        Route::get('/', 'FrontendController@getPackages')->name('index');
        Route::get('/{slug}', 'FrontendController@tripDetail')->name('show');
        Route::post('/book/{slug}', 'FrontendController@booking')->name('book');
    });

    Route::prefix('travel-blog')->name('blog.')->group(function () {
        Route::get('/', 'FrontendController@blogPosts')->name('posts');
        Route::get('/{slug}', 'FrontendController@postByCategory')->name('byCategory');
        Route::get('/{category}/{slug}', 'FrontendController@singlePost')->name('singlePost');
    });    
    
    Route::get('/thank-you', 'FrontendController@thankyou')->name('thanks');

    Route::name('from.')->group(function () {
        Route::post('contact', 'MailController@fromContact')->name('contact');
        Route::post('enquiry', 'MailController@forEnquiry')->name('enquiry');
        Route::post('lead', 'MailController@forLead')->name('lead');
        Route::post('booking', 'MailController@forBooking')->name('booking');
    });

    Route::prefix('ajax')->group(function () {
        Route::get('load-departures', 'FrontendController@ajaxDepartures');
    });

    Route::name('sub-page.')->prefix('page')->group(function () {
        Route::get('/{slug}', 'FrontendController@getPage')->name('get');       
    });

    Route::prefix('newsletter')->group(function () {
        Route::post('/', 'NewsletterController@store');
    });

    Route::get('plan-trip','FrontendController@planTrip')->name('planTrip');

    Route::get('site-map', function () {
        return view('frontend.sitemap');
    });

    //handel post route
    Route::post('/planTrip', 'MailController@planTripPost')->name('planTripPost');
});