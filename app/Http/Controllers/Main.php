<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;
use Symfony\Component\HttpKernel\Profiler\Profile;
use \Illuminate\Http\RedirectResponse;


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
    public function showMain(Request $request)
    {
        $profile = new Profile();
        if($profile->validate($request->all()))
        {
            $profile->addProfile();
            return redirect()->route('information');
        }
        else
        {
            return redirect()->back();
        }
    }
}
