<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Calendar extends Model
{
    use HasFactory;


    public function addEvent($id)
    {

    }

    public function updateEvent($id)
    {

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
        return (int)DB::select(DB::raw("SELECT `profileId` FROM `calendars` WHERE `id` = :id "), ['id'=>$id]);
    }
    public function deleteCalendarKey($profileId)
    {
        DB::update("UPDATE `profile` SET calendarId = NULL WHERE `calendarId` = :profileId", ['profileId'=>$profileId]);
    }

    public function showCalendar()
    {
        return DB::select(DB::raw("SELECT calendars.`eventType`, calendars.`eventInf`,
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
