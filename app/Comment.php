<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = ['body'];

	/**
	 * A comment belongs to one lesson
	 */
	public function lesson()
	{
		return $this->belongsTo('App\Lesson');
	}

	/**
	 * @param text $body
	 */
	public static function buildComment($body)
	{
		$comment = new static(compact('body'));

		return $comment;
	}

}
