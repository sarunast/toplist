@extends('layouts.page_base')
@section('body')
<div class="col-xs-9">
    <div class="panel panel-info">

        <div class="panel-body">
            <?
            if(Auth::check()){
                if(Session::has('website') ){
                    if(Session::get('website') == $page->id){ ?>
                        @include('panel.website.apps.edit')
                    <?
                    }
                } else {
                    $websiteId = Website::where('user_id', Auth::user()->id)->first();
                    if($websiteId){
                        Session::put('website', $websiteId->id);
                        if ($website->id  == $page->id){ ?>
                            @include('panel.website.apps.edit')
                        <?
                        }
                    }
                }
            }
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <h3>{{{$pagePost->title}}}</h3>
                    <p>{{$pagePost->content}}</p>
                    <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 text-right">
                            Posted At: {{{$pagePost->created_at}}}
                        </div>
                    </div>
                    <hr/>
                </div>
            </div>

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
        </div>
    </div>
</div>
@stop