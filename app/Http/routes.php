<?php


Route::group(['prefix' => 'api/v1'], function()
{
	Route::resource('lessons', 'LessonController');

	Route::get('lessons/{lessonId}/comments', 'CommentController@index');

	Route::resource('comments', 'CommentController', ['only' => ['index', 'store']]);

});