<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('tasks')->insert([
                'task' => 'Lorem ipsum dolor sit amet, et dolore magna aliqua.',
            ]);
        }
    }
}
