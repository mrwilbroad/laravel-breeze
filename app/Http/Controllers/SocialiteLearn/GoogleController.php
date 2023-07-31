<?php

namespace App\Http\Controllers\SocialiteLearn;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use App\Models\User;

class GoogleController extends Controller
{
    // before logged in
    public function redirect()
    {
        return Socialite::driver("google")->redirect();
    }


    //   when user logged in
    public function callback()
    {
     try {
        $user = Socialite::driver("google")->user();
        $getuser = User::updateorCreate([
            "auth_type" => "google",
            "auth_id" => $user->id
         ],[
            'name'  => $user->name,
            'email'=> $user->email,
            'nickname'=> $user->nickname,
            'auth_type'=> "google",
            "auth_id"=> $user->id,
            "auth_token" => $user->token,
            'password'=> Hash::make(Str::random(10)),
        ]);

        Auth::login($getuser);
        return redirect(RouteServiceProvider::HOME);
        
     } catch (\Exception $th) {

        dd($th);
        // // it work Fine
        //   return redirect()->route("login")->with("auth_failed","Authentification failed, try again");
        //  }   
    }
}


}