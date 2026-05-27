<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CheckEmployee extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate(
            [
                'empcode' => 'required|string'
            ],
            [
                'empcode.required' => 'กรุณากรอกรหัสพนักงานให้ถูกต้อง'
            ]
        );

        $emp = Employee::query()->where('code_emp', $request['empcode'])->first();

        if ($emp) {
            Auth::login($emp);
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        Alert('รหัสพนักงานไม่ถูกต้อง', 'กรุณาตรวจสอบ', 'error');
        return back()->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
