@extends('layouts.empty_base')
@section('title')
TamyTop Login page
@stop
@section('body')
<div class="col-xs-3"></div>
<div class="col-xs-6">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3>Password reminder</h3>
            @if (Session::has('error'))
            <div class="">{{ trans(Session::get('reason')) }}</div>
            @elseif (Session::has('success'))
            <div class=""></div>
            <p class="text-success">An e-mail with the password reset has been sent.</p>

            @endif
            <form class="form-horizontal" id="LoginForm" method="POST">
                <div class="form-group">
                    <label for="inputEmail" class="col-xs-2 control-label">Email</label>
                    <div class="col-xs-10">
                        <input id="inputEmail" class="form-control" type="text" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-default" value="Send Reminder">
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