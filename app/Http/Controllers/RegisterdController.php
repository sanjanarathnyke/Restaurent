<?php

namespace App\Http\Controllers;

use App\Models\Registerd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterdController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'|'string'|'max:255',
            'email' => 'required|email|unique:registered,email',
            'password'=>'required'|'min:6'
        ]);

        Registerd::created([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password'))
        ]);

        return redirect()->back()->with('sucess','Registerd success');
    }
}
