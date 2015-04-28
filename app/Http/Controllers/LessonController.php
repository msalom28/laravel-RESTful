<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\LessonTransformer;
use Illuminate\Http\Request;
use Input;
use App\Lesson;

class LessonController extends ApiController {

	protected $lessonTransformer;

	/**
	 * Creating an instance of LessonController
	 */
	public function __construct(LessonTransformer $lessonTransformer)
	{
		$this->lessonTransformer = $lessonTransformer;

		$this->middleware('auth.basic', ['only' => 'post']);
	}

	/**
	 * Display all lessons
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit') ? : 3;

		$lessons = Lesson::paginate($limit);

		return $this->responseWithPagination($lessons, [
			'data' => $this->lessonTransformer->transformCollection($lessons->all())
		]);
	}

	/**
	 * Display the specified lesson.
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$lesson = Lesson::find($id);

		if (! $lesson)
		{
			return $this->responseNotFound('Lesson does not exist.');
		}

		return $this->response([

			'data' => $this->lessonTransformer->transform($lesson)

		]);
	}

	/**
	 * Store a newly created lesson in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(! $request->title || ! $request->body)
		{
			return $this->responseNotSaved('Parameters failed validation for an error.');
		}

		Lesson::create($request->all());

		return $this->responseCreated('Lesson succesfully created.');
	}

}
