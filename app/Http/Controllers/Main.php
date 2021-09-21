<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;
use \Illuminate\Http\RedirectResponse;
use PhpParser\Node\Stmt\While_;


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
        $profileData = $profile->showProfile();
        return view('/Profile/showProfile')->with('profile', $profileData);
    }
    public function showMain(Request $request)
    {
        $profile = new Profile();
        if($profile->validate($request->all()))
        {
            $profile->addProfile($request->all());
            return redirect('/showProfile');
        }
        else
        {
            return redirect()->back()->with('errors', $profile->errors->messages());
        }
    }
}
