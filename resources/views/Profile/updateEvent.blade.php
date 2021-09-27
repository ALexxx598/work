@extends('welcome')

@section('Main-content')
    <form action="/updateCalendarEvent/{{$id}}" method="POST" >
        @foreach($errors as $error)
            @foreach($error as $message)
                <p>{{$message}}</p>
            @endforeach
        @endforeach
        @csrf
            {{method_field('PUT')}}
            <p>event Type<input type="text" name="eventType" value="{{$event->eventType}}"></p>
            <p>event Inf<input type="text" name="eventInf"  value="{{$event->eventInf}}"></p>
            <p>event Date<input type="date" name="eventDate"  value="{{$event->eventDate}}"></p>
            <p>event Time<input type="time" name="eventTime"  value="{{$event->time}}"></p>
            <select name="status" size="1">
                <option value="False">False</option>
                <option value="True">True</option>
            </select>
            <p><a href="{{url('/showAddCalendarEvent/' . $id)}}"> <input type="submit" value="Update"></a></p>
    </form>
@endsection
