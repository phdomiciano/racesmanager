<x-layout title="My favorite address">
    <div class="d-flex p-2 justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $address->name }}</h5>
                    <p class="card-text">{{$address->street}}, {{$address->number}}, {{$address->district}}, {{$address->country}}</p>
                    <a href="{{ route('adresses.edit', $address->id) }}" class="card-link">Edit</a>
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