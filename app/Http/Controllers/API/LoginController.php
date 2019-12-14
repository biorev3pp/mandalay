<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Validators\UsersValidator;
USE DB;

class LoginController extends Controller
{
    use HelperTrait, UsersValidator;

    public function index(Request $request)
    {
        if (isset(Auth::user()->id)) {
            return ['status' => 'success'];
        }

        // check for email if exist

        $user = User::where('email', $request['email'])->get()->first();
        if(!$user):
            return ['status' => 'failed', 'message' => 'Your email does not exist. Please register to continue.'];
        elseif($user->status != 1):
            return ['status' => 'failed', 'message' => 'You account has been deactivated. Please contact administrator.'];
        elseif(Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1])):
            return ['status' => 'success'];
        else:
            return ['status' => 'failed', 'message' =>  'Invalid login credentials. Please try again.'];
        endif;

    }

    public function register(Request $request)
    {
        $user = User::where('email', $request['email'])->get()->first();
        if($user):
            return ['status' => 'failed', 'message' => 'Your email already exist. Please login or use forgot password.'];
        else:
            $user  = User::Create(['email' => $request['email'],
                                    'name' => $request['name'],
                                    'user_role_id' => 1,
                                    'mobile' => $request['mobile'],
                                    'password' => Hash::make($request['password'])]);
            Auth::login($user);
            return ['status' => 'success'];
        endif;
    }

    public function forgotPassword(Request $data)
    {
       // return $data;
       
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        return ['status' => 'success'];

    }

    public function check()
    {
        if (isset(Auth::user()->id))
        {
            return ['status' => 'success'];
        }
        else {
            return ['status' => 'fail'];
        }
    }
}
