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
            @if($userPage)
            <ul class="activeUl">
                <li class="active"><a href="{{url('panel/website')}}">Main info</a></li>
                <li><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
            @endif
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
            @if($userPage)
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="{{url('panel/website')}}">Main info</a></li>
                <li><a href="{{url('panel/website/widgets')}}">Side Widgets</a></li>
                <li><a href="{{url('panel/website/pages')}}">Pages</a></li>
                <li><a href="{{url('panel/website/navigation')}}">Navigation's</a></li>
                <li><a href="{{url('panel/website/header')}}">Customize Header</a></li>
            </ul>
            <div class="row" style="padding-top: 20px;">
                <div class="col-xs-6">
                    Your website url: <a style="font-weight: bold" href="http://{{{$userPage->path}}}.tamytop.com">http://{{{$userPage->path}}}.tamytop.com</a>
                </div>
                <div class="col-xs-6 text-right">
                    Login to Edit: <a style="font-weight: bold" href="http://{{{$userPage->path}}}.tamytop.com">http://{{{$userPage->path}}}.tamytop.com/login</a>
                </div>
            </div>

            <div class="row" style="padding-top: 30px" >
                <div class="col-xs-7">
                    <h4>Basic Info</h4>
                    <hr/>
                    <form class="form-horizontal" method="POST" id="LoginForm" action="{{ url('panel/website/edit') }}">
                        <div class="form-group">
                            <label for="inputPath" class="col-xs-5 control-label">TamyTop.com/page/</label>
                            <div class="col-xs-7">
                                <input type="text" value="{{{$userPage->path}}}" name="path" class="form-control" id="inputPath" minlength="3" maxlength="15" required placeholder="Path">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-xs-5 control-label">Title</label>
                            <div class="col-xs-7">
                                <input type="text" name="title" value="{{{$userPage->title}}}" class="form-control" id="inputTitle" placeholder="SEO Title" minlength="15" maxlength="70" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPaypal" class="col-xs-5 control-label">Paypal email</label>
                            <div class="col-xs-7">
                                <input type="email" name="paypal_email" value="{{{$userPage->paypal_email}}}" class="form-control" id="inputPaypal" placeholder="Your Paypal email for Donations" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-xs-5 control-label">Contact email</label>
                            <div class="col-xs-7">
                                <input type="email" name="email" value="{{{$userPage->email}}}" class="form-control" id="inputEmail" placeholder="Contact email" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFacebook" class="col-xs-5 control-label">Facebook</label>
                            <div class="col-xs-7">
                                <input type="url" name="facebook" value="{{{$social->facebook}}}" class="form-control" id="inputFacebook" minlength="5" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputGplus" class="col-xs-5 control-label">Google plus</label>
                            <div class="col-xs-7">
                                <input type="url" name="gplus" value="{{{$social->gplus}}}" class="form-control" id="inputGplus" minlength="5" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTwitter" class="col-xs-5 control-label">Twitter Follow</label>
                            <div class="col-xs-7">
                                <input type="url" name="twitter" value="{{{$social->twitter}}}" class="form-control" id="inputTwitter" minlength="5" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5"></div>
                            <div class="col-xs-7">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-default">Change</button>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-5">
                    <h4>Connect Server With Website</h4>
                    <hr/>
                    {{ Form::open(array('url' => 'panel/website/server','method' => 'POST')) }}
                    <div class="input-group">
                        <select class="form-control" name="server">
                            <option value="">Select server:</option>
                            @foreach($allServers as $server)
                            <option value="{{{$server->id}}}">{{{$server->title}}}</option>
                            @endforeach
                        </select>
                        <span class="input-group-btn">
                            <input class="btn btn-small btn-success" type="submit" value="Add Server">
                        </span>
                    </div>
                    {{ Form::close() }}
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Server Name</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($servers as $server)
                        <tr>
                            <td>{{{$server->server->title}}}</td>
                            <td>
                                {{ Form::open(array('url' => 'panel/website/server/'.$server->id,'method' => 'POST')) }}
                                <input class="btn btn-default btn-small" type="submit" value="Delete">
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            @else
            <h4>Spend less time Developing the WEB and more your SERVER</h4>
            <p>You want to create website for your server, but you do not know HTML, PHP or any other WEB programming language?
                You do not have to worry anymore, because we can provide website for you server free of charge. You will get your
                own link, statistics for you servers and many more cool widgets that will relief your life in WEB world.</p>
            <p>Try it our right now! click "Create Your Website" and you will have your own website in less than a minute.</p>
            <a class="btn btn-default btn-success" href="{{url('panel/website/create')}}">Create Your Website</a>
            @endif
        </div>

    </div>
</div>
@stop