<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->insert([
            'name' => 'Come Whatever May',
            'year' => '2006',
            'genre' => 'Hardrock',
            'cover' => 'storage/access/img/covers/come whatever may.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 10
        ]);
        DB::table('albums')->insert([
            'name' => 'Demon Days',
            'year' => '2005',
            'genre' => 'Alternative',
            'cover' => 'storage/access/img/covers/demon days.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 4
        ]);
        DB::table('albums')->insert([
            'name' => 'Genesis',
            'year' => '1983',
            'genre' => 'Bluesrock',
            'cover' => 'storage/access/img/covers/genesis.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 3
        ]);
        DB::table('albums')->insert([
            'name' => 'Elephant',
            'year' => '2003',
            'genre' => 'Rock',
            'cover' => 'storage/access/img/covers/elephant.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 9
        ]);
        DB::table('albums')->insert([
            'name' => 'Help Us Stranger',
            'year' => 2019,
            'genre' => 'Rock',
            'cover' => 'storage/access/img/covers/help us stranger.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 7
        ]);
        DB::table('albums')->insert([
            'name' => 'Horehound',
            'year' => '2009',
            'genre' => 'Indierock',
            'cover' => 'storage/access/img/covers/horehound.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 2
        ]);
        DB::table('albums')->insert([
            'name' => 'House Of Gold & Bones Part 1',
            'year' => '2012',
            'genre' => 'Hardrock',
            'cover' => 'storage/access/img/covers/house of gold & bones part 1.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 10
        ]);
        DB::table('albums')->insert([
            'name' => 'Led Zeppelin',
            'year' => '1969',
            'genre' => 'Rock',
            'cover' => 'storage/access/img/covers/led zeppelin.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 5
        ]);
        DB::table('albums')->insert([
            'name' => 'Origin Of Symmetry',
            'year' => '2001',
            'genre' => 'Rock',
            'cover' => 'storage/access/img/covers/origin of symmetry.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 6
        ]);
        DB::table('albums')->insert([
            'name' => 'Parklife',
            'year' => '1994',
            'genre' => 'Indierock',
            'cover' => 'storage/access/img/covers/parklife.png',
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'band_id' => 1
        ]);
    }
}
