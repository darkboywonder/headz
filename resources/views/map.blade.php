<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' />
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.2.0/mapbox-gl-geocoder.css' type='text/css' />

        <title>MAP</title>

    </head>
    <body>
        <div id='map' style='position: absolute; top:0; bottom:0; left:0; right:0'></div>

        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.2.0/mapbox-gl-geocoder.min.js'></script>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiZGFya2JveXdvbmRlciIsImEiOiI2Z0p4dHJjIn0.c__AdDJe7434_xn8ezjQCw';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/darkboywonder/cjj091uos0cet2rqoy587r1qq',
                center: [-98.5795, 39.8283],
                zoom: 4,
            });

            map.addControl(new MapboxGeocoder({
                accessToken: mapboxgl.accessToken
            }));

            map.on('load', function () {
                // Add a layer showing the places.
                map.addLayer({
                    "id": "places",
                    "type": "symbol",
                    "source": {
                        "type": "geojson",
                        "data": '/map.json',
                    },
                    "layout": {
                        "icon-image": "{icon}-15",
                        "icon-allow-overlap": true
                    }
                });
            });

            // When a click event occurs on a feature in the places layer, open a popup at the
            // location of the feature, with description HTML from its properties.
            map.on('click', 'places', function (e) {
                var coordinates = e.features[0].geometry.coordinates.slice();
                var description = e.features[0].properties.description;

                // Ensure that if the map is zoomed out such that multiple
                // copies of the feature are visible, the popup appears
                // over the copy being pointed to.
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }

                new mapboxgl.Popup()
                    .setLngLat(coordinates)
                    .setHTML(description)
                    .addTo(map);
            });

            // Change the cursor to a pointer when the mouse is over the places layer.
            map.on('mouseenter', 'places', function () {
                map.getCanvas().style.cursor = 'pointer';
            });

            // Change it back to a pointer when it leaves.
            map.on('mouseleave', 'places', function () {
                map.getCanvas().style.cursor = '';
            });
        </script>
    </body>
</html>
