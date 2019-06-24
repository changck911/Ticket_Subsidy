<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Block;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class RegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($this->check($request)) {
            case -1:
                echo "<script>alert('非註冊時間');</script>";
                return redirect('login');
                break;
            case 1:
                echo "<script>alert('資料不得為空');</script>";
                break;
            case 2:
                echo "<script>alert('帳號重複');</script>";
                break;
            case 3:
                echo "<script>alert('密碼不吻合');</script>";
                break;

            default:
                return $next($request);
                break;
        }
        return redirect('register');
    }
    public function check($request)
    {
        $query_status = Block::where('Name','register')->get()->toArray();
        if(count($query_status)){
            if($query_status[0]['Status']==1){
                if ($request->Account == "" || $request->Name == "" || $request->Phone == "" || $request->Passwd == "" || $request->Conf_Passwd == "") {
                    return 1;
                } else {
                    $query_user = User::where('Account', $request->Account)->get()->toArray();
                    if (count($query_user)) {
                        return 2;
                    } else {
                        if ($request->Passwd != $request->Conf_Passwd) {
                            return 3;
                        }
                    }
                }
            } else{
                return -1;
            }
        } else{
            return -1;
        }
    }
}
