<x-layout title="New trip">
    <form name="createtrip" method="post" @if(isset($trip)) action="{{ route('trips.update') }}" @else action="{{ route('trips.store') }}" @endif >
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
            <div class="d-flex p-2 justify-content-between">
                <div class="d-flex justify-content-start">
                    <div class="card" style="width: 30rem;">
                        <div class="card-body">
                            <h1 class="display-4">Origin address</h1>
                            <label for="street_origin">Street</label>
                            <input type="text" class="form-control mb-2" id="street_origin" placeholder="street_origin of address" name="street_origin" @isset($trip) value="{{$trip->street_origin}}" @endisset >
                            <label for="number_origin">Number</label>
                            <input type="text" class="form-control mb-2" id="number_origin" placeholder="number_origin of address" name="number_origin" @isset($trip) value="{{$trip->number_origin}}" @endisset >
                            <label for="district_origin">District</label>
                            <input type="text" class="form-control mb-2" id="district_origin" placeholder="district_origin of address" name="district_origin" @isset($trip) value="{{$trip->district_origin}}" @endisset >
                            <label for="country_origin">Country</label>
                            <input type="text" class="form-control mb-2" id="country_origin" placeholder="country_origin of address" name="country_origin" @isset($trip) value="{{$trip->country_origin}}" @endisset >
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="card" style="width: 35rem;">
                        <div class="card-body">
                            <h1 class="display-4">Address destination</h1>
                            <label for="street_destination">Street</label>
                            <input type="text" class="form-control mb-2" id="street_destination" placeholder="street_destination of address" name="street_destination" @isset($trip) value="{{$trip->street_destination}}" @endisset >
                            <label for="number_destination">Number</label>
                            <input type="text" class="form-control mb-2" id="number_destination" placeholder="number_destination of address" name="number_destination" @isset($trip) value="{{$trip->number_destination}}" @endisset >
                            <label for="district_destination">District</label>
                            <input type="text" class="form-control mb-2" id="district_destination" placeholder="district_destination of address" name="district_destination" @isset($trip) value="{{$trip->district_destination}}" @endisset >
                            <label for="country_destination">Country</label>
                            <input type="text" class="form-control mb-2" id="country_destination" placeholder="country_destination of address" name="country_destination" @isset($trip) value="{{$trip->country_destination}}" @endisset >
                            
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <br />
        @isset($trip)
            <input type="hidden" id="id" name="id" value="{{$trip->id}}">
        @endisset
        <a href="{{ route('trips.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>
