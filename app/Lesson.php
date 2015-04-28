<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{	
	/**
	 * @var array
	 */
	protected $fillable = ['title', 'body', 'some_bool'];


	/**
	 * A lesson can have many comments
	 *
	 * @return mixed
	 */
	public function comments()
	{		
		return $this->hasMany('App\Comment');
	}
} 