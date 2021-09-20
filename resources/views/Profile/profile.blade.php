@extends('welcome')

@section('Main-content')

    <form action="/main" method="POST">
        @csrf

            <p>Name<input type="text" name="user" value="Name"></p>
            <p>Surname<input type="text" name="surname" value="Surname"></p>
            <p>Image<input type="image" name="image" value="Image"></p>
            <p>Number<input type="number" name="number" value="Number"></p>
            <p><input type="submit" value="Click"></p>

    </form>
@endsection
