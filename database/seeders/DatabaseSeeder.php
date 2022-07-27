<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $roles = ['admin', 'user', 'editor', 'owner'];

        foreach ($roles as $item){
            Role::create([
                'name' => $item
            ]);
        }
        User::create([
            'first_name' => 'XS',
            'last_name' => 'XS',
            'email' => 'founder@xsoft.am',
            'role_id' => 1,
            'phone' => 000000000,
            'password' => '$2y$10$hwHzVYbPy8IeXlH.AlJHu.OGMzBBsA3D2vT5TejrV7819hRVEyuoi', // password
        ]);

//         \App\Models\User::factory(100)->create();
//         \App\Models\Reaction::factory(100)->create();
//         \App\Models\Source::factory(100)->create();
//         \App\Models\Activity::factory(100)->create();
    }
}
