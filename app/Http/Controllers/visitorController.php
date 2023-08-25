<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\User;

class visitorController extends Controller
{
    public function recordVisit(Request $request){
        $ip = $request->ip();
        $visitor = Visitor::firstOrCreate(['ip' => $ip]);
        $visitor->increment('visits');
        $visitor->save();

        $visitors = Visitor::count();

        return view('visitorRecord', compact('visitors'));

    }

    public function register(){

        return view('register');

    }


    public function save(Request $request){

        //المفروض فيه validation

        $name = $request -> name;
        $email = $request -> email;
        $password = $request -> password;


        $user = User::create([
         'name' => $name,
         'email' => $email,
         'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return view('success');
    }
}
