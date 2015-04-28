<?php

use Laracasts\TestDummy\Factory;
use App\Lesson;
use App\Comment;


class CommentTest extends ApiTester {

	public function tearDown()
	{
		DB::table('comments')->truncate();
	}

	public function testFetchingComments()
	{
		$comments = Factory::times(10)->create('App\Comment');
		
		$this->getJson('api/v1/comments');

		$this->assertResponseOk();	
	}


	public function testFetchingCommentsForALesson()
	{
		$comments = Factory::times(5)->create('App\Comment');

		$lesson = Lesson::first();
		
		$this->getJson('api/v1/lessons/'.$lesson->id.'/comments');

		$this->assertResponseOk();
	}

	public function testCreatingAnewCommentGivenValidParameters()
	{
		$lesson = Factory::create('App\Lesson');
		
		$this->getJson('api/v1/comments', 'POST', ['body' => 'this is the body', 'lesson_id' => $lesson->id]);

		$this->assertResponseStatus(201);
	}


	public function testItThrowsA404WhenCreatingACommentFailsValidation()
	{
		$this->getJson('api/v1/comments', 'POST');
		
		$this->assertResponseStatus(404);
	}




}