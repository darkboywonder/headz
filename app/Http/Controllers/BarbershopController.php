<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarbershopController extends Controller
{
    public function register()
    {
        return view('barbershop.register');
    }
}
