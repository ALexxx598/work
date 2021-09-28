<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Calendar;
use App\Models\Profile;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class CalendarController extends Controller
{
    public $assocArray = [];

    public function returnProfile($request)
    {
        $this->assocArray = [];
        $profile = new Profile();
        $profile = $profile->showProfile();
        $profile = array_merge(array($profile[0]));
        $calendar = new Calendar();
        $calendar = $calendar->showCalendar($request);
        $this->assocArray['profile'] = $profile[0];
        $this->assocArray['calendar'] = $calendar;
    }

    public function showUpdateEvent($id)
    {
        $event = new Calendar();
        $event = $event->getEvent($id);
        $event = $event[0];
        return view("/Profile/updateEvent")->with(['id'=>$id, 'event'=>$event]);
    }

    public function updateEvent(PostRequest $request, $id)
    {
        $event = new Calendar();
        $event->updateEvent($request,$id);
        $this->returnProfile($request);
        return redirect('/showProfile/0')->with(compact(['profile'=>$this->assocArray['profile'],
            'calendar'=> $this->assocArray['calendar']]));
    }

    public function deleteEvent(Request $request, $id)
    {
        $page = 0;
        $calendar = new Calendar();
        if($calendar->checkTrue($id))
        {
            $profileId = $calendar->getProfileId($id);
            if ($calendar->countEvents($profileId) - 1 == 0) {
                $calendar->deleteEvent($id);
                $calendar->deleteCalendarKey($profileId);
            } else {
                $calendar->deleteEvent($id);
            }
        }
        else
        {
            $this->returnProfile($request);
            return redirect("/showProfile/$page")->with(compact(['profile' => $this->assocArray['profile'],
                'calendar' => $this->assocArray['calendar'], 'pages' => $page]));//мошенннник
        }
        $this->returnProfile($request);
        return redirect("/showProfile/$page")->with(compact(['profile' => $this->assocArray['profile'],
                        'calendar' => $this->assocArray['calendar'], 'pages' => $page]));

    }
    public function addEvent(PostRequest $request)
    {
        $event = new Calendar();
        $event->addEvent($request);
        $this->returnProfile($request);
        return redirect('/showProfile')->with(compact(['profile'=>$this->assocArray['profile'],
                    'calendar'=> $this->assocArray['calendar']]));
    }

    public function showAddEvent()
    {
        $event = new Calendar();
        return view('/Profile/addCalendarEvent');
    }

}
