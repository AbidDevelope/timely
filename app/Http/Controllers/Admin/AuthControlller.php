<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class AuthControlller extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        
        $credentials = $request->only('email', 'password');
    
        if(Auth::guard('admin')->attempt($credentials))
        {
            $admin = Auth::guard('admin')->user();
            $request->session()->put('id', $admin->id);

            flash()->success('Admin Login');
            return redirect()->route('admin.dashboard');
        }else{
            flash()->error('Credential Invalid');
            return redirect()->back();
        }
    }

    public function profile()
    {
        return view('admin.profile.profile');
    }
}
