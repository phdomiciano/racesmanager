<x-layout title="My trip">
    <div class="d-flex p-2 justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Trip {{ $trip->id }}</h5>
                    <p class="card-text">Origin: {{$trip->street_origin}}, {{$trip->number_origin}}, {{$trip->district_origin}}, {{$trip->country_origin}}</p>
                    <p class="card-text">Destination: {{$trip->street_destination}}, {{$trip->number_destination}}, {{$trip->district_destination}}, {{$trip->country_destination}}</p>
                    <a href="{{ route('trips.edit', $trip->id) }}" class="card-link">Edit</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title">JASON use example:  (If you prefer, use this as an example to create new trips)</h5>
                    <p class="card-text">
                        Full object:<br />
                        {{ $jsonExampleFull }}
                        <br /><br />
                        Just comun attributes:<br />
                        {{ $jsonExampleAttributes }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br />
    <a href="{{ route('trips.index') }}" class="btn btn-secondary">Back</a>
</x-layout>