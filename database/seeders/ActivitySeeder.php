<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Source::factory(100)->create();
        \App\Models\Author::factory(100)->create();
        \App\Models\Reaction::factory(100)->create();
        \App\Models\Activity::factory(100)->create();
    }
}
