<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        factory(WebCalendar\Module::class, 30)->create();
    }
}