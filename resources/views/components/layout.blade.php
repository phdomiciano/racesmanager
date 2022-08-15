<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{$title}} - Trips Manager</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    @auth
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('trips.index') }}" style="color:grey">Home</a>
            <group>
                <label class="display-8" style="color:grey">Trips of {{ Auth::user()->name; }} | </label>
                <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm">Logout</a>
            </group>
        </nav>
    @endauth
    <div class="container">
        <div class="jumbotron">
            <br />
            <h1 class="display-4">{{$title}}</h1>
            <hr class="my-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{$slot}}
        </div>
    </div>
    <br />
</body>
</html>