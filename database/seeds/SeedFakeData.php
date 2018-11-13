<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Enums\UserType;

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

        Storage::deleteDirectory(config('custompath.avatars'));
        Storage::deleteDirectory(config('custompath.services'));
        Storage::deleteDirectory(config('custompath.providers'));

        factory(App\User::class, 1)->create([
            'name' => env('DEMOUSER', 'Demo'),
            'email' => env('DEMOEMAIL', 'demouser@example.com'),
            'password' => bcrypt(env('DEMOPASS', 'password')),
            'role' => UserType::Admin,
        ]);

        if(config('app.env') !== 'production') {
            factory(App\User::class, 4)->create([
                'password' => bcrypt(env('DEMOPASS', 'password')),
            ]);
        }
    }
}
