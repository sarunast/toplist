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
                <li class="active"><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
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
                <li class="active"><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>

            <div class="row" style="padding-top: 20px">
                <div class="col-xs-12">
                    <form action="{{url('panel/website/app')}}" method="POST">
                        <div class="row no-margin" style="background-color: #f2f2f2;">
                            <div class="col-xs-9" style="padding-left: 70px">
                                <h4>App Name</h4>
                            </div>
                            <div class="col-xs-2" style="padding-left: 30px">
                                <h4>Enable/Disable</h4>
                            </div>
                        </div>
                        <ul id="sortable">
                            @foreach($navApps as $app)
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <img src="{{url('move.png')}}">
                                    </div>
                                    <div class="col-xs-9">
                                        {{{$app->name}}}
                                    </div>
                                    <div class="col-xs-2">
                                        <label>
                                            <input name="sort[]" value="{{{$app->id}}}" @if($app->position) checked @endif type="checkbox">
                                        </label>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class=" row">
                            <div class="col-xs-3 text-right">
                                (Drag to change Order)
                            </div>
                            <div class="col-xs-8 text-right" style="padding-right: 30px">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="Save" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@stop