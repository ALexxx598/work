@extends('welcome')

@section('Main-content')
    @csrf
    <p>Surname :{{$profile[0]->surname}}</p>
    <p>Number :{{$profile[0]->number}}</p>
    <p><img src="{{asset('/storage/' . $profile[0]->image) }}"></p>
    @if(isset($calendar))
    <table>
        <tr><th><p>EventType</p></th><th><p>EventInf</p></th><th><p>EventTime</p></th><th><p>EventDate</p></th><th><p>LastUpdate</p></th><th><p>DELETE</p></th><th><p>Update</p></th></tr>
    @foreach($calendar as $event)
            <tr><td>{{$event->eventType}}</td>
                <td>{{$event->eventInf}}</td>
                <td>{{$event->time}}</td>
                <td>{{$event->eventDate}}</td>
                <td>{{$event->updated_at}}</td>
                <form action="/deleteCalendarEvent/{{$event->id}}" method="POST">
                    <td><input type="submit" value="DELETE"></td>
                    @method('DELETE')
                    @csrf
                </form>
                <form action="/showUpdateCalendarEvent/{{$event->id}}" method="GET">
                    <td><input type="submit" value="UPDATE"></td>
                    @csrf
                </form>
        @endforeach
        <tr><td></td><td></td><td></td><td></td><td></td></tr>
        <form action="/showAddCalendarEvent" method="GET">
            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><p><input type="submit" value="ADD"></p></td></tr>
            @csrf
        </form>
    </table>
    @else
        <table>
            <tr><th><p>EventType</p></th><th><p>EventInf</p></th><th><p>EventTime</p></th><th><p>EventDate</p></th><th><p>LastUpdate</p></th><th><p>DELETE</p></th><th><p>Update</p></th></tr>
        </table>
        <p></p>
        <form action="/showAddCalendarEvent" method="GET">
            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><p><input type="submit" value="AddEvent"></p></td></tr>
            @csrf
        </form>
    @endif

@endsection
