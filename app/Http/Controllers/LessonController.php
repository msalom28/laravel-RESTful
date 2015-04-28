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

		// $this->middleware('auth.basic', ['only' => 'post']);
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
