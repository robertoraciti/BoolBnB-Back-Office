<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message = new Message();
        $message->name = 'User';
        $message->email = 'admin@email.it';
        $message->text = 'Messaggio di prova';
        $message->save();
        
    }
}