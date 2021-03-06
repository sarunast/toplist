@extends('layouts.top_base')
@section('title')
{{$subcategory->name}} Top Server List. {{$subcategory->title}} Stats, Ranks - TamyTop
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
<!--<h4 class="text-center">{{$subcategory->name}} Top</h4>-->
<div id="statictop">
    <div class="row toplistdiv">
        @foreach($servers as $server)
            <div class="col-xs-6" id="parent" style="margin-bottom: 20px;">

                <div class="row" style="padding: 0;">
                    <div class="col-xs-6">
                        <div class="shadow" style=" height: 170px; width: 210px; overflow: hidden; @if($server->image) background-image:url('/uploads/{{$server->image}}') @else background-image:url('/default/{{$subcategory->path}}.jpg') @endif">
                            <div style="background:rgba(0, 0, 0, 0.3);height: 26px">
                                <div class="row">
                                    <div class="col-xs-5" style="z-index: 12">
                                        <h3 class="no-margin" style="padding-left: 5px; color: white">{{$server->rank}}<small><a style="color: lightgray;font-size: 12px; padding-left: 3px;" href="{{url($subcategory->path)}}/{{$server->id}}/{{$server->slug}}">Details</a></small></h3>
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
                                    <div class="socialite googleplus-one" data-href="{{Request::url().'/'.$server->id}}" data-size="medium"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="socialite facebook-like" data-href="{{Request::url().'/'.$server->id}}" data-width="60" data-layout="button_count" data-show-faces="false" data-send="false"></div>
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
                                <div class="col-xs-7" id="listhref">Votes: {{{$server->votes}}}</div>
                            </a>
                            <a class="text-right" data-toggle="modal" href="#discus" id="resetDisqus" server-id="{{{$server->id}}}" server-title="{{{$server->title.' - '.$subcategory->name}}}" server-url="{{{Request::url()}}}">
                            <div class="col-xs-5 text-right" id="listhref">Comments</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($servers) != 50)
    <noscript>
        <div class="row" style="margin-left: 0">
            <div class="panel text-center panel-info">
                <div class="panel-body">
                    <h4 class="no-margin">Page end</h4>
                </div>
            </div>
        </div>
    </noscript>
    @else
    <noscript>
        <div class="row" style="margin-left: 0">
            <div class="panel text-center panel-info">
                <div class="panel-body" style="padding: 0">
                    {{$servers->links()}}
                </div>
            </div>
        </div>
    </noscript>
    @endif
</div>

<div ng-cloak id="topelements" ng-init="subcategory='{{$subcategory->path}}'">
    <div id="scroll" class="row toplistdiv"  infinite-scroll='list.nextPage()' infinite-scroll-disabled='list.busy' infinite-scroll-distance='1'>
        <div ng-repeat='item in list.items' ng-mouseover="value=1" ng-mouseleave="value=0.2" my-repeat-directive>

            <div class="col-xs-6" id="parent" style="margin-bottom: 20px;">

                <div class="row" style="padding: 0;">
                    <div class="col-xs-6">
                        <div ng-style="{'background-image': 'url(/uploads/'+item.image+')'}" class="shadow" style=" height: 170px; width: 210px; overflow: hidden">
                           <div style="background:rgba(0, 0, 0, 0.3);height:26px">
                               <div class="row">
                                   <div class="col-xs-5" style="z-index: 12">
                                       <h3 class="no-margin" style="padding-left: 5px; color: white">[[item.rank]]<small><a style="color: lightgray;font-size: 12px; padding-left: 3px;" ng-href="{{url($subcategory->path)}}/[[item.id]]/[[item.slug]]">Details</a></small></h3>
                                   </div>
                                   <div class="col-xs-7 text-right" id="listtooltip">
                                       <div ng-if="item.online == 1">
                                           <img src="/pic/green.png" alt="Server Online" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Online">
                                       </div>
                                       <div ng-if="item.online == 0">
                                           <img ng-src="/pic/red.png" alt="Server Offline" class="top-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Server Offline">
                                       </div>
                                   </div>

                               </div>
                           </div>
                           <a class="divlink" ng-href="/out/[[item.id]]"></a>
                           <div class="row" ng-style="{'opacity':value}" style="position: absolute; top: 148px;">
                               <div class="col-xs-5" style=" padding-left: 35px;">
                                   <div class="socialite googleplus-one" data-href="{{Request::url()}}/[[item.id]]" data-size="medium"></div>
                               </div>
                               <div class="col-xs-6">
                                   <div class="socialite facebook-like" data-href="{{Request::url()}}/[[item.id]]" data-width="60" data-layout="button_count" data-show-faces="false" data-send="false"></div>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-xs-6 shadow" ng-style="{'background-color':'white'}">
                        <div class="row" style="height: 150px;">
                            <div class="col-xs-12" style="overflow: hidden">
                                <strong ng-bind="item.title"></strong>
                                <p ng-bind="item.description"></p>
                            </div>
                        </div>
                        <div class="row" style="height: 20px;">
                            <a ng-href="vote/[[item.id]]">
                                <div class="col-xs-7" id="listhref">Votes: [[item.votes]]</div>
                            </a>
                            <a class="text-right" data-toggle="modal" href="#discus" ng-click="resetDis(item.id,item.title + ' - {{$subcategory->name}}','{{Request::url()}}')">
                            <div class="col-xs-5 text-right" id="listhref">Comments</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" ng-if="($index+1)%50 == 0">
                <div class="row" style="margin-left: 0">
                    <div class="panel text-center panel-info">
                        <div class="panel-body">
                            <h4 class="no-margin" ng-bind="'Page '+((($index+1)/50)+1)"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12" ng-show='list.busy && !list.end'>Loading data...</div>
    </div>
    <div class="row" style="margin-left: 0" ng-if="list.end">
        <div class="panel text-center panel-info">
            <div class="panel-body">
                <h4 class="no-margin">Page end</h4>
            </div>
        </div>
    </div>
</div>
@stop