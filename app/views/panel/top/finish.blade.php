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
            <h3 class="page-header" style="margin-bottom: 20px;">Add server</h3>
            <div class="row fuelux">
                <div id="MyWizard" class="wizard">
                    <ul class="steps">
                        <li style="color: #468847;"><span class="badge badge-info">1</span>Basic Info<span style="" class="chevron"></span></li>
                        <li style="color: #468847;"><span class="badge">2</span>Server Info<span class="chevron"></span></li>
                        <li style="color: #468847;"><span class="badge">3</span>Image (Optional)<span class="chevron"></span></li>
                        <li class="active"><span class="badge">4</span>Your HTML<span class="chevron"></span></li>
                    </ul>
                </div>
                <div class="col-xs-12" style="padding-top: 20px">
                    <p>You are almost finished, only one last step is left. In order to reach the best results we recommend to add this HTML code which was generated just for you. It is a small image with a link to your vote page it should allow you to increase your rating. After all to be number 1 in rating system you will need get some votes for your server.</p>
                    <p>Feel free to create your own banners or vote images if our does not fit your need. Your vote link is <strong>http://{{$_SERVER['SERVER_NAME'].'/vote/'.$server->id}}</strong></p>
                    <div class="row" style="margin-top: 20px; margin-left: 5px">
                        <div class="col-xs-1">
                            <h4>Your Code</h4>
                        </div>
                        <div class="col-xs-9">

<pre><code class="html">&lt;!--Begin TamyTop Vote--&gt
<span class="cp">&lt;a href="http://{{$_SERVER['SERVER_NAME'].'/vote/'.$server->id}}"&gt;</span>
    <span class="nt">&lt;img border="0" src="http://{{$_SERVER['SERVER_NAME'].'/top-img/'.$server->subcategory->path}}.jpg" alt="Vote for the {{$server->subcategory->name}} - TamyTop"&gt;</span>
<span class="cp">&lt;/a&gt;</span>
&lt;!--End TamyTop Vote--&gt</code></pre>

                        </div>


                        <div class="col-xs-2">
                            <div class="well well-sm" style="background-color: #f5f5f5; border: 0">
                                <img style="border:1px solid lightgray;" id="banner" src="/top-img/{{$server->subcategory->path}}.jpg">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-2" style="padding-left: 35px">
                    <a class="btn btn-info" href="{{url('panel/top')}}">Finish</a>
                </div>

            </div>
        </div>
    </div>
</div>
@stop