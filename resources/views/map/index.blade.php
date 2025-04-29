@extends('layouts.back')
@section('title', 'Maps')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <style>

        .leaflet-top.leaflet-right{
            display: none!important;
        }

    </style>
@endpush
@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
            <div id="map" style="width:100%; height: 100vh"></div>
         <!--end::Container-->
    </div>
    <!--end::App Content-->
 @endsection
 @push('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js" integrity="sha512-FW2A4pYfHjQKc2ATccIPeCaQpgSQE1pMrEsZqfHNohWKqooGsMYCo3WOJ9ZtZRzikxtMAJft+Kz0Lybli0cbxQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.4.0/pusher.min.js" integrity="sha512-p3rR75Is6DCK1r2D8mdxLQhe4IWVDSTUBdxqs0Veum0hHDSY+sH9M6U6Cesr1umlxbiEK9w/3IhXFlZcWT1AoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script>

        var map = L.map('map').setView([22.870998, 91.096893], 15);
        mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'Leaflet © ' + mapLink + ', contribution',
            maxZoom: 18,
        }).addTo(map);

        var customIcon = L.icon({
            iconUrl: 'https://track-gps.netlify.app/image/marker.png',
            iconSize: [40, 40]
        });

        var fixedIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.8.0/dist/images/marker-icon.png',
            iconSize: [10, 20]
        });
        var destinationMarkers = [];
        var destinationLocations = [
            [22.870998, 91.096893],
            [22.869349, 91.096870],
            [22.866784, 91.096983],
            [22.865317, 91.097060],
            [22.862596, 91.096649],
            [22.859271, 91.096124],
            [22.856025, 91.096652],
            [22.854189, 91.096659],
            [22.851774, 91.097012],
            [22.841454, 91.097970],
            [22.840788, 91.098994],
            [22.825704, 91.101481],
            [22.791794, 91.103233]
        ];

        destinationLocations.forEach(function(location) {
            var marker = L.marker(location,{icon:fixedIcon}).addTo(map);
            destinationMarkers.push(marker);
        });



        var pusher = new Pusher('5f236d623373c187b0f2', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('bus-tracking');


        L.Routing.control({
            waypoints: [
                L.latLng(22.870998, 91.096893),
                L.latLng(22.791794, 91.103233),
            ],
            routeWhileDragging: true,
            draggableWaypoints: false,
            addWaypoints: false,
            createMarker: function() {
                return null;
            },
        }).addTo(map);



        var vehicleMarkers = {};


        @if(Auth::user()->hasRole('Driver') || Auth::user()->hasRole('Super Admin'))
            if (navigator.geolocation) {
                let lastLat = null,lastLng = null;

                const vehicleId = {{ Auth::user()->id }};

                navigator.geolocation.watchPosition(
                    position => {
                        const {
                            latitude: lat,
                            longitude: lng,
                            accuracy,
                            speed
                        } = position.coords;

                        if (lastLat !== lat || lastLng !== lng) {
                            lastLat = lat;
                            lastLng = lng;



                            fetch("{{ route('maps.store') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        lat,
                                        lon: lng,
                                        vehicle_id: vehicleId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status) {


                                        if (vehicleMarkers[vehicleId]) {
                                            vehicleMarkers[vehicleId].setLatLng([data.lat, data.lon]);
                                        } else {
                                            vehicleMarkers[vehicleId] = L.marker([data.lat, data.lon], {
                                                icon: customIcon
                                            }).addTo(map);
                                        }
                                    }
                                })
                                .catch(error => console.error("Error:", error));
                        }
                    },
                    error => {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Location access is denied. Please enable location services in your device settings.");
                        } else if (error.code === error.POSITION_UNAVAILABLE) {
                            alert("Location information is unavailable. Please check your GPS settings.");
                        } else if (error.code === error.TIMEOUT) {
                            alert("Location request timed out. Try again.");
                        } else {
                            alert("An unknown error occurred while fetching location.");
                        }
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 0
                    }
                )
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        @endif



        channel.bind('location-updated', function(data) {
            const {
                vehicleId,
                latitude,
                longitude
            } = data;


            if (vehicleMarkers[vehicleId]) {
                vehicleMarkers[vehicleId].setLatLng([latitude, longitude]);
            } else {
                vehicleMarkers[vehicleId] = L.marker([latitude, longitude], {
                    icon: customIcon
                }).addTo(map);
            }

            vehicleMarkers[vehicleId].bindPopup("<b>User Name</b><br><div class='d-flex justify-content-evenly'><a href='tel:'><i class='bi bi-telephone'></i></a> <a href='{{ route('chat.index',Auth::user()->id) }}'><i class='bi bi-chat'></i></a></div>").openPopup();
        });





</script>


 @endpush
