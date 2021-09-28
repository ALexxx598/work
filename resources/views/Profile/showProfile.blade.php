@extends('welcome')

@section('Main-content')
    @csrf
    <p>Surname :{{$profile[0]->surname}}</p>
    <p>Number :{{$profile[0]->number}}</p>
    <p><img src="{{asset('/storage/' . $profile[0]->image) }}"></p>
    <form action="/showProfile" method="GET">
        <p>Search by Event Type:<input type="text" name="searchEventType" value="{{request()->searchEventType}}"></p>
        <p>Search by Tags in inf:<input type="text" name="searchInf"  value="{{request()->searchInf}}"></p>
        <select name="status" size="1">
            <option @if(request()->status == "False") selected="selected" @endif value="False">False</option>
            <option @if(request()->status == "True") selected="selected" @endif value="True">True</option>
        </select>
        <div>
            <p>Min Time :<input type="time" name="minTime"></p>
            <p>Max TIme :<input type="time" name="maxTime"></p>
            <p><input type="submit" value="Search"></p>
        </div>
    </form>
    <p><a href="{{url("/showProfile")}}"><input type="submit" value="Clear"></a></p>
    <table bordercolor="black" border="2" width="100%">
        <tr><th><p>EventType</p></th><th><p>EventInf</p></th><th><p>EventTime</p></th><th><p>EventDate</p></th><th><p>Status</p></th><th><p>LastUpdate</p></th><th><p>DELETE</p></th><th><p>Update</p></th></tr>
    @if(isset($calendar))
        @foreach($calendar as $event)
                <tr>
                    <td>{{$event->eventType}}</td>
                    <td>{{$event->eventInf}}</td>
                    <td>{{$event->time}}</td>
                    <td>{{$event->eventDate}}</td>
                    @if($event->status)
                        <td>True</td>
                    @else
                        <td>False</td>
                    @endif
                    <td>{{$event->updated_at}}</td>
                    <form action="/deleteCalendarEvent/{{$event->id}}" method="POST">
                        <td><input type="submit" value="DELETE"></td>
                        @method('DELETE')
                        @csrf
                    </form>
                    <form action="/showUpdateCalendarEvent/{{$event->id}}" method="GET">
                        <td><input type="submit" value="UPDATE"></td>
                    </form>
            @endforeach
                <td></td><td></td><td></td><td></td><td></td>
                </tr>
                <form action="/showAddCalendarEvent" method="GET">
                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><p><input type="submit" value="ADD"></p></td></tr>
                </form>
    </table>
    {{$calendar->links()}}
    @else
        </table>
            <p></p>
            <form action="/showAddCalendarEvent" method="GET">
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><p><input type="submit" value="AddEvent"></p></td></tr>
            </form>
    @endif
@endsection
