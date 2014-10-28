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
            <ul class="activeUl">
                <li><a href="{{url('panel/website')}}">Main info</a></li>
                <li><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li  class="active"><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
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
            @if (Session::has('flash_notice'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('flash_notice') }}
            </div>
            @endif
            <ul class="nav nav-tabs nav-justified">
                <li><a href="{{url('panel/website')}}">Main info</a></li>
                <li><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li  class="active"><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
            <div class="row" style="padding-top: 30px" >
                <div class="col-xs-9">
                    {{ Form::open(array('url' => 'panel/website/header','class'=>'form-horizontal', 'id'=>'LoginForm' ,'method' => 'POST','files'=> true)) }}
                        <div class="form-group">
                            <label for="inputTitle" class="col-xs-3 control-label">Header Title</label>
                            <div class="col-xs-8">
                                <input type="text" name="title" value="{{{$webHeader->title}}}" class="form-control" id="inputTitle" minlength="3" maxlength="25" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSlogan" class="col-xs-3 control-label">Slogan</label>
                            <div class="col-xs-8">
                                <input type="text" name="slogan" value="{{{$webHeader->slogan}}}" class="form-control" id="inputSlogan" minlength="3" maxlength="35" placeholder="Slogan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputColor" class="col-xs-3 control-label">Text Color</label>
                            <div class="col-xs-8">
                                <input type="text" name="color" value="{{{$webHeader->color}}}" class="form-control" id="inputColor" maxlength="6" minlength="6" placeholder="Text Color Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSize" class="col-xs-3 control-label">Header Size in Pixels</label>
                            <div class="col-xs-8">
                                <input type="digits" name="size" value="{{{$webHeader->size}}}" class="form-control" id="inputSize" min="110" max="500" required placeholder="Size in Pixels">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputImage" class="col-xs-3 control-label" id="image">Header Image</label>

                            <div class="col-xs-5" style="padding-top: 10px">
                                <input id="inputImage" name="image" type="file">

                            </div>
                        </div>
                        <p class="text-info" style="padding-left: 150px; padding-top: 0;">
                            Image size must be at least 1173x110 pixels. GIF must be exactly 1173x110 pixels.
                        </p>
                        <div class="form-group">
                            <label for="inputCategory" class="col-xs-3 control-label">Header Panel Type</label>
                            <div class="col-xs-8">
                                <select class="form-control" id="inputCategory" name="panel">
                                    <option value="">Empty</option>
                                    @foreach($pageApps as $app)
                                    <option @if($app->identifier == $webHeader->panel) selected @endif value="{{{$app->identifier}}}">{{{$app->name}}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3"></div>
                            <div class="col-xs-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-default">Save Changes</button>
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