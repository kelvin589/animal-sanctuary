<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use Illuminate\Database\Seeder;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $types = ['mammal', 'bird', 'reptile', 'amphibian', 'fish', 'invertebrate'];
        $images = [];

        foreach(range(1, 10) as $index) 
        {
            DB::table('animals')->insert([
                'name'=>$faker->name,
                'date_of_birth'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'description'=>$faker->text($maxNbChars = 256),
                'type'=>$faker->randomElement($types),
                'image'=>'noimage.jpg',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
