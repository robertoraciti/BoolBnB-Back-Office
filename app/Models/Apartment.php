<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Service;
use App\Models\Message;
use App\Models\Advertisement;

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

    public function messages()
    {

        return $this->hasMany(Message::class);

    }

    public function views()
    {

        return $this->hasMany(View::class);

    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class);
    }

    public function getAbstract($chars = 50)
    {
        return strlen($this->description) > $chars ? substr($this->description, 0, $chars) . "..." : $this->description;
    }

    public function getAbsUriImage()
    {
        return $this->cover_image ? Storage::url($this->cover_image) : null;
    }
}