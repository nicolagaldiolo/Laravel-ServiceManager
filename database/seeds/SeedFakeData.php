<?php

use Illuminate\Database\Seeder;

class SeedFakeData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $me = App\User::create(
            [
                'name' => env('TESTUSER'),
                'email' => env('TESTEMAIL'),
                'password' => bcrypt(env('TESTPASS')),
                'is_verified' => 1
            ]
        );

        $users = factory(App\User::class, 9)->create();

        $users->push($me);

        $users->each(function($user){
            $providers = factory(App\Providers::class, 6)->create([
                'user_id' => $user->id
            ]);
            factory(App\Domains::class, 20)->create([
                'domain' => collect($providers)->random()->id,
                'hosting' => collect($providers)->random()->id,
                'user_id' => $user->id
            ]);
        });
    }
}
