<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThankYouController extends Controller
{
    public function index()
    {
        return view('admin.thank-you');
    }
}