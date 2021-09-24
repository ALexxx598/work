<?php

namespace App\Models;

use App\Http\Requests\PostRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;


class Calendar extends Model
{
    use HasFactory;


    public function addEvent($request)
    {
        $date = new DateTime();
       $result = $date->getTimestamp();
       // $date->format($result);
        //$result = date_format($date, 'Y-m-d H:i:s');
        //$result = date("Y-m-d H:i:s");
        DB::insert("INSERT INTO `calendars` (`profileId`, `eventType`, `eventInf`, `eventDate`, `time`)
                           VALUES (:profileId,:eventType,:eventInf,:eventDate,:eventTime)",
            ['profileId'=>$this->getCalendarId(), 'eventType'=>$request->eventType,
                'eventInf'=>$request->eventInf, 'eventDate'=>$request->eventDate,
                'eventTime'=>$request->eventTime]);
    }
    public function getEvent($id)
    {
        return DB::select("SELECT `eventType`, `eventDate`, `eventInf`, `time` FROM `calendars` WHERE `id` = :id", ['id'=>$id]);
    }

    public function updateEvent($request, $id)
    {
        DB::update("UPDATE `calendars` SET `eventType` = :eventType,`eventInf` = :eventInf, `eventDate` = :eventDate, `time` = :eventTime  WHERE `id` = :id",
                    ['id' => $id, 'eventType'=>$request->eventType, 'eventInf'=>$request->eventInf, 'eventDate'=>$request->eventDate, 'eventTime'=>$request->eventTime]);
    }

    public function deleteEvent($id)
    {
        DB::delete("DELETE FROM `calendars` WHERE `id` = :id", ['id'=>$id]);
    }

    public function countEvents($profileId)
    {
         $result = DB::select("SELECT COUNT(`id`) AS count FROM `calendars` WHERE `profileId` = :id", ['id'=>$profileId]);
        return $result[0]->count;
    }
    public function getProfileId($id): int
    {
        $result = DB::select(DB::raw("SELECT `profileId` FROM `calendars` WHERE `id` = :id "), ['id'=>$id]);
        return $result[0]->profileId;
    }
    public function getCalendarId(): int
    {
        $result = DB::select(DB::raw("SELECT `calendarId` FROM `profile` JOIN `users` ON users.`id` = profile.`userId`
                                WHERE users.`id` = :id "), ['id'=>Auth::user()->getAuthIdentifier()]);
        return $result[0]->calendarId;
    }
    public function deleteCalendarKey($profileId)
    {
        DB::update("UPDATE `profile` SET calendarId = NULL WHERE `calendarId` = :profileId", ['profileId'=>$profileId]);
    }

    public function showCalendar()
    {
        return DB::select(DB::raw("SELECT calendars.`eventType`, calendars.`eventInf`, calendars.`time`,
                            calendars.`eventDate`, calendars.`updated_at`,calendars.`id`
                            FROM `users` JOIN `profile` ON users.`id` = profile.`userId`
                            JOIN `calendars` ON profile.`calendarId` = calendars.`profileId`
                            WHERE users.`id` = :id ORDER BY calendars.`eventDate`"), ['id' => Auth::user()->getAuthIdentifier()]);;
    }

    public function checkTrue($id)
    {
        $number = DB::select(DB::raw("SELECT COUNT(*) AS count
                            FROM `users` JOIN `profile` ON users.`id` = profile.`userId`
                            JOIN `calendars` ON profile.`calendarId` = calendars.`profileId`
                            WHERE users.`id` = :id and calendars.`id`!= :writeId "),
            ['id' => Auth::user()->getAuthIdentifier(), 'writeId' => $id]);
        $number = $number[0]->count;

        if($number)
        {
            return true;
        }
        return false;
    }
}
