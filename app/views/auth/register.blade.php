@extends('layouts.empty_base')
@section('title')
TamyTop Register page
@stop
@section('body')
<div class="col-xs-3">

</div>
<div class="col-xs-6">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3>Register</h3>
            <form class="form-horizontal" method="POST" id="RegFormNext" action="{{ url('register') }}">
                <div class="form-group">
                    <label for="inputUsername" class="col-xs-2 control-label">Username</label>
                    <div class="col-xs-10">
                        <input type="text" value="{{{Input::old('username')}}}" name="username" class="form-control" id="inputUsername" minlength="4" maxlength="32" required placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-xs-2 control-label">Email</label>
                    <div class="col-xs-10">
                        <input name="email" value="{{{Input::old('email')}}}" class="form-control" id="inputEmail" placeholder="Email" type="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-xs-2 control-label">Password</label>
                    <div class="col-xs-10">
                        <input type="password" id="password1" name="password" class="form-control" id="inputPassword" placeholder="Password" minlength="5" maxlength="100" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputConPassword" class="col-xs-2 control-label">Confirm Password</label>
                    <div class="col-xs-10">
                        <input type="password" name="password_confirmation" equalTo="password" class="form-control" id="inputConPassword" placeholder="Confirm Password" minlength="5" maxlength="100" required>
                        <div class="checkbox">
                            <label>
                                <input CHECKED name="subscription" type="checkbox" value="1"> Receive important updates
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input CHECKED name="terms" type="checkbox" required> Agree with terms and conditions
                            </label>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-default">Sign in</button>
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop