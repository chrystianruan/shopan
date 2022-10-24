<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $roles = ['Common', 'Admin'];
        $types = ['Recomendados', 'Destaques', 'Promoção'];

        foreach($roles as $role) {
            \App\Models\Role::create([
                'name' => $role
            ]);
        }
    
        foreach($types as $type) {
            \App\Models\Type::create([
                'name' => $type
            ]);
        }


       \App\Models\User::factory(10)->create();


    }
}
