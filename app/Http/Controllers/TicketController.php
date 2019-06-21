<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return view('ticket/v_login');
    }
    public function main(){
        return view('ticket/v_main');
    }
    public function money(){
        return view('ticket/v_money');
    }
}
