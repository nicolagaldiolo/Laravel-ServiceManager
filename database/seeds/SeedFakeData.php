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
        $me = App\User::create(
            [
                'name' => env('TESTUSER'),
                'email' => env('TESTEMAIL'),
                'password' => bcrypt(env('TESTPASS'))
            ]
        );

        $users = factory(App\User::class, 9)->create();
        $users->push($me);

        $users->each(function($user){
            $providers = factory(App\Providers::class, 5)->create([
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
