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
            <a style="margin-top: 20px;" href="{{url('panel/website/pages/create')}}" class="btn btn-success">Create Page</a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Type</th>
                    <th>Comments</th>
                    <th>Created At</th>
                    <th>View/Edit/Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{{$page->name}}}</td>
                    <td>{{{$page->path}}}</td>
                    <td>{{{$page->website_app}}}</td>
                    <td>@if($page->comments) On @else Off @endif</td>
                    <td>{{{$page->created_at}}}</td>
                    <td>
                        {{ Form::open(array('url' => 'panel/website/pages/'.$page->id,'method' => 'DELETE')) }}
                        <a class="btn btn-info btn-small" href="http://{{{$pagePath->path.'.tamytop.com/'.$page->path}}}">View</a>
                        <a class="btn btn-primary btn-small" href="{{url('panel/website/pages/'.$page->id.'/edit')}}">Edit</a>
                        <input class="btn btn-default btn-small" type="submit" value="Delete">
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@stop