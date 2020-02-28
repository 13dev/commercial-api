<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        factory(\App\Commercial::class, 20)->create()->each(function (\App\Commercial $c) {
            $c->photosRelation()->saveMany(factory(\App\Photo::class, 4)->make());
        });
    }
}
