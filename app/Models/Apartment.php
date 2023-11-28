<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
        'visibility',
        'rooms',
        'beds',
        'bathrooms',
        'mq',
        'price',
        // 'cover_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }



    public function getAddress($chars = 35)
    {
        return strlen($this->address) > $chars ? substr($this->address, 0, $chars) . " ..." : $this->address;
    }

}