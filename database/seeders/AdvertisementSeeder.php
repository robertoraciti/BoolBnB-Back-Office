<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_advertisements = config("apartment_adv");

        foreach ($_advertisements as $_advertisement) {
            $advertisement = new Advertisement();
            $advertisement->price = $_advertisement['price'];
            $advertisement->label = $_advertisement['label'];
            $advertisement->duration = $_advertisement['duration'];
            $advertisement->save();
        }


    }


}