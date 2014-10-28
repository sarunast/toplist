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
            <h3 class="page-header" style="margin-bottom: 20px;">Manage your Servers</h3>
            @if (Session::has('flash_notice'))
            <div class="alert alert-success">{{ Session::get('flash_notice') }}</div>
            @endif
            <a class="btn btn-default" style="margin-bottom: 30px;" href="{{url('panel/top/create')}}">Add server</a>
            @if(count($servers))
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>IP</th>
                    <th>Port</th>
                    <th>Created At</th>
                    <th>Edit/Details/Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($servers as $server)
                <tr>
                    <td>{{{$server->title}}}</td>
                    <td>{{{$server->ip}}}</td>
                    <td>{{{$server->port}}}</td>
                    <td>{{{$server->created_at}}}</td>
                    <td>
                        {{ Form::open(array('url' => 'panel/top/'.$server->id,'method' => 'DELETE')) }}
                        <a class="btn btn-primary btn-small" href="{{url('panel/top/'.$server->id.'/edit')}}">Edit</a>
                        <a class="btn btn-primary btn-small" href="{{url($server->subcategory->path.'/'.$server->id.'/'.$server->slug)}}">Details</a>
                        <input class="btn btn-default btn-small" type="submit" value="Delete">
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-xs-8">
                    <div class="form-group">
                        <label style="margin-top: 7px" for="inputCategoryServer" class="col-xs-6 control-label">Select your Server to get HTML Code</label>
                        <div class="col-xs-6">
                            <select class="form-control" id="inputCategoryServer" name="subcategory_id" required>

                                @foreach($servers as $server)
                                <option subcategory-image="{{{$server->subcategory->path}}}" subcategory-name="{{{$server->subcategory->name}}}" value="{{url('/vote/'.$server->id)}}">{{{$server->title}}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p>Feel free to create your own banners or vote images if our does not fit your need. Your vote link is <strong><span id="vote""></span></strong></p>
                <div class="row" style="margin-top: 20px; margin-left: 5px">
                    <div class="col-xs-1">
                        <h4>Your Code</h4>
                    </div>
                    <div class="col-xs-9">

<pre><code class="html">&lt;!--Begin TamyTop Vote--&gt
<span class="cp">&lt;a href="<span id="vote""></span>"&gt;</span><span class="nt">
    &lt;img border="0" src="http://{{$_SERVER['SERVER_NAME']}}/top-img/<span id="image"></span>.jpg" alt="Vote for the <span id="subname"></span> - TamyTop"&gt;</span>
<span class="cp">&lt;/a&gt;</span>
&lt;!--End TamyTop Vote--&gt</code></pre>

                    </div>
                    <div class="col-xs-2">
                        <div class="well well-sm" style="background-color: #f5f5f5; border: 0">
                            <img style="border:1px solid lightgray;" id="banner" src="/top-img/san-andreas-mp.jpg">
                        </div>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@stop