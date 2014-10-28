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
            <li class="active"><a href="{{url('panel/top')}}">Manage your Servers</a></li>
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
            <h3 class="page-header" style="margin-bottom: 20px;">Edit server</h3>
            <div class="row">

                <div class="col-xs-8">
                    {{ Form::open(array('url' => 'panel/top/'.$server->id,'class'=>'form-horizontal', 'id'=>'LoginForm' ,'method' => 'PUT','files'=> true)) }}

                    <div class="form-group">
                        <label for="inputTitle" class="col-xs-3 control-label">Title</label>
                        <div class="col-xs-9">
                            <input class="form-control" value="{{{$server->title}}}" id="inputTitle" name="title" placeholder="Short title" minlength="3" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUrl" class="col-xs-3 control-label">Website URL</label>
                        <div class="col-xs-9">
                            <input class="form-control" id="inputUrl" name="url" type="url" placeholder="Website URL" value="{{{$server->url}}}" minlength="5" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImage" class="col-xs-3 control-label">Upload Image</label>
                        <div class="col-xs-5">
                            <input id="inputImage" name="image" type="file">

                        </div>
                    </div>
                    <p class="text-info" style="padding-left: 150px; padding-top: 0;">
                        Image size must be at least 210x170 pixels. GIF must be exactly 210x170 pixels.
                    </p>
                    <div class="form-group">
                        <label for="inputIP" class="col-xs-3 control-label">Server IP</label>
                        <div class="col-xs-9">
                            <input class="form-control"  value="{{{$server->ip}}}" id="inputIP" name="ip" placeholder="IP address" minlength="5" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPort" class="col-xs-3 control-label">Server Port</label>
                        <div class="col-xs-9">
                            <input class="form-control" type="digits" value="{{{$server->port}}}" id="inputPort" name="port" placeholder="Server Port" maxlength="5" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-xs-3 control-label">Description</label>
                        <div class="col-xs-9">
                            <textarea class="form-control" rows="3" id="inputDescription" name="description" placeholder="Short Description" minlength="5" maxlength="110" required>{{{$server->description}}}</textarea></br>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="Save" class="btn btn-default">
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach

                        </div>

                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
</div>
@stop