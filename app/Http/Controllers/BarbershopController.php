<?php

namespace App\Http\Controllers;

use App\Barbershop;
use Illuminate\Http\Request;

class BarbershopController extends Controller
{
    public function register()
    {
        return view('barbershop.register');
    }
    
    public function create()
    {
        return view('barbershop.create');
    }
    
    public function store()
    {
        Barbershop::create(request()->all());
        
        return redirect('map')->with('status', 'Barbershop Added!');
    }
}
