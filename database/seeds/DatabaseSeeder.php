<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	private $tables = [

		'lessons',
		'comments'
	];

	private $seederTables = [

		'LessonsTableSeeder',
		'CommentsTableSeeder'
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	
		Model::unguard();

		$this->cleanDatabase();		

		$this->seedDatabase();
	
	}

	private function cleanDatabase()
	{
		foreach ($this->tables as $tableName) {
			
			DB::table($tableName)->truncate();
		}
	}

	private function seedDatabase()
	{
		foreach ($this->seederTables as $seedTable) {
			
			$this->call($seedTable);
		}
	}

}
