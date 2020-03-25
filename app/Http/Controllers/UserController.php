<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function acc()
    {
        $user = auth()->user();
        return view('users.acc' ,compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'nullable|string|min:3|max:200',
            'mobile' => 'nullable|string|digits:11|unique:users,mobile'.$user->id,
            'new_password' => 'nullable|string|min:8|max:40',
            'current_password' => 'required',
        ]);
        if (\Hash::check($request->current_password,$user->password)){
            $logout = false;
            if($request->name){
                $data ['name'] = $request->name;
            }
            if($request->mobile) {
                $data ['mobile'] = $request->mobile;
                $data['mobile_verified_at'] = null;
                $user->unverify_mobile();
                $logout = true;

            }
            if ($request->new_password){
                $logout = true;
                $data ['password'] =  bcrypt($request->new_password);
            }

            $user->update($data);

            $messgae = 'مشخصات شما با موفقیت ویرایش شد.';
            if ($logout){
                \Auth::logout();
                return redirect('login')->withMessage($messgae);
            }else{
                return back()->withMessage($messgae);
            }

        }else{
            return back()->withErrors(['رمزعبور فعلی اشتباه است.'])->withInput();
        }
    }
}
