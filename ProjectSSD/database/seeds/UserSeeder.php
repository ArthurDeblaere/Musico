<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
            'name' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@musico.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => 1,
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'editor',
            'password' => Hash::make('password'),
            'email' => 'editor@musico.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => 2,
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'guest',
            'role_id' => 3,
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email' => 'guest@musico.com',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
