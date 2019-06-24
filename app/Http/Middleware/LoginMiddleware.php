<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\User;
use Session;

class LoginMiddleware
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
        switch ($this->verify_login($request)) {
            case 1:
                echo "<script>alert('帳號或密碼錯誤');</script>";
                break;
            case 200:
                return $next($request);
                break;

            default:
                echo "<script>alert('錯誤，請重新操作！');</script>";
                break;
        }
        return redirect('/login');
    }

    public function verify_login($request)
    {
        $query_user = User::where('Account', $request->Account)->get()->makeVisible(['Passwd'])->toArray();
        if (count($query_user)) {
            if (decrypt($query_user[0]['Passwd']) == $request->Passwd) {
                Session::put('id', $query_user[0]['id']);
                return 200;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }
}
