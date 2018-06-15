<?php

use App\Barbershop;


Route::get('/', function () {
    return view('map');
})->name('map');

Route::get('/map.json', function () {
    $barbershops = Barbershop::all()->map(function ($barbershop) {
        return [
            "type" => "Feature",
            "properties" => [
                "description" => "<strong>" . $barbershop->name . "</strong><p><a href=\"" . $barbershop->url . " target=\"_blank\" title=\"Opens in a new window\">" . $barbershop->url . "</a><br>". $barbershop->phone ."<br>". $barbershop->address ."</p>",
                "icon" => "circle"
            ],
            "geometry" => [
                "type" => "Point",
                "coordinates" => [$barbershop->longitude, $barbershop->latitude]
            ]
        ];
    });
    return json_encode([
        "type" => "FeatureCollection",
        "features" => $barbershops,
    ]);
});

// Route::prefix('barbers')->group(function () {
//     Route::post('', 'BarbersController@store')->name('barber.store');
//     Route::get('register', 'BarbersController@register')->name('barber.register');
//     Route::get('{barber}', 'BarbersController@show')->name('barber.show');
//     Route::patch('{barber}', 'BarbersController@update')->name('barber.update');
//     Route::delete('{barber}', 'BarbersController@destroy')->name('barber.destroy');
// });

// Route::prefix('barbershop')->group(function () {
//     Route::get('register', 'BarbershopController@register')->name('barbershop.register');
// });
