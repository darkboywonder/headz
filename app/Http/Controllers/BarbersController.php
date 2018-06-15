<?php

namespace App\Http\Controllers;

use App\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BarbersController extends Controller
{
    public function store(Request $request)
    {
        Barber::create($request->all());

        return redirect()->route('barbershop.register');
    }

    public function show(Barber $barber)
    {
        return view('barber.profile')->with('barber', $barber);
    }

    public function update(Barber $barber, Request $request)
    {
        if (Gate::allows('alter-barber', $barber)) {
            $barber->update($request->all());

            return redirect()->route('map')->with('status', 'Your profile was updated!');
        }

        return response()->view('forbidden', ['message' => 'You are not allowed to edit this profile'], 403);
    }

    public function destroy(Barber $barber)
    {
        if (Gate::allows('alter-barber', $barber)) {
            $barber->delete();

            return redirect(route('map'))->with('status', 'Your barber profile was deleted!');
        }

        return response()->view('forbidden', ['message' => 'You are not allowed to delete this profile'], 403);
    }

    public function register()
    {
        return view('barber.register');
    }
}
