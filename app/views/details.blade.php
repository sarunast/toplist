@extends('layouts.base')
@section('title')
{{{$server->title}}}, {{$subcategoryIn->name}} Information, Stats, Ranks - TamyTop
@stop
@section('description')
<meta name="description" content="{{{$server->title}}} - {{{$server->description}}}">
@stop
@section('body')
<div class="panel panel-info">
    <div class="panel-body">
        <h3 class="text-center">{{{$server->title}}}</h3>
        <hr style="margin-bottom: 8px" />
        <div class="row socialbuttons">
            <div class="col-xs-2">
                <div class="socialite facebook-like" data-href="{{url($subcategoryIn->path).'/'.$server->id}}" data-width="60" data-layout="button_count" data-show-faces="false" data-send="false"></div>
            </div>
            <div class="col-xs-1" style="margin-left: -45px; margin-right: 45px;">
                <div class="socialite googleplus-one" data-href="{{url($subcategoryIn->path).'/'.$server->id}}" data-size="medium"></div>
            </div>
            <div class="col-xs-2">
                <p>Rank: <strong>{{{$server->rank}}}</strong></p>
            </div>
            <div class="col-xs-2" >
                <p>Votes: <strong>{{{$server->votes}}}</strong></p>
            </div>
            <div class="col-xs-2" >
                <p>Clicks: <strong>{{{$server->clicks}}}</strong></p>
            </div>
            <div class="col-xs-3 text-right" >
                <a type="button" style="padding-top: 3px; padding-bottom: 3px; font-size: 10px;" href="{{url('vote/'.$server->id)}}" class="btn btn-info">Vote</a>
                <a type="button" style="padding-top: 3px; padding-bottom: 3px; font-size: 10px;" href="{{url('out/'.$server->id)}}" class="btn btn-info">Visit Website</a>


            </div>
        </div>

        <hr style="margin-top: 0; margin-bottom: 10px" />
        <div class="row">
            <div class="col-xs-3">
                <img @if($server->image) src="/uploads/{{$server->image}}" alt="{{$server->title}} - {{$subcategoryIn->name}} server" @else src="/default/{{$subcategoryIn->path}}.jpg" @endif>
            </div>
            <div class="col-xs-4" style="overflow: hidden">
                @if ($server->online)
                <p class="text-success no-margin">Server: Online</p>
                @else
                <p class="text-danger no-margin">Server: Offline</p>
                @endif
                <p class="no-margin" style="font-weight: bold">Title:</p>
                <p class="no-margin">{{{$server->title}}}</p>
                <p class="no-margin" style="font-weight: bold">Description:</p>
                <p>{{{$server->description}}}</p>
                <p style="font-weight: bold">Website: <a href="{{url('out/'.$server->id)}}" style="text-decoration: none">{{{$server->url}}}</a></p>
            </div>
            <div class="col-xs-5" style="overflow: hidden">
                @if (!empty($subcategoryIn->alias))
                    @if(count($general))
                        @if(isset($general['hostname']))
                        <p class="no-margin" style="font-weight: bold">Hostname:</p>
                        <p class="no-margin">{{{$general['hostname']}}}</p>
                        @endif
                        @if(isset($general['num_players']) && isset($general['max_players']))
                        <p class="no-margin"><strong>Players online: </strong> {{{$general['num_players'].'/'.$general['max_players']}}}</p>
                        @endif
                        @if(isset($general['map']))
                        <p><strong>Map: </strong>{{{$general['map']}}}</p>
                        @endif
                        <p><strong>Address: </strong>{{{$server->ip.':'.$server->port}}}</p>

                    @else
                        <p>Address: <strong>{{{$server->ip.':'.$server->port}}}</strong></p>
                        <p class="text-danger">Cannot reach server</p>
                    @endif
                @endif

            </div>
        </div>
        <h3>Statistics</h3>
        <div ng-app="statsApp">
            <div id="statsInfo"></div>
            <div ng-controller="StatisticsController" ng-init="load({{$server->id}})" class="row" id="statsDiv">
                <div class="col-xs-6">
                    <h4>Up time percent</h4>
                    <div id="online" style="height: 200px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Clicks</h4>
                    <div id="clicks" style="height: 200px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Votes</h4>
                    <div id="votes" style="height: 200px;"></div>
                </div>
                <div class="col-xs-6">
                    <h4>Rank</h4>
                    <div id="rank" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <hr/>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'tamytop'; // required: replace example with your forum shortname
            var disqus_identifier = '{{{$server->id}}}';
            var disqus_url = 'http://tamytop.com/{{{$subcategoryIn->path.'/'.$server->id}}}';
            var disqus_title = '{{{$server->title.' - '.$subcategoryIn->name}}}';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
</div>
@stop