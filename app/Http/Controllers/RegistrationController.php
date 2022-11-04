<?php

namespace App\Http\Controllers;

use App\Jobs\ForgotPasswordJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\isEmpty;

class RegistrationController extends Controller
{
    public function login(Request $req)
    {
        // dd($req->email);    
        $user = DB::table('users')
            ->where('email', '=', $req->email)
            ->first();
        if (isset($user)) {
            if ($user->email == $req->input('email') && Hash::check($req->password, $user->password)) {
                session()->put('user', $user);
                return view('users', ['users' => $user]);
            } else {
                return view('login', ['error' => "Your Password is wrong"]);
            }
        }else{
            return view('login', ['error' => "Your Email is wrong"]);
        }
    }

    //User Registartion 
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "fname" => "required",
            "phone_number" => "required|digits_between:1,13",
            "email" => "required|email",
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            "password_confirmation" => "required",
        ]);
        
        $exist_email = User::where('email', '=', $req->email)->first();
        
        if($exist_email){
            return view('login', ['error' => "Sorry! This Email Already Exist"]);
        }
        
        if (!$validator->fails()) {
            DB::table('users')->insert([
                "name" => $req->fname,
                "phone_number" => $req->phone_number,
                "email" => $req->email,
                "password" => Hash::make($req->password),
            ]);
            return redirect('users');
        } else {
            return view('login', ['error' => $validator->errors()->first()]);
        }
    }

    public function adminLogin(Request $req)
    {
        $user = DB::table('users')
            ->where('email', '=', $req->email)
            ->orWhere('password', '=', $req->password)
            ->get();
        
        if (count($user) > 0) {
            if ($user[0]->email == $req->input('email') && Hash::check($req->password, $user[0]->password)) {

                if ($user[0]->role == 1) {
                    session()->put('user', $user);
                    return redirect('admin/data');
                } else {
                    return view('admin_login', ['error' => "You Are not admin"]);
                }
            } else {
                return view('admin_login', ['error' => "Your email And Password is wrong"]);
            }
        } else {
            return view('admin_login', ['error' => "User not exist"]);
        }
    }

    //Send user on Forgot Templet
    public function forgot()
    {
        return view('forgot');
    }

    //Send Email
    public function sendForgotEmail(Request $req)
    {
        // $user = DB::table('users')
        //     ->where('email', '=', $req->email)
        //     ->first();

        $user = User::where('email', '=', $req->email)->first();
        // $user = DB::table('users')->where('email', '=', $req->email)->first();
        // $user = $req->email;
        if ($user != null) {
            // Start Workder process Before sending email:-
            
            // dispatch(new ForgotPasswordJob($user));
            ForgotPasswordJob::dispatch($user)->delay(now()->addSecond(5));
            // Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect('https://mailtrap.io/inboxes/1828484/messages');
        } else {

            return redirect()->back()->withErrors(
                'Wrong password or this account not approved yet.',
            );
        }
    }

    public function sendOnRestPage()
    {
        return view('reset_password');
    }

    public function resetPassword(Request $req)
    {
        $validator =  Validator::make($req->all('password', 'password_confirmation'), [
            "password" => [
                "required", "confirmed", Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            "password_confirmation" => "required",
        ]);

        if (!$validator->fails()) {
            DB::table('users')
                ->where('email', '=', $req->email)
                ->update([
                    "password" => Hash::make($req->password),
                ]);
            return view('login', ['success' => "Your Password Successfully Changed"]);
        } else {
            return redirect()->back();
        }
    }

    //LogOut
    public function logout()
    {
        session()->forget('user');
        return redirect('/');
    }

    public function index()
    {
        // $users = DB::table('users')->get();
        return view('users');
    }
}
