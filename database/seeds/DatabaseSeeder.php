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
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@greatnesia.id',
            'password' => password_hash("paswot", PASSWORD_DEFAULT),
        ]);

        DB::table('users')->insert([
            'email' => 'azmifauzan@gmail.com',
            'password' => password_hash("paswot", PASSWORD_DEFAULT),
            'name' => 'fauzan',
            'profil' => 'ordinary people'
        ]);

        DB::table('categories')->insert(['title' => 'Great People']);
        DB::table('categories')->insert(['title' => 'Great Culinary']);
        DB::table('categories')->insert(['title' => 'Great Nature']);
        DB::table('categories')->insert(['title' => 'Great Culture']);
    }
}
