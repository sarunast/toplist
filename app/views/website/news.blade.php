@extends('layouts.page_base')
@section('body')
<div class="col-xs-9">
    <div class="panel panel-info">

        <div class="panel-body">
            <?
            if(Auth::check()){
                if(Session::has('website') ){
                    if(Session::get('website') == $page->id){ ?>
                        @include('panel.website.apps.create')
                    <?
                    }
                } else {
                    $websiteId = Website::where('user_id', Auth::user()->id)->first();
                    if($websiteId){
                        Session::put('website', $websiteId->id);
                        if ($website->id  == $page->id){ ?>
                            @include('panel.website.apps.create')
                        <?
                        }
                    }
                }
            }
            ?>
            @include('panel.website.apps.news')
        </div>
    </div>
</div>
<script>
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'tamytop'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
@stop