<?php

use Laracasts\TestDummy\Factory;

class LessonsTest extends ApiTester {

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
	

}
