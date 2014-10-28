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
            <li class="active"><a href="{{url('panel/page')}}">Your Website</a></li>
            <ul class="activeUl">
                <li><a href="{{url('panel/website')}}">Main info</a></li>
                <li><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li class="active"><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
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
                <li class="active"><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
            <div class="row" style="padding-top: 30px" >
                <div class="col-xs-9">
                    {{ Form::open(array('url' => 'panel/website/pages/'.$page->id,'class'=>'form-horizontal', 'id'=>'LoginForm' ,'method' => 'PUT')) }}
                        <div class="form-group">
                            <label for="inputName" class="col-xs-3 control-label">Name</label>
                            <div class="col-xs-8">
                                <input type="text" name="name" value="{{{$page->name}}}" class="form-control" id="inputName" minlength="3" maxlength="25" required placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3"></div>
                            <div class="col-xs-8">
                                <div class="checkbox">
                                    <label>
                                        <input name="comments" @if($page->comments) checked @endif value="1" type="checkbox">Enable Comments
                                    </label>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-default">Change</button>
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