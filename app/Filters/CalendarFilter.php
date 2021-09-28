<?php

namespace App\Filters;

class CalendarFilter
{
    private $events;
    private $request;

    public function filter($request, $events)
    {
        $this->events = $events;
        $this->request = $request;
        if($request->filled('searchEventType'))
        {
            $events->where('eventType','=',$request->searchEventType);
        }
        if($request->filled('searchInf'))
        {
            $events->where('eventInf','LIKE',"%$request->searchInf%");
        }
        if($request->filled('status'))
        {
            $status = 0;
            if($request->status == "True"){ $status = 1;}
            $events->where('status','=',"$status");
        }
        $this->validateTime();
        return $events;

    }

    public function validateTime()
    {
        if($this->request->filled('minTime') && $this->request->filled('maxTime'))
        {
            if($this->request->minTime < $this->request->maxTime)
            {
                $this->events->where('time','<',"$this->request->maxTime");
                $this->events->where('time','>',"$this->request->minTime");
            }
        }
        elseif($this->request->filled('minTime'))
        {
            $this->events->where('time','>',"$this->request->minTime");
        }
        elseif($this->request->filled('maxTime'))
        {
            $this->events->where('time','<',"$this->request->maxTime");
        }
    }

}
