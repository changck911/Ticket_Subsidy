<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    }
    public function main(){
        return view('ticket/v_main');
    }
    public function money(){
        return view('ticket/v_money');
    }
    public function db_test(){
        $create = User::where('id',1)->get()->makeVisible(['Passwd'])->toArray();
        
        print_r(decrypt($create[0]['Passwd']));
    }
}
