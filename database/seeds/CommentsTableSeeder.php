<?php 

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$lessonIds = DB::table('lessons')->lists('id');

		foreach ($lessonIds as $lessonId) {

			foreach (range(1, 10) as $index) {

				Comment::create([ 'body' => $faker->sentence, 'lesson_id' => $lessonId]);
				
			}


		}
	}
}