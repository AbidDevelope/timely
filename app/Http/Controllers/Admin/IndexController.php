<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $data['users'] = User::all();
        return view('admin.users.users', $data);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->success('Admin logout Successfully');
        return redirect()->route('admin.login');
    }
}
