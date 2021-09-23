@extends('welcome')

@section('Main-content')
    <form action="/updateEvent" method="POST" >
        @foreach($errors as $error)
            @foreach($error as $message)
                <p>{{$message}}</p>
            @endforeach
        @endforeach
        @csrf
        @if(isset($event))
                @if($event == "update")
                    <p>eventType<input type="text" name="eventType" value="eventType"></p>
                    <p>eventInf<input type="text" name="eventInf" value="eventInf"></p>
                    <p>eventDate<input type="date" name="eventDate" value="eventDate"></p>
                    <p><input type="submit" value="Update"></p>
                @elseif($event == "add")
                    <p>eventType<input type="text" name="eventType" value="eventType"></p>
                    <p>eventInf<input type="text" name="eventInf" value="eventInf"></p>
                    <p>eventDate<input type="date" name="eventDate" value="eventDate"></p>
                    <p><a href="{{url("/addCalendarEvent")}}"><input type="submit" value="ADD"></a></p>
                @endif
        @endif
    </form>
@endsection
