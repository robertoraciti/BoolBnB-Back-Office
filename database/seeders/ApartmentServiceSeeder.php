<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_apartments = Apartment::all();

        $_services = Service::all()->pluck('id')->toArray();

        foreach ($_apartments as $_apartment) {
            $_apartment->services()->attach($faker->randomElements($_services, random_int(4, 7)));
        }
    }
}