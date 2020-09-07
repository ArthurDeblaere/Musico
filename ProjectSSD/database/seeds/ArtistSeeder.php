<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artists')->insert([
            'firstname' => 'Damon',
            'lastname' => 'Albarn',
            'age' => '52',
            'profilepic' => 'storage/access/img/artists/damonalbarn.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Jack',
            'lastname' => 'White',
            'age' => '44',
            'profilepic' => 'storage/access/img/artists/jackwhite.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Jim',
            'lastname' => 'Root',
            'age' => '48',
            'profilepic' => 'storage/access/img/artists/jimroot.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Matthew',
            'lastname' => 'Bellamy',
            'age' => '41',
            'profilepic' => 'storage/access/img/artists/matthewbellamy.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Robert',
            'lastname' => 'Plant',
            'age' => '71',
            'profilepic' => 'storage/access/img/artists/robertplant.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Phil',
            'lastname' => 'Collins',
            'age' => '69',
            'profilepic' => 'storage/access/img/artists/philcollins.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Miles',
            'lastname' => 'Kane',
            'age' => '34',
            'profilepic' => 'storage/access/img/artists/mileskane.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Nic',
            'lastname' => 'Cester',
            'age' => '40',
            'profilepic' => 'storage/access/img/artists/niccester.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('artists')->insert([
            'firstname' => 'Graham',
            'lastname' => 'Coxon',
            'age' => '51',
            'profilepic' => 'storage/access/img/artists/grahamcoxon.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
