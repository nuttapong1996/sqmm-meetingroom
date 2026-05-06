<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            $request->all(),
            [
                'empcode' => 'required|string'
            ],
            [
                'empcode.required' => 'กรุณากรอกรหัสพนักงานให้ถูกต้อง'
            ]
        );

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        $emp = Employee::where('code_emp', $request['empcode'])->first();


        if ($emp) {
            Auth::login($emp);
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->with('error', 'รหัสพนักงานไม่ถูกต้อง');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
