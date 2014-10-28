@extends('layouts.empty_base')
@section('title')
TamyTop User panel page
@stop
@section('body')
<div class="col-xs-3">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="{{url('panel')}}">Home</a></li>
            <li><a href="{{url('panel/login')}}">Login Settings</a></li>
            <li><a href="{{url('panel/top')}}">Manage your Servers</a></li>
            <li class="active"><a href="{{url('panel/website')}}">Your Website</a></li>
            <li><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>
    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>

</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="page-header">Your Website</h3>
            <div class="row">
                <div class="col-xs-9">
                    <form class="form-horizontal" method="POST" id="LoginForm" action="{{ url('panel/website') }}">
                        <div class="form-group">
                            <label for="inputPath" class="col-xs-4 control-label">http://[domain].TamyTop.com</label>
                            <div class="col-xs-8">
                                <input type="text" name="path" class="form-control" id="inputPath" minlength="3" maxlength="15" required placeholder="Select your Domain">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-xs-4 control-label">Title</label>
                            <div class="col-xs-8">
                                <input type="text" name="title" value="{{{Input::old('title')}}}" class="form-control" id="inputTitle" placeholder="SEO Title" minlength="15" maxlength="70" required>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-default" style="margin-top: 10px">Create Page</button>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop