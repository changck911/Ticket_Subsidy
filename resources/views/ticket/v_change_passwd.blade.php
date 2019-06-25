@extends('admin.main')

@section('head-name', "更改密碼")


@section('page-content')
    <p>
        請將下列字串ＯＡ給車票業務承辦人員
    </p>
    <p>
        <textarea class="form-control" rows="5" id="comment" readonly>{{$Passwd}}</textarea>
    </p>
    @for($i=0;$i<11;$i++)
        <br>
    @endfor
@stop
