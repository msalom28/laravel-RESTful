<?php 

$factory('App\Lesson', [

	'title' 		=> $faker->sentence,
	'body'  		=> $faker->paragraph,
	'some_bool'     => $faker->boolean($chanceOfGettingTrue = 50)

]);

$factory('App\Comment', [

	'body' 		=> 	$faker->sentence,
	'lesson_id' => 'factory:App\Lesson'

]);
