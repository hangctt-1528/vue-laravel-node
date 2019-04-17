<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'Aa@123456',
        ];

        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'dev') {
            app(User::class)->create($user);
            factory(User::class, 50)->create();
        }
    }
}
