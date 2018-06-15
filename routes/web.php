<?php

Route::get('/', function () {
    return view('map');
})->name('map');

Route::get('/map.json', function () {
    return '{
            "type": "FeatureCollection",
            "features": [{
                "type": "Feature",
                "properties": {
                    "description": "<strong>Bobs Barbershop</strong><p><a href=\"http://www.mtpleasantdc.com/makeitmtpleasant\" target=\"_blank\" title=\"Opens in a new window\">bobs.com</a><br>123-456-7890<br>Address here</p>",
                    "icon": "theatre"
                },
                "geometry": {
                    "type": "Point",
                    "coordinates": [-77.038659, 38.931567]
                }
            }]
        }';
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
