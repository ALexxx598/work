<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Profile;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class CalendarController extends Controller
{
    public $assocArray = [];

    public function returnProfile()
    {
        $this->assocArray = [];
        $profile = new Profile();
        $profile = $profile->showProfile();
        $profile = array_merge(array($profile[0]));
        $calendar = new Calendar();
        $calendar = $calendar->showCalendar();
        $this->assocArray['profile'] = $profile[0];
        $this->assocArray['calendar'] = $calendar;
    }

    public function showUpdateEvent($id)
    {
        $move = 'update';
        return view("/updateEvent/update")->with(['id'=>$id, 'move' =>$move]);
    }

    public function updateEvent(Request $request)
    {

        $this->returnProfile();
        return redirect('/showProfile')->with(compact(['profile'=>$this->assocArray['profile'], 'calendar'=> $this->assocArray['calendar']]));
    }

    public function deleteEvent($id)
    {
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
            return view();//мошенник
        }
        $this->returnProfile();
        return redirect('/showProfile')->with(compact(['profile' => $this->assocArray['profile'],
                        'calendar' => $this->assocArray['calendar']]));

    }
    public function addEvent()
    {

        $this->returnProfile();
        return redirect('/showProfile')->with(compact(['profile'=>$this->assocArray['profile'],
                    'calendar'=> $this->assocArray['calendar']]));
    }
}
