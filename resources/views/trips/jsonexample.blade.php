<x-layout title="Trips">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="form-group">
                <h4>For create a new Trip:</h4>
                <h7>Use the command "create-trip" in the first postion of JSON, for create a new Trip with this data</h7>
                <br />Exemple:<br /><br />
                <label for="descricao">
                ["create-trip",{"street_origin":"my street 1","number_origin":"1111","district_origin":"my district 1","country_origin":"my country 1","street_destination":"street 2","number_destination":"2222","district_destination":"district 2","country_destination":"country 2"}]
                </label>
            </div>
        </li>
    </ul>
    <ul class="list-group mt-4">
        <li class="list-group-item">
            <div class="form-group">
                <h4>For delete a Trip:</h4>
                <h7>Use the command "delete-trip" in the first postion of JSON to delete the Trip. Inform the id in the second position.</h7>
                <br />Exemple:<br /><br />
                <label for="descricao">
                ["delete-trip",{"id":"1"}]
                </label>
            </div>
        </li>
    </ul>
    <a href="{{ route('trips.index') }}" class="btn btn-secondary mt-4">Back</a>
</x-layout>