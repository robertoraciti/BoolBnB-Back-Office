<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_services = config('apartment_services');

        foreach ($_services as $_service) {
            $service = new Service();
            $service->name = $_service['name'];
            $service->icon = $_service['icon'];
            $service->save();


        }
    }
}