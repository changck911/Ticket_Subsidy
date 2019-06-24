@extends('admin.login')


@section('title', '登入')


@section('content')
<br><br><br>
<div class="form-group">
    <input type="text" class="form-control form-control-user" name="Account" aria-describedby="emailHelp" placeholder="ID"
        autocomplete="off" required>
</div>
<div class="form-group">
    <input type="password" class="form-control form-control-user" name="Passwd" placeholder="Password"
        autocomplete="off" required>
</div>
<br><br>
<button type="submit" class="btn btn-primary btn-user btn-block">登入</button>
<br><br><br>
@stop