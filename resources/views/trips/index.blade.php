<x-layout title="Trips">
    <x-alerts :alerts="$alerts"></x-alerts>

    <form action="{{ route('trips.executeJson') }}" method="post">
        @csrf
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                <input type="text" class="form-control mb-2" id="json_command" placeholder="Insert your JSON instruction here" name="json_command" @isset($json_command) value="{{$json_command}}" @endisset >
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
                <button type="submit"  class="btn btn-primary btn-sm">Execute JSON for a trip (create or delete)</button>
                <a href="{{ route('trips.showExampleJson') }}" class="btn btn btn-sm">Show examples of command</a>
            </li>
        </ul>
    </form>
    
    <br />
    <hr class="my-4">
    <br />
    
    <a class="btn btn-primary btn-lg mb-2 btn-sm" href="{{ route('trips.create') }}" role="button">New trip</a>
    <a class="btn btn btn-lg mb-2 btn-sm" href="{{ route('trips.json') }}" role="button">Show all trips in JSON</a>
    <ul class="list-group">
        @foreach($trips as $trip)
            <li class="list-group-item d-flex justify-content-between">
            <a href="{{ route('trips.show', $trip->id) }}" class="alert-link" style="text-decoration:none" role="alert" >
                <h5>Trip {{$trip->id}}</h5> 
                Origin: {{ $trip->street_origin }} <> Destination: {{ $trip->street_destination }}
            </a>
                <group>
                    <form action="{{ route('trips.destroy',$trip->id) }}" method="post">
                        @csrf
                        <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit"  class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </group>
            </li>
        @endforeach
    </ul>

    <br />
    <hr class="my-4">
    <br />

    <a class="btn btn-primary btn-lg mb-2 btn-sm" href="{{ route('adresses.create') }}" role="button">New favorite address</a>
    <a class="btn btn btn-lg mb-2 btn-sm" href="{{ route('adresses.json') }}" role="button">Show all adresses in JSON</a>
    <ul class="list-group">
        @foreach($adresses as $address)
            <li class="list-group-item d-flex justify-content-between">
            <a href="{{ route('adresses.show', $address->id) }}" class="alert-link" style="text-decoration:none" role="alert" >
                <h5>{{$address->name}}</h5> 
                ( {{$address->street}}, {{$address->number}}, {{$address->district}}, {{$address->country}} ) - Click to JSON example.
            </a>
                <group>
                    <form action="{{ route('adresses.destroy',$address->id) }}" method="post">
                        @csrf
                        <a href="{{ route('adresses.edit', $address->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit"  class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </group>
            </li>
        @endforeach
    </ul>
    <br />
    
</x-layout>

