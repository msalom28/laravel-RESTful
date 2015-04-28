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
	

}
