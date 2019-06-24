<?php

namespace App\Http\Middleware;

use Closure;
use App\Ticket;
use Illuminate\Support\Facades\Session;

class TicketMiddleware
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
        switch ($this->verify_idnum($request->IDNum)) {
            case '1':
                echo "<script>alert('身分證字號錯誤！！！');</script>";
                return redirect('/');
                break;
            case '0':
                Session::put('IDNum',$request->IDNum);
                if ($request->has('Price')){
                    $result = $this->verify_price($request->IDNum,$request->Price,$request->Month);
                    if($result){
                        echo "<script>alert('超過請領金額，剩餘".$result."元！！！');</script>";
                        return redirect('/');
                    } else{
                        return $next($request);
                    }
                } else{
                    return $next($request);
                }
                break;

            default:
                echo "<script>alert('錯誤，請重新操作！');</script>";
                Session::flush();
                return redirect('/login');
                break;
        }
    }
    public function verify_idnum($IDNum)
    {
        if (strlen($IDNum) != 10) {
            return 1;
        } else {
            $sum = 0;
            $First = [
                'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => '14', 'F' => '15', 'G' => '16', 'H' => '17', 'I' => '34',
                'J' => '18', 'K' => '19', 'L' => '20', 'M' => '21', 'N' => '22', 'O' => '35', 'P' => '23', 'Q' => '24', 'R' => '25',
                'S' => '26', 'T' => '27', 'U' => '28', 'V' => '29', 'W' => '32', 'X' => '30', 'Y' => '31', 'Z' => '33'
            ];
            $first_word = substr($IDNum, 0, 1);
            $first_word = $First[$first_word];
            $sum += $first_word[0] + $first_word[1] * 9;
            for ($i = 1; $i < strlen($IDNum) - 1; $i++) {
                $sum += (substr($IDNum, $i, 1) * (9 - $i));
            }
            $sum += substr($IDNum, 9, 1);
            if ($sum % 10) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function verify_price($IDNum, $Price, $Month)
    {
        $query_ticket = Ticket::where('IDNum', $IDNum)->where('Month',$Month)->get()->toArray();
        $sum = 0;
        for ($i = 0; $i < count($query_ticket); $i++) {
            $sum += $query_ticket[$i]['Price'];
        }
        if ($sum + $Price > 600) {
            return 600-$sum;
        } else {
            return 0;
        }
    }
}
