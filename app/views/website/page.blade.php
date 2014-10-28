@extends('layouts.page_base')
@section('body')
<div class="col-xs-9">
    <div class="panel panel-info">

        <div class="panel-body">
            <?
            if(Auth::check()){
                if(Session::has('website') ){
                    if(Session::get('website') == $page->id){ ?>
                        @if($pageInfo->content->count())
                        @include('panel.website.apps.page_edit')
                        @else
                        @include('panel.website.apps.create')
                        @endif
                    <?
                    }
                } else {
                    $websiteId = Website::where('user_id', Auth::user()->id)->first();
                    if($websiteId){
                        Session::put('website', $websiteId->id);
                        if ($website->id  == $page->id){ ?>
                            @if($pageInfo->content->count())
                            @include('panel.website.apps.page_edit')
                            @else
                            @include('panel.website.apps.create')
                            @endif
                        <?
                        }
                    }
                }
            }
            ?>
            @if($pageInfo->content->count())
            <h3>{{{$pageInfo->content[0]->title}}}</h3>
            <p>{{$pageInfo->content[0]->content}}</p>
            @endif
            @include('panel.website.apps.'.$pageInfo->website_app)
            @if($pageInfo->comments)
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
            @endif
        </div>
    </div>
</div>
@stop