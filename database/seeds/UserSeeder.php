<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Ramadhan M. Kivoja',
            'role' => 'owner',
            'email' => 'rkivoja@app.com',
            'password' => bcrypt('password'),
        ]);
    }
}
