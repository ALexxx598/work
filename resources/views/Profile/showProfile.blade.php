@extends('welcome')

@section('Main-content')
<form action="/addCalendarEvent" method="POST" >
    @csrf
    <p>Surname :{{$profile[0]->surname}}</p>
    <p>Number :{{$profile[0]->number}}</p>
    <p><img src="{{asset('/storage/' . $profile[0]->image) }}"></p>;
    @if(isset($calendar))
    <table>
        <tr><th>EventType</th><th>EventInf</th><th>EventDate</th><th>LastUpdate</th><th><p>DELETE</p>></th><th>Update</th></tr>
    @foreach($calendar as $event)
            <tr><td>{{$event->eventType}}</td>
                <td>{{$event->eventInf}}</td>
                <td>{{$event->eventDate}}</td>
                <td>{{$event->updated_at}}</td>
                <td><p><a href="{{url('/deleteCalendarEvent/' . $event->id)}}">DELETE</a></p></td>
                <td><p><a href="{{url('/updateCalendarEvent/' . $event->id)}}">UPDATE</a></p></td></tr>
        @endforeach
        <tr><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td><p><a href="{{url('/addCalendarEvent' . $event->id)}}">ADD</a></p></td></tr>
    </table>
    @else
        <table>
            <tr><th>EventType</th><th>EventInf</th><th>EventDate</th><th>LastUpdate</th><th>DELETE</th><th>Update</th></tr>
        </table>
        <p><input type="submit" value="AddEvent"></p>
    @endif
</form>

@endsection
