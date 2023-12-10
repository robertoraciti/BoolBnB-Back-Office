<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'date',
        'ip_address'
    ];

    public function apartment()
    {

        return $this->BelongsTo(Apartment::class);
    }

}