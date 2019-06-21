<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TicketController extends Controller
{
    public function index(){
        return view('ticket/v_login');
    }
    public function register(){
        return view('ticket/v_register');
    }
    public function main(){
        return view('ticket/v_main');
    }
    public function money(){
        return view('ticket/v_money');
    }
    public function db_test(){
        $create = new User();
        $create->Account = "test";
        $create->Passwd = encrypt("test");
        $create->Name = "test";
        $create->Phone = "test";
        $create->save();
        return $create;
    }
}
