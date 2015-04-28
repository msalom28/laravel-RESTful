<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;
use App\Lesson;
use App\Comment;

class CommentController extends ApiController {

	protected $commentTransformer;

	public function __construct(CommentTransformer $commentTransformer)
	{
		$this->commentTransformer = $commentTransformer;

		$this->middleware('auth.basic', ['only' => 'post']);
	}

	/**
	 * @param int $lessonId
	 *
	 * @return Response
	 */
	public function index($lessonId = null)
	{
		$comments = $this->getComments($lessonId);

		return $this->response([

			'data' => $this->commentTransformer->transformCollection($comments->all())

		]);
	}

	/**
	 * @param int $lessonId
	 *
	 * @return Response
	 */
	public function getComments($lessonId)
	{
		$comments = $lessonId ? Lesson::findOrFail($lessonId)->comments : Comment::all();

		return $comments;
	}


	/**
	 * Store a newly created comment in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(! $request->body || ! $request->lesson_id)
		{
			return $this->responseNotSaved('Parameters failed validation for an error.');
		}

		$comment = Comment::buildComment($request->body);

		Lesson::findOrFail($request->lesson_id)->comments()->save($comment);

		return $this->responseCreated('Comment succesfully created.');

	}

}
