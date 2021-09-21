@extends('welcome')

@section('Main-content')
<form>
    <p>Surname :{{$profile[0]->surname}}</p>
    <p>Number :{{$profile[0]->number}}</p>
    <p>Image :<img src="{{$profile[0]->image}}"></p>
</form>
@endsection
