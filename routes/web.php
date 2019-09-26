<?php

//  Home Route

Route::get('/','HomeController@index');

// Admin Routes

Route::patch('/admins', 'AdminsController@approve');

Route::resource('/admins', 'AdminsController')->middleware('admin');

Route::get('/profile/{name}', 'ProfileController@profile');

Route::PATCH('/profile/{name}', 'ProfileController@updateProfile');

// Album Routes

Route::resource('/albums','AlbumsController');

Route::resource('/videos','VideoController');

/* ============================================= */


// Photo Routes

Route::resource('/photos', 'PhotoController');

Route::get('photos/{id}/download', function($id) {
    $photo = App\Photo::findOrFail($id);
    $headers = array(
        'Content-Type'  => 'application/jpg'
    );
    $filePath = 'images/'.$photo->path;
    return Response::download($filePath,$photo->path, $headers);
});
Route::get('albums/photos/{id}/download', function($id) {
    $photo = App\Photo::findOrFail($id);
    $headers = array(
        'Content-Type'  => 'application/jpg'
    );
    $filePath = 'images/'.$photo->path;
    return Response::download($filePath,$photo->path, $headers);
});

/* ============================================= */



/* ============================================= */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function() {
	auth()->logout();
	return redirect('/home');
});