<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index()
  {
    $apartments = Apartment::orderBy('id', 'desc')->paginate(8);
    return view('guest.home', compact('apartments'));

  }
}