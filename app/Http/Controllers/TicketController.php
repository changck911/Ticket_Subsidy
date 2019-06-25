<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\Village;

use Carbon;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    public function register(Request $request)
    {
        $create = new User();
        $create->Account = $request->Account;
        $create->Passwd = encrypt($request->Passwd);
        $create->Name = $request->Name;
        $create->Phone = $request->Phone;
        $create->save();
        echo "<script>alert('註冊成功，請登入。');</script>";
        return redirect('login');
    }
    public function login(Request $request)
    {
        $query_user = User::where('Account', $request->Account)->get()->makeVisible(['Permission'])->toArray();
        $query_village = Village::where('UID', $query_user[0]['id'])->get()->toArray();
        $query_all_village = Village::select('Name')->get()->toArray();
        Session::put('UID', $query_user[0]['id']);
        Session::put('Name', $query_user[0]['Name']);
        Session::put('Permission', $query_user[0]['Permission']);
        $token = md5($this->time() . $request->Account);
        User::where('Account', $request->Account)->update(['Token' => $token]);
        Session::put('Token', $token);
        $village[0] = '';
        for($i=0;$i<count($query_village);$i++){
            $village[$i+1] = $query_village[$i]['Name'];
        }
        Session::put('Village',$village);
        Session::put('All_Village',$query_all_village);
        $this->calculate();
        return redirect('/');
    }
    public function change_passwd(Request $request){
        return view('ticket/v_change_passwd',['Passwd'=>encrypt($request->Passwd)]);
    }
    public function giant(){
        if(Session::get('Permission')==1){
            User::where('id',Session::get('UID'))->update(['Permission'=>2]);
            Session::put('Permission',2);
        } else if(Session::get('Permission')==2) {
            User::where('id',Session::get('UID'))->update(['Permission'=>1]);
            Session::put('Permission',1);
        }
        return redirect('/');
    }
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
    public function init_village(){
        $Name = ['中城里','啟模里','永昌里','國武里','泰昌里','大禹里','源城里','三民里','長良里','樂合里',
                 '松浦里','觀音里','東豐里','春日里','德武里'];
        for($i=0;$i<count($Name);$i++){
            $create = new Village();
            $create->Name = $Name[$i];
            $create->UID = 0;
            $create->save();
        }
    }
    public function money()
    {
        return view('ticket/v_money');
    }
    public function index()
    {
        if (Session::has('IDNum')) {
            for ($i = 0; $i < count(Session::get('Month')); $i++) {
                $query_tciket['data'][$i] = Ticket::where('IDNum', Session::get('IDNum'))->where('Month', Session::get('Month')[$i])->get()->toArray();
                $query_tciket['sum'][$i]['sum'] = 0;
                for ($j = 0; $j < count($query_tciket['data'][$i]); $j++) {
                    $query_tciket['sum'][$i]['sum'] += $query_tciket['data'][$i][$j]['Price'];
                }
            }
            return view('ticket/v_main', $query_tciket);
        } else {
            return view('ticket/v_main');
        }
    }
    public function search(Request $request)
    {
        Session::put('IDNum', $request->IDNum);
        for ($i = 0; $i < count(Session::get('Month')); $i++) {
            $query_tciket['data'][$i] = Ticket::where('IDNum', Session::get('IDNum'))->where('Month', Session::get('Month')[$i])->get()->toArray();
            $query_tciket['sum'][$i]['sum'] = 0;
            for ($j = 0; $j < count($query_tciket['data'][$i]); $j++) {
                $query_tciket['sum'][$i]['sum'] += $query_tciket['data'][$i][$j]['Price'];
            }
        }
        return view('ticket/v_main', $query_tciket);
    }
    public function new_ticket(Request $request)
    {
        $create = new Ticket();
        $create->IDNum = $request->IDNum;
        $create->Month = $request->Month;
        $create->Price = $request->Price;
        $create->Village = $request->Village;
        $create->Num = $request->Num;
        $create->save();
        return redirect('/main');
    }
    public function time()
    {
        $mytime = Carbon\Carbon::now();
        return $mytime->toDateTimeString();
    }
    public function calculate()
    {
        $slit_time = explode("-", date("Y-m-d"));
        $month = (int)$slit_time[1];
        if ($month == 1) {
            $month_array = [10, 11, 12];
        } else if ($month == 2) {
            $month_array = [1];
        } else if ($month == 3) {
            $month_array = [1, 2];
        } else if ($month >= 4) {
            $month_array = [$month - 3, $month - 2, $month - 1];
        }
        Session::put('Month', $month_array);
    }
}
