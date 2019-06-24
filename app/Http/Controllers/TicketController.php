<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    public function register(Request $request){
        $create = new User();
        $create->Account = $request->Account;
        $create->Passwd = encrypt($request->Passwd);
        $create->Name = $request->Name;
        $create->Phone = $request->Phone;
        $create->save();
        echo "<script>alert('註冊成功，請登入。');</script>";
        return redirect('login');
    }
    public function login(Request $request){
        $token = md5($this->time().$request->Account);
        User::where('Account',$request->Account)->update(['Token'=>$token]);
        Session::put('Token',$token);
        return redirect('/');
    }
    public function logout(){
        Session::flush();
        return redirect('/');
    }
    public function money(){
        return view('ticket/v_money');
    }
    public function time(){
        $mytime = Carbon\Carbon::now();
        return $mytime->toDateTimeString();
    }
}
