@extends('layouts.empty_base')
@section('title')
User Panel - TamyTop
@stop
@section('body')
<div class="col-xs-3">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="{{url('panel')}}">Home</a></li>
            <li><a href="{{url('panel/login')}}">Login Settings</a></li>
            <li><a href="{{url('panel/top')}}">Your Top Lists</a></li>
            <li><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>

    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>
</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="page-header">Thank you for choosing TamyTop</h3>
            <p>
                For more information about our services check out our Affiliate and advertise Sections.
            </p>
            <p>
                To get started click on  “Your Top Lists” and create your top by clicking “Create Top.”
            </p>
        </div>
    </div>
</div>
@stop