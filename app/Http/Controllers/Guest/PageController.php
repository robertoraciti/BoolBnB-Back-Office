<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
  public function index()
  {
    $apartments = Apartment::orderBy('id', 'desc')->where('user_id', '=', Auth::user()->id)->paginate(4);
    return view('guest.home', compact('apartments'));

  }
}