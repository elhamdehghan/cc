<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;

    public static function make($user)
    {
        self::where('mobile',$user->mobile)->delete();
        $pr = new self;
        $pr->mobile = $user->mobile;
        $pr->token = rand(100000,999999);
        $pr->created_at = Carbon::now();
        $pr->save();
        return $pr;
    }


    public static function check($mobile)
    {
        $found = self::where('mobile',$mobile)->where('created_at','>' ,now()->subMinute(2))->first();
        return !$found;
    }
}
