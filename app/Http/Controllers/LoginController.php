<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $roleId = $user->role_id;
    
            switch ($roleId) {
                case 1:
                    return redirect()->route('admin_pusat.dashboard');
                    break;
                case 2:
                    return redirect()->route('ppq.dashboard');
                    break;
                case 3:
                    return redirect()->route('admin_unit.dashboard');
                    break;
                case 4:
                    return redirect()->route('guru_quran.dashboard');
                    break;
                default:
                    return redirect()->route('welcome');
            }
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function index()
    {
        $data = [];

        return view('welcome', compact('data'));
    }
}
