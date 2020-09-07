<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bands')->insert([
            'name' => 'Blur',
            'genre' => 'Indierock',
            'profilepic' => 'storage/access/img/bands/blur.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'The Dead Weather',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/the dead weather.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Genesis',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/genesis.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Gorillaz',
            'genre' => 'Alternative',
            'profilepic' => 'storage/access/img/bands/gorillaz.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Led Zeppelin',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/led zeppelin.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Muse',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/muse.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'The Raconteurs',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/the raconteurs.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Slipknot',
            'genre' => 'Metal',
            'profilepic' => 'storage/access/img/bands/slipknot.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'The White Stripes',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/the white stripes.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Stone Sour',
            'genre' => 'Hardrock',
            'profilepic' => 'storage/access/img/bands/stone sour.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Dr Peppers Jaded Hearts Club',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/dr peppers jaded hearts club.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Last Shadow Puppets',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/last shadow puppets.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('bands')->insert([
            'name' => 'Jet',
            'genre' => 'Rock',
            'profilepic' => 'storage/access/img/bands/jet.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
