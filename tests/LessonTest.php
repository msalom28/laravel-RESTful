<?php

use Laracasts\TestDummy\Factory;

class LessonTest extends ApiTester {

	public function tearDown()
	{
		DB::table('lessons')->truncate();
	}

	/**
	 *
	 * @return void
	 */
	public function testFetchingLessons()
	{	
		//arrange
		$lesson = Factory::times(5)->create('App\Lesson');

		//act
		$this->getJson('api/v1/lessons');

		//assert
		$this->assertResponseOk();
	}

	public function testFetchingASingleLesson()
	{
		$lesson = Factory::create('App\Lesson', ['title' => 'This is my single lesson title']);

		$json = $this->getJson('api/v1/lessons/'.$lesson->id);

		$this->assertResponseOk();

		$this->assertEquals('This is my single lesson title', $json->data->title);

	}

	public function testError404WhenlessonNotFound()
	{
		$json = $this->getJson('api/v1/lessons/x');		

		$this->assertResponseStatus(404);

		$this->assertObjectHasAttribute('error', $json);		

	}

	public function testCreatingAnewLessonGivenValidParameters()
	{
		$attributes = Factory::attributesFor('App\Lesson');
		
		$this->getJson('api/v1/lessons', 'POST', $attributes);

		$this->assertResponseStatus(201);
	}

	public function testItThrowsA404WhenCreatingALessonFailsValidation()
	{
		$this->getJson('api/v1/lessons', 'POST');
		
		$this->assertResponseStatus(404);
	}
	

}
