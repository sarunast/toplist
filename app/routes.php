<?php
Route::group(array('domain' => '{page}.tamytop.com'), function()
{
    Route::group(array('before' => 'guest'), function()
    {
        Route::get('login','AuthController@getLogin');
        Route::post('login','AuthController@postLogin');
    });
    Route::get('/','PageController@page');
    Route::get('post/{id}','PageController@pagePost')->where('id', '[0-9]+');
    Route::get('{postPath}','PageController@pageCategory');

});
/**
 * STATIC PAGES
 */
Route::get('/', 'PageController@index');
Route::get('faq', 'PageController@faq');
Route::get('affiliate', 'PageController@affiliate');
Route::get('contact', 'PageController@contact');
Route::get('advertise', 'PageController@advertise');
Route::post('panel/website/send','WebsiteController@sendEmail');


/**
 * VOTES
 */
Route::get('vote/{id}', 'VoteController@index')->where('id', '[0-9]+');
Route::post('vote/{id}', 'VoteController@store')->where('id', '[0-9]+');

/**
 * AUTH
 */
Route::group(array('before' => 'guest'), function()
{
    Route::get('login','AuthController@getLogin');
    Route::post('login','AuthController@postLogin');
    Route::get('register','AuthController@getRegister');
    Route::post('register','AuthController@postRegister');

	//Password remind and reset
    Route::get('remind','AuthController@getRemind');
    Route::post('remind','AuthController@postRemind');
    Route::get('reset/{token}','AuthController@getReset');
    Route::post('reset/{token}','AuthController@postReset');

    //Verify
    Route::get('verify/{code}','AuthController@getVerify')->where('code', '[a-zA-Z0-9]+');
});

/*AUTHENTICATION REQUIRED*/
Route::group(array('before' => 'auth'), function()
{
    Route::get('logout','AuthController@getLogout');

    /**
     * PANEL
     */
    Route::get('panel','PanelController@panel');
	Route::group(array('prefix' => 'panel'), function() {

        Route::resource('affiliate','AffiliateController',
                array('only' => array('index')));
        Route::get('statistics','PanelController@statistics');
        Route::get('top/html','PanelController@createFinal');

        Route::get('website', 'WebsiteController@index');
        Route::get('website/create', 'WebsiteController@create');
        Route::post('website', 'WebsiteController@store');
        Route::group(array('prefix' => 'website','before' => 'website'), function() {
            Route::post('edit','WebsiteController@updateBasic');
            Route::resource('pages','WebsitePageController');
            Route::get('navigation','WebsiteController@navigations');
            Route::post('navigation','WebsiteController@addNavigation');
            Route::get('header','WebsiteController@header');
            Route::post('header','WebsiteController@postHeader');
            Route::post('server','WebsiteController@addServer');
            Route::post('server/{id}','WebsiteController@removeServer')->where('id', '[0-9]+');
            Route::post('app','WebsiteController@addSideNav');
            Route::post('content','WebsiteController@addContent');
            Route::post('content/edit','WebsiteController@editContent');
            Route::post('content/{id}','WebsiteController@removeContent')->where('id', '[0-9]+');
            Route::get('widgets','WebsiteController@widgets');

        });
        Route::resource('login', 'UserController');
        Route::resource('top', 'ServerController');
	});

});
Route::get('out/{id}', function ($id) {
    $server = Server::findOrFail($id);
    $redirect = $server->url;
    $server->increment('clicks');
    $server->increment('day_clicks');
    $server->save();
    return Redirect::to($redirect);
})->where('id', '[0-9]+');


//Category paths
Route::get('{path}', 'PageController@categories');

// Statistics data (ajax)
Route::get('data/statistics/{id}', 'AjaxController@statistics')->where('id', '[0-9]+');

// Servers data (ajax)
Route::get('data/servers/{id}', 'AjaxController@servers')->where('id', '[0-9]+');

// details page
Route::get('{path}/{id}/{slug?}', 'PageController@details');


/**
 *  TESTING
 */

/*Route::get('/test', function(){

	$gq = new Gameq\Gameq();

	try {

		$gq->addServer(array(
			'id' => 'samperfsf',
			'type'=> 'samp',
			'connect_host' => '93.119.26.17:7777',
		));

		$gq->addServer(array(
			'id' => 'cs_sourcesdfds',
			'type' => 'css', // Counter-Strike: Source
			'connect_host' => '85.114.140.30:27015',
		));

	}
	catch(Sarunas\Gameq\UserException $e) {
		die("addServer exception: " . $e->getMessage());
	}

	$results = $gq->requestAllData();

	echo "<pre>";
	dd($results);


});*/


/*Route::get('script', function()
{
    return View::make('script.script');
});*/