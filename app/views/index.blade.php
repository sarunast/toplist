@extends('layouts.base')
@section('title')
MMO and FPS servers Top, games list and ranking website - TamyTop
@stop

@section('description')
<meta name="description" content="TamyTop is game ranking and server monitoring website for MMO and FPS games. We provide monthly statistics for servers, such as uptime, clicks, votes and rankings.">
@stop

@section('body')
<div class="modal fade"  id="discus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Comments</h4>
            </div>
            <div class="modal-body">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'tamytop'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@if (Session::has('flash_notice'))
<div class="alert alert-success" style="background-color: #f5f5f5; padding: 5px; margin-right: -15px;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('flash_notice') }}
</div>
@endif
<div class="text-center">
    <h3 style="margin-top: 0">Top Servers From Each Category</h3>
    <hr/>
</div>

<div id="statictop">
    <div class="row">
        @foreach($indexServers as $server)
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel text-center panel-info" style="margin-right: -15px; margin-bottom: 1px">
                        <div class="panel-body" style="padding: 0">
                            <h4><a href="{{url($server->subcategory->path)}}" style="text-decoration: none;color: #2F4F4F">{{$server->subcategory->name}}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="parent" class="col-xs-12" style="margin-bottom: 20px;">

                    <div class="row" style="padding: 0;">
                        <div class="col-xs-6">
                            <div class="shadow" style=" height: 170px; width: 210px; overflow: hidden; @if($server->image) background-image:url('/uploads/{{$server->image}}') @else background-image:url('/default/{{$server->subcategory->path}}.jpg') @endif">
                                <div style="background:rgba(0, 0, 0, 0.3); height: 26px">
                                    <div class="row">
                                        <div class="col-xs-5" style="z-index: 12">
                                            <h3 class="no-margin" style="padding-left: 5px; color: white"><small><a style="color: lightgray;font-size: 12px; padding-left: 3px;" href="{{url($server->subcategory->path)}}/{{$server->id}}/{{$server->slug}}">Details</a></small></h3>
                                        </div>
                                        <div class="col-xs-7 text-right" id="listtooltip">
                                            @if ($server->online)
                                            <img src="/pic/green.png" alt="Server Online" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Online">
                                            @else
                                            <img src="/pic/red.png" alt="Server Offline" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Offline">
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <a class="divlink" href="/out/{{$server->id}}"></a>
                                <div id="child" class="row" style="position: absolute; top: 148px; opacity:0.2">

                                    <div class="col-xs-5" style=" padding-left: 35px;">
                                        <div class="socialite googleplus-one" data-href="{{url($server->subcategory->path).'/'.$server->id}}" data-size="medium"></div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="socialite facebook-like" data-href="{{url($server->subcategory->path).'/'.$server->id}}" data-width="60" data-layout="button_count" data-show-faces="false" data-send="false"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 shadow" style="background-color:white">
                            <div class="row" style="height: 150px;">
                                <div class="col-xs-12" style="overflow: hidden">
                                    <strong>{{{$server->title}}}</strong>
                                    <p>{{{$server->description}}}</p>
                                </div>
                            </div>
                            <div class="row" style="height: 20px;">
                                <a href="vote/{{{$server->id}}}">
                                    <div class="col-xs-7"id="listhref" >Votes: {{{$server->votes}}}</div>
                                </a>
                                <a class="text-right" data-toggle="modal" href="#discus" id="resetDisqus" server-id="{{{$server->id}}}" server-title="{{{$server->title.' - '.$server->subcategory->name}}}" server-url="{{{Request::url().'/'.$server->subcategory->path}}}">
                                    <div class="col-xs-5 text-right" id="listhref">Comments</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@stop