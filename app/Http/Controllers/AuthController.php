<?php

namespace App\Http\Controllers;

use App\Jobs\SendRegisterMail;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index(Request $request){
        if(Auth::check()){
            return redirect()->route("home");
        }

       return view("login");
    }

    public function login_action(Request $request){

        $validators = $request->validate([
            "email"=> "required|email",
            "password"=> "required|min:6"
        ]);

      if(Auth::attempt($validators)){
        return redirect()->route('home');
      }

      return back()->withErrors([
        'failed' => 'E-mail e/ou Senha Incorretos.',
      ]);

    }

    public function register(Request $request){

        if(Auth::check()){
            return redirect()->route("home");
        }

        return view("register");
    }

    public function register_action(Request $request){

        $request->validate([
            "name"=> "required",
            "email"=> "required|email|unique:users",
            "password"=> "required|min:6|confirmed",
        ]);

        $dados = $request->only("name", "email","password");
        $dados['password'] = Hash::make($request->password);
        $createdUser = User::create($dados);

        SendRegisterMail::dispatch($createdUser);
        return redirect(route("login"));
    }

    public function logout(){
        Auth::logout();
        return redirect(route("login"));
    }
}
