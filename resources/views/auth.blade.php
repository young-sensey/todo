@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form">
        <form id="form-login" class="form-horizontal" role="form" method="POST" action="javascript:login();">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="inputLogin" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Логин" name="login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Пароль" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-sm">Войти</button>
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function login() {
        $.ajax({
            data: $('#form-login').serialize(),
            url: '{{ route("login") }}',
            type: "POST",
            dataType: 'json',
            success: function (data) {
                let resultDiv = document.getElementById('result');
                if (data.status === false) {
                    resultDiv.innerHTML = '<div class="alert alert-danger">' + data.error + '</div>';
                } else {
                    document.location.href = '{{ route("task.index") }}';
                }
            },
            error: function () {
                let resultDiv = document.getElementById('result');
                resultDiv.innerHTML = '<div class="alert alert-danger">Неверный логин или пароль</div>';
            }
        });
    }
</script>
<style>
    .form form {
        width: 400px;
        margin: 0 auto;
        padding-top: 20px;
    }
</style>
@endsection
