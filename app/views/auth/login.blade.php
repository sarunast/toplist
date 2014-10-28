@extends('layouts.empty_base')
@section('title')
TamyTop Login page
@stop
@section('body')
<div class="col-xs-3">

</div>
<div class="col-xs-6">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3>Login</h3>
            <form class="form-horizontal" id="LoginForm1" method="POST" action="{{ url('login') }}">
                <div class="form-group">
                    <label for="inputUsername" class="col-xs-2 control-label">Username</label>
                    <div class="col-xs-10">
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" minlength="4" maxlength="32" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-xs-2 control-label">Password</label>
                    <div class="col-xs-10">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" minlength="5" maxlength="100" required>
                        <div class="checkbox">
                            <label>
                                <input name="remember" value="true" type="checkbox"> Remember me
                            </label>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="Login" class="btn btn-default">
                        <a style="padding-left: 10px" href="{{url('remind')}}">Forgot your password?</a>
                        @if (Session::has('flash_error'))
                        <div id="flash_error">{{ Session::get('flash_error') }}</div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop