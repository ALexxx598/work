@extends('welcome')

@section('Main-content')
    <form method="Post" action="/main">
        @csrf
        <p><input type="text" name="text">TEXT</p>
        <p><input type="submit">ADD</p>
    </form>
@endsection
