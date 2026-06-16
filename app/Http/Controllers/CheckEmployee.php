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
                'empcode' => 'required|string',
                'empBdate' => 'required|string'
            ],
            [
                'empcode.required' => 'กรุณากรอกรหัสพนักงานให้ถูกต้อง',
                'empBdate.required' => 'กรุณากรอกวันเดือนปีเกิดของท่าน'
            ]
        );

        $emp = Employee::query()
            ->where('code_emp', $request['empcode'])
            ->where('birdday_date_emp', $request['empBdate'])
            ->where('status_emp', 10)
            ->first();

        if ($emp) {
            Auth::login($emp);
            $request->session()->regenerate();
            Alert::html('เข้าสู่ระบบสำเร็จ' , 'ยินดีต้อนรับ<br>คุณ' .$emp['name_thai_emp'] , 'success');
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
