<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Empty all tables.
        foreach (['users', 'courses', 'modules', 'course_module', 'lessons'] as $table) {
            DB::table($table)->delete();
        }

        // Populate tables.
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(CourseModuleTableSeeder::class);
        $this->call(LessonsTableSeeder::class);

        Model::reguard();
    }
}
