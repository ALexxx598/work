@extends('welcome')

@section('Main-content')
    <form action="/addCalendarEvent" method="POST" >
        @foreach($errors as $error)
            @foreach($error as $message)
                <p>{{$message}}</p>
            @endforeach
        @endforeach
        @csrf
        <p>event Type<input type="text" name="eventType" ></p>
        <p>event Inf<input type="text" name="eventInf"></p>
        <p>event Date<input type="date" name="eventDate"></p>
        <p>event Time<input type="time" name="eventTime"></p>
            <select name="status" size="1">
                <option value="False">False</option>
                <option value="True">True</option>
            </select>
        <p><input type="submit" value="ADD"></p>
    </form>
@endsection
