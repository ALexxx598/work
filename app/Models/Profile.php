<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\True_;

class Profile extends Model
{
    use HasFactory;
    protected $rules = array(
        'number' => 'required|min:10|max:10',
        'surname' => 'required|min:2|max:40',
        'image' => 'sometimes|mimes:jpg,png,jpeg,png,gif|max:100000'
    );

    public function validate($inputs): bool
    {
        $valid = Validator::make($inputs,$this->rules);
        if($valid->pasess()) return true;
        $this->errors = $valid->messages();
        return false;
    }
    public function addProfile($inputs)
    {
        DB::insert('INSERT INTO `Profile` (`surname`,`image`,`number`) VALUES (:surname,:image,:number)
            WHERE `userId` = :id ',
            ['surname' => $inputs['surname'],
                'image' => $inputs['image'],
                'number' => $inputs['number'],
                'id' => Auth::user()->getAuthIdentifier()]);
    }
}
