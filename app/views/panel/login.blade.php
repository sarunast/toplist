@extends('layouts.empty_base')
@section('title')
TamyTop User panel page
@stop
@section('body')
<div class="col-xs-3">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="{{url('panel')}}">Home</a></li>
            <li class="active"><a href="{{url('panel/login')}}">Login Settings</a></li>
            <li><a href="{{url('panel/top')}}">Manage your Servers</a></li>
            <li><a href="{{url('panel/website')}}">Your Website</a></li>
            <li><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>
    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>
</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <form class="form-horizontal" id="RegForm" method="POST" action="{{ url('panel/login') }}">
                <h3 class="page-header" style="margin-bottom: 50px;">Change password</h3>
                @if (Session::has('flash_notice'))
                <div class="alert alert-success">{{ Session::get('flash_notice') }}</div>
                @endif
                <div class="form-group">
                    <label for="inputPassword1" class="col-xs-3 control-label">Your Password</label>
                    <div class="col-xs-7">
                        <input type="password" name="current_password" class="form-control" id="inputPassword1" placeholder="Current Password" minlength="5" maxlength="100" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-xs-3 control-label">New Password</label>
                    <div class="col-xs-7">
                        <input type="password" id="password" name="password" class="form-control" id="inputPassword" placeholder="Password" minlength="5" maxlength="100" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputConPassword" class="col-xs-3 control-label">Confirm Password</label>
                    <div class="col-xs-7">
                        <input type="password" name="password_confirmation" class="form-control" id="inputConPassword" placeholder="Confirm Password" minlength="5" maxlength="100" required>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-7">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-default">Change Password</button>
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