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
                'name' => env('DEMOUSER'),
                'email' => env('DEMOEMAIL'),
                'password' => bcrypt(env('DEMOPASS')),
                'is_verified' => 1,
                'role' => env('USER_ADMIN_ROLE'),
            ]
        );

        $users = factory(App\User::class, 1)->create();

        $users->push($me);

        $users->each(function($user){
            $providers = factory(App\Providers::class, 1)->create([
                'user_id' => $user->id
            ]);
            factory(App\Domains::class, 1)->create([
                'domain' => collect($providers)->random()->id,
                'hosting' => collect($providers)->random()->id,
                'user_id' => $user->id
            ]);
        });
    }
}
