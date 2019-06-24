@extends('admin.main')

@section('head-name', "Dashboard")


@section('page-content')
    @if(isset($data))
        @for($i=0;$i<count($data);$i++)
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="6"><h4 class="text-success">{{Session::get('Month')[$i]}}月份</h4></th>
                    </tr>
                    <tr>
                        <th>身分證字號</th>
                        <th>請領金額</th>
                        <th>請領月份</th>
                        <th>里別</th>
                        <th>本號</th>
                        <th>請領時間</th>
                    </tr>
                </thead>
                <tbody>
                    @for($j=0;$j<count($data[$i]);$j++)
                        <tr>
                            <td>{{$data[$i][$j]['IDNum']}}</td>
                            <td>{{$data[$i][$j]['Price']}}</td>
                            <td>{{$data[$i][$j]['Month']}}</td>
                            <td>{{$data[$i][$j]['Village']}}</td>
                            <td>{{$data[$i][$j]['Num']}}</td>
                            <td>{{$data[$i][$j]['created_at']}}</td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-danger"><h5>剩餘金額</h5></td>
                        <th colspan="1" class="text-right text-danger"><h5>{{600-$sum[$i]['sum']}}</h5></td>
                    </tr>
                </tfoot>
            </table>
        @endfor
    @endif
@stop
