<x-layout title="New favorite address">
    <form name="createaddress" method="post" @if(isset($address)) action="{{ route('adresses.update') }}" @else action="{{ route('adresses.store') }}" @endif >
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control mb-2" id="name" placeholder="Name of address" name="name" @isset($address) value="{{$address->name}}" @endisset >
                <label for="street">Street</label>
                <input type="text" class="form-control mb-2" id="street" placeholder="street of address" name="street" @isset($address) value="{{$address->street}}" @endisset >
                <label for="number">Number</label>
                <input type="text" class="form-control mb-2" id="number" placeholder="number of address" name="number" @isset($address) value="{{$address->number}}" @endisset >
                <label for="district">District</label>
                <input type="text" class="form-control mb-2" id="district" placeholder="district of address" name="district" @isset($address) value="{{$address->district}}" @endisset >
                <label for="country">Country</label>
                <input type="text" class="form-control mb-2" id="country" placeholder="country of address" name="country" @isset($address) value="{{$address->country}}" @endisset >
                @isset($address)
                    <input type="hidden" id="id" name="id" value="{{$address->id}}">
                @endisset
            </div>
            </li>
        </ul>
        <br />
        <a href="{{ route('trips.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>

