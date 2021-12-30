<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $ver_token = Str::random(128);
        $email_verify = '';

        $credentials = [
            "name" => $request->get('name'),
            'email' => $request->get('email'),
            "password" => Hash::make($request->get('password')),
            "verification_token" => $ver_token,
            "email_verified_at" => $email_verify
        ];

        $newUser = User::query()->create($credentials);

        if($newUser) {
            $this->emailVerification($newUser, $ver_token,);
            $this->verify($newUser->id);
            return response()->json(['message' => 'User Registered']);
        }

        return response()->json(['error' => 'Something is wrong']);
    }

    public function emailVerification(User $user, $token)
    {
        Mail::send('mail.verify', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Please Verify your Email');
        });
    }
    public function verify($id){
        $email_verify = [
            'email_verified_at' => now()->toDateTimeString()
        ];
        User::query()->where('id',$id)->update($email_verify);
    }
}
