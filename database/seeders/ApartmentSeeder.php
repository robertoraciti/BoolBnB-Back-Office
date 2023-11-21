<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment = new Apartment();
        $apartment->user_id = $faker->numberBetween(1, 5);
        $apartment->visibility = $faker->numberBetween(0, 1);
        $apartment->price = $faker->randomFloat(2);
        $apartment->save();



    }
}