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
                <li class="active"><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
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
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li class="active"><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
            <div class="row">
                <form action="{{url('panel/website/navigation')}}" method="POST">
                <div class="col-xs-4">
                    <h4>Header Navigation</h4>
                    <hr/>

                        <div class="row no-margin" style="background-color: #f2f2f2;">
                            <div class="col-xs-6" style="padding-left: 5px">
                                <h5>App Name</h5>
                            </div>
                            <div class="col-xs-6">
                                <h5>Enable/Disable</h5>
                            </div>
                        </div>
                        <ul id="sortable">
                            @foreach($head as $item)
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <img src="{{url('move.png')}}">
                                    </div>
                                    <div class="col-xs-8">
                                        {{{$item->name}}}
                                    </div>
                                    <div class="col-xs-2">
                                        <label>
                                            <input name="sort[0][]" value="{{{$item->id}}}" @if($item->website_id) checked @endif type="checkbox">
                                        </label>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                </div>
                <div class="col-xs-4">
                    <h4>Side Navigation</h4>
                    <hr/>
                        <div class="row no-margin" style="background-color: #f2f2f2;">
                            <div class="col-xs-6" style="padding-left: 5px">
                                <h5>App Name</h5>
                            </div>
                            <div class="col-xs-6">
                                <h5>Enable/Disable</h5>
                            </div>
                        </div>
                        <ul id="sortable">
                            @foreach($side as $item)
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <img src="{{url('move.png')}}">
                                    </div>
                                    <div class="col-xs-8">
                                        {{{$item->name}}}
                                    </div>
                                    <div class="col-xs-2">
                                        <label>
                                            <input name="sort[1][]" value="{{{$item->id}}}" @if($item->website_id) checked @endif type="checkbox">
                                        </label>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                </div>
                <div class="col-xs-4">
                    <h4>Footer Navigation</h4>
                    <hr/>
                        <div class="row no-margin" style="background-color: #f2f2f2;">
                            <div class="col-xs-6" style="padding-left: 5px">
                                <h5>App Name</h5>
                            </div>
                            <div class="col-xs-6">
                                <h5>Enable/Disable</h5>
                            </div>
                        </div>
                        <ul id="sortable">
                            @foreach($footer as $item)
                            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <img src="{{url('move.png')}}">
                                    </div>
                                    <div class="col-xs-8">
                                        {{{$item->name}}}
                                    </div>
                                    <div class="col-xs-2">
                                        <label>
                                            <input name="sort[2][]" value="{{{$item->id}}}" @if($item->website_id) checked @endif type="checkbox">
                                        </label>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                </div>
                <div class=" row">
                    <div class="col-xs-8 text-right">
                    </div>
                    <div class="col-xs-4">
                        (Drag to change Order)
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="Save" class="btn btn-info">
                    </div>
                </div>
                </form>

            </div>

        </div>

    </div>
</div>
@stop