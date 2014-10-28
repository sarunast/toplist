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
            <li><a href="{{url('panel/website')}}">Your Website</a></li>
            <li><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li class="active"><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>
    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>
</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="page-header">Statistics</h3>
            @if(count($servers))
            <div class="row">
                <div class="form-group">
                    <label style="margin-top: 7px" for="inputCategoryStatistics" class="col-xs-3 control-label">Select your Server</label>
                    <div class="col-xs-5">
                        <select class="form-control" id="inputCategoryStatistics" name="subcategory_id">
                            @foreach($servers as $server)
                            <option value="{{$server->id}}">{{{$server->title}}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="statsInfo"></div>
            <div class="row" id="statsDiv">
                <div class="col-xs-6">
                    <h4>Up time percent</h4>
                    <div id="online" style="height: 250px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Clicks</h4>
                    <div id="clicks" style="height: 250px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Votes</h4>
                    <div id="votes" style="height: 250px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Rank</h4>
                    <div id="rank" style="height: 250px;"></div>
                </div>
            </div>
            @else
            <p>You don't have any servers created. Click your tops and create one.</p>
            @endif
        </div>
    </div>
</div>
@stop