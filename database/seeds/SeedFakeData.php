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

        $me = App\User::create(
            [
                'name' => env('DEMOUSER', 'Demo'),
                'email' => env('DEMOEMAIL', 'demouser@example.com'),
                'password' => bcrypt(env('DEMOPASS', 'password')),
                'role' => UserType::Admin,
            ]
        );

        if(config('app.env') !== 'production') {

            $users = factory(App\User::class, 10)->create([
                'password' => bcrypt(env('DEMOPASS', 'password')),
            ]);

            $users->prepend($me);

            $users->each(function ($user) {

                $RenewalFrequencies = factory(App\RenewalFrequency::class, 1)->create([
                    'user_id' => $user->id
                ]);

                $customers = factory(App\Customer::class, 4)->create([
                    'user_id' => $user->id
                ]);

                $providers = factory(App\Provider::class, 4)->create([
                    'user_id' => $user->id
                ]);

                $seviceTypes = factory(App\ServiceType::class, 4)->create([
                    'user_id' => $user->id
                ]);

                factory(App\Service::class, 6)->create([
                    'customer_id' => collect($customers)->random()->id,
                    'provider_id' => collect($providers)->random()->id,
                    'service_type_id' => collect($seviceTypes)->random()->id,
                    'renewal_frequency_id' => collect($RenewalFrequencies)->random()->id
                ])->each(function ($service){
                    factory(App\Renewal::class, 1)->create([
                        'service_id' => $service->id,
                    ]);
                });

            });
        }
    }
}
