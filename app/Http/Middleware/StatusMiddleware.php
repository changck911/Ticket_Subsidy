<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class StatusMiddleware
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
        if (Session::has('id') && Session::has('Token')) {
            switch ($this->verify_status(Session::get('id'), Session::get('Token'))) {
                case 0:
                    echo "<script>alert('權杖失效，請重新登入');</script>";
                    Session::flush();
                    return redirect('/login');
                    break;
                case 200:
                    return $next($request);
                default:
                    echo "<script>alert('錯誤，請重新操作！');</script>";
                    Session::flush();
                    return redirect('/login');
                    break;
            }
        } else {
            return redirect('/login');
        }
    }
    public function verify_status($id, $token)
    {
        $query_user = User::where('id', $id)->get()->makeVisible(['Token'])->toArray();
        if ($query_user) {
            if ($query_user[0]['Token'] == $token) {
                return 200;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
