<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Imagick;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;
use \Illuminate\Http\RedirectResponse;
use PhpParser\Node\Stmt\While_;
use App\Images;
use \Illuminate\Http\Response;
use Image;

class Main extends Controller
{
    public function openProfile()
    {
        return view('/Profile/profile');
    }
    public function showInf()
    {
        return view('/information');
    }
    public function showProfile()
    {
        $profile = new Profile();
        $profile = $profile->showProfile();
        if(isset($profile[0]->calendarId))
        {
            $calendar = new Calendar();
            $calendar = $calendar->showCalendar();
            return view('/Profile/showProfile')->with(['profile'=>$profile,'calendar'=>$calendar ]);
        }
        return view('/Profile/showProfile')->with(['profile'=>$profile]);
    }
    public function showMain(Request $request)
    {
        $profile = new Profile();
        if($profile->validate($request->all()))
        {
            $path = $request->File('avatar')->store('uploads','public');
            $profile->addProfile($request->all(), $path);
            return redirect('/showProfile');
        }
        else
        {
            return redirect()->back()->with('errors', $profile->errors->messages());
        }
    }

}
