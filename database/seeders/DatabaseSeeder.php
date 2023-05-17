<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         $user = User::factory()->create([
             'name' => 'Shaffan',
             'email' => 'shaffan@email.com',
             'password' => '123456'
         ]);

         Form::factory(50)->create([
             'fields' => [
                 [
                     'id' => 'ahsfjhlahldfahsk',
                     'name' => 'Name',
                     'type' => 'text',
                     'require' => true,
                 ]
             ],
             'user_id' => $user->id
         ]);

        User::factory()->create([
            'name' => 'Susan',
            'email' => 'susan@email.com',
            'password' => '123456'
        ]);
    }
}
