@extends('admin.register')


@section('register')
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" class="form-control form-control-user" name="Name" placeholder="姓名" autocomplete="off" required>
    </div>
    <div class="col-sm-6">
        <input type="text" class="form-control form-control-user" name="Phone" placeholder="電話" autocomplete="off" required>
    </div>
</div>

<div class="form-group">
    <input type="text" class="form-control form-control-user" name="Account" placeholder="帳號" autocomplete="off" required>
</div>

<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user" name="Passwd" placeholder="密碼" autocomplete="off" required>
    </div>
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user" name="Conf_Passwd" placeholder="確認密碼" autocomplete="off" required>
    </div>
</div>
<br>
<hr>
<br>
<button class="btn btn-primary btn-user btn-block" type="submit">送出</button>
@stop