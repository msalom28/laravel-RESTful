<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{	
	/**
	 * @var array
	 */
	protected $fillable = ['title', 'body', 'some_bool'];


	/**
	 * A lesson can have many tags
	 *
	 * @return mixed
	 */
	// public function tags()
	// {	
	// 	//many to many relationship
	// 	return $this->belongsToMany('App\Tag');
	// }
} 