<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Hash;



class updatePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    function update(Request $req){
        
        
        $req->validate([
            'current_password'=>['required',new CurrentPassword],
            'password'=>['required','string','min:8','confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('profile')->with('success_pass_update',"1");
    }
}
