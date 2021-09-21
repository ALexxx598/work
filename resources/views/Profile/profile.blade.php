@extends('welcome')

@section('Main-content')

    <form enctype="multipart/form-data" action="/main" method="POST">
        @foreach($errors as $error)
            @foreach($error as $message)
                <p>{{$message}}</p>
            @endforeach
        @endforeach
        @csrf

            <p>Name<input type="text" name="user" value="Name"></p>
            <p>Surname<input type="text" name="surname" value="Surname"></p>
            <p>Image<input type="file" name="avatar" value="Image" accept="image/jpeg,image/png,image/gif"></p>
            <p>Number<input type="number" name="number" value="Number"></p>
            <p><input type="submit" value="Upload"></p>

    </form>
@endsection
