<x-layout title="Adresses">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="form-group">
                <h4>Adresses list in JSON format:</h4>
                <label for="descricao">
                    {{ $jsonList }}
                    @if(!$jsonList)
                        You don't have any Adresses yet. Create adresses and return here. =)
                    @endif
                </label>
            </div>
        </li>
    </ul>
    <a href="{{ route('trips.index') }}" class="btn btn-secondary mt-2">Back</a>
</x-layout>