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
        // $this->call(UsersTableSeeder::class);

        $me = App\User::create(
            [
                'name' => env('TESTUSER'),
                'email' => env('TESTEMAIL'),
                'password' => bcrypt(env('TESTPASS'))
            ]
        );

        $users = factory(App\User::class, 9)->create();
        $users->push($me);

        $providers = factory(App\Providers::class, 20)->create();

        foreach ($users as $user) {
            factory(App\Domains::class, 20)->create([
                'domain' => collect($providers)->random()->id,
                'hosting' => collect($providers)->random()->id,
                'user_id' => $user->id
            ]);
        }
    }
}
