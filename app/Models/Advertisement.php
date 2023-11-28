<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Advertisement extends Model
{
    use HasFactory;


    public function advertisements()
    {
        return $this->belongsToMany(Apartment::class);
    }
}