@extends('layouts.page_base')
@section('body')
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-heading">Home</div>

        <div class="panel-body">
            <?
            if(Auth::check()){
                if(Session::has('website') ){
                    if(Session::get('website') == $page->id){ ?>
                        @if (Session::has('flash_notice'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ Session::get('flash_notice') }}
                        </div>
                        @endif
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                        <button class="btn btn-success" id="showEdit">New Post</button>
                        <hr/>
                        <div class="wmdEditDiv" style="display: none">
                            <form action="{{url('panel/website/content')}}" id="LoginForm" method="post" >
                                <input name="title" class="form-control" minlength="5" maxlength="100" required placeholder="Title">
                                <div id="raptor-docked-element"></div>
                                <input type="hidden" name="content">
                                <p class="text-info" id="errorMessage"  style="display: none"><em>Content must have at least 5 characters</em></p>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="page" value="0">
                                <input type="submit" id="sendcontent" Value="Post" class="btn btn-success btn-sm">
                            </form>
                            <hr/>
                        </div>
                    <?
                    }
                } else {
                    $websiteId = Website::where('user_id', Auth::user()->id)->first();
                    if($websiteId){
                        Session::put('website', $websiteId->id);
                        if ($website->id  == $page->id){ ?>
                            @@if (Session::has('flash_notice'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('flash_notice') }}
                            </div>
                            @endif
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                            <form action="{{url('panel/website/content')}}" id="LoginForm" method="post" >
                                <input name="title" class="form-control" minlength="5" maxlength="100" required placeholder="Title">
                                <div id="raptor-docked-element"></div>
                                <input type="hidden" name="content">
                                <p class="text-info" id="errorMessage"  style="display: none"><em>Content must have at least 5 characters</em></p>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="page" value="0">
                                <input type="submit" id="sendcontent" Value="Post" id="send button" class="btn btn-success btn-sm">


                            </form>
                        <?
                        }
                    }
                }
            }
            ?>
            @foreach($contents as $content)

            <div class="row">
                <div class="col-xs-12">
                    <h3>{{{$content->title}}}</h3>
                    <p style="overflow: hidden">{{$content->content}}</p>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <a href="{{url('post/'.$content->id)}}#disqus_thread">0 Comments</a>

                        </div>
                        <div class="col-xs-6 text-right">
                            Posted At: {{{$content->created_at}}}
                            @if(Session::has('website') && Session::get('website') == $page->id)
                            <form class="" method="post" action="{{url('panel/website/content/'.$content->id)}}">
                                <a href="{{url('post/'.$content->id)}}" class="btn btn-info btn-xs">Edit</a>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="Delete" class="btn btn-danger btn-xs">
                            </form>

                            @endif
                        </div>
                    </div>
                    <hr/>
                </div>
            </div>
            @endforeach
            <div class="text-center">
            {{$contents->links();}}
            </div>
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