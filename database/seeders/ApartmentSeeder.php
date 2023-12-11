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
        $_apartments = config("apartments");

        foreach ($_apartments as $_apartment) {
            $apartment = new Apartment();
            $apartment->user_id = $faker->numberBetween(2, 6);
            $apartment->name = $_apartment['name'];
            $apartment->description = $_apartment['description'];
            $apartment->address = $_apartment['address'];
            $apartment->latitude = $_apartment['lat'];
            $apartment->longitude = $_apartment['lon'];
            $apartment->visibility = $faker->numberBetween(0, 1);
            $apartment->rooms = $_apartment['rooms'];
            $apartment->beds = $_apartment['beds'];
            $apartment->bathrooms = $_apartment['bathrooms'];
            $apartment->mq = $_apartment['mq'];
            $apartment->price = $faker->numberBetween(50, 200);
            $apartment->cover_image = $_apartment['cover_image'];
            $apartment->save();

        }




    }
}