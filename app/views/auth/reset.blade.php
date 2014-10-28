@extends('layouts.empty_base')
@section('title')
TamyTop Remind page
@stop
@section('body')
<div class="col-xs-3"></div>
<div class="col-xs-6">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3>Reset password</h3>
            @if (Session::has('reason'))
            <div>{{ trans(Session::get('reason')) }}</div>
            @elseif (Session::has('success'))
            <p class="text-success">An e-mail with the password reset has been sent.</p>
            @endif
            <form class="form-horizontal" id="RegFormNext" method="POST">
                <input type="hidden" name="token" value="{{ $token }}">
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

                        <div class="form-group">
                        </div>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-default" value="Reset password">
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

