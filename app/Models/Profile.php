<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Profile extends Model
{
    use HasFactory;
    protected $rules = [
        'number' => 'required|min:9|max:9',
        'surname' => 'required|min:2|max:40',
        'avatar' => 'mimes:png,jpeg,svg,gif',
    ];

    public $errors;

    public function validate($inputs): bool
    {
        $valid = Validator::make($inputs,$this->rules);
        if($valid->passes())
        {
            return true;
        }
        $this->errors = $valid->messages();
        return false;
    }
    public function addProfile($inputs, $path)
    {
            //$imagetmp = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
            DB::insert('INSERT INTO `profile` (`userId`,`surname`,`image`,`number`) VALUES (:id,:surname,:image,:number)',
                ['surname' => $inputs['surname'],
                    'image' => $path,
                    'number' => $inputs['number'],
                    'id' => Auth::user()->getAuthIdentifier()
                ]);
    }

    public function showProfile() : array
    {
        return  DB::select('SELECT `calendarId`,`surname`,`image`,`number`
                                  FROM profile WHERE `userId` = :id',
            ['id'=>Auth::user()->getAuthIdentifier()]);
    }

}
