<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function increment(Request $request, Apartment $apartment)
    {
        $view = new View([
            'date' => now(),
            'ip_address' => $request->ip(),
            'apartment_id' => $apartment->id,
        ]);

        $view->save();

        return response()->json(['success' => true]);
    }
}