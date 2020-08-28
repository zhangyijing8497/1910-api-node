@extends('layouts.app')
@section('title', '前台')
@section('content')
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>找回密码</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form class="col s12" action="/back/pwds" method="post">
                        <div class="input-field">
                            <input type="text" name="email" class="validate" placeholder="请输入邮箱" required>
                        </div>
                        <input class="btn button-default" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
