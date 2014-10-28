<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    @section('description')
    @show
    <title>
        @if(isset($pageInfo)) {{{$pageInfo->name}}} - @elseif(isset($pagePost)) {{{$pagePost->title}}} - @endif {{{$page->title}}}
    </title>
    {{ basset_stylesheets($website->styles) }}
    <!--[if IE 8]>
    <script src="{{ url('assets/javascripts/modernizer.js')}}"></script>
    <![endif]-->

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-43443050-1', 'tamytop.com');
        ga('send', 'pageview');

    </script>
</head>

<body>
<!--PAGE Header-->
<div class="container">
    <div class="panel" style="background-color: #2F4F4F; margin-bottom: 0px">
        <div class="panel-body" style="padding: 0">
            <a class="navbar-brand" style="padding-bottom: 3px;padding-top:0;font-size: 13px; padding-left: 30px;color:#ffffff"  href="http://tamytop.com">TamyTop <small style="font-size: 10px; padding-left: 10px;"> Most advanced games top system</small></a>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div style="height: {{{$header->size}}}px ; @if($header->image) background-image:url('/uploads/{{$header->image}}')  @else background-color: #008B8B @endif">
                <div class="row">
                    <div class="col-xs-6">
                        <h1 style="padding-left: 10px;margin-bottom: 0; font-size: 40px; color: #{{$header->color}}">{{{$header->title}}}</h1>
                        <h2 style="margin: 0;padding-left: 130px;padding-bottom: 10px;">
                            <small style="font-weight: lighter;color: #{{$header->color}}">{{{$header->slogan}}}</small>
                        </h2>
                    </div>
                    @if($header->panel)
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-11">
                                <div class="pull-right" style="padding-top: 10px">
                                    @include('panel.website.apps.'.$header->panel)
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--BAR START-->
    <div class="navbar navbar-default" role="navigation" style="background-color: #F9F9F9; z-index: 10">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            @foreach($navigations as $navigation)
            @if($navigation->type == 0)
            <li>
                <a href="{{{url($navigation->page->path)}}}">{{{$navigation->page->name}}}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <!--BAR END-->

    <!--SIDE NAVIGATION START-->
    <div class="row">
        <div class="col-xs-3">
            @foreach($sideApps as $app)
            @include('panel.website.apps.'.$app->identifier)
            @endforeach
        </div>
        @yield('body')
    </div>
    <!--SIDE NAVIGATION END-->

    <!--FOOTER START-->
    <hr/>
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-xs-6">
            <copy class="text-center">TamyTop &copy; 2013</copy>

        </div>
        <div class="col-xs-1"></div>
        <div class="col-xs-6 text-right">
            @foreach($navigations as $navigation)
            @if($navigation->type == 2)
                <a href="{{{url($navigation->page->path)}}}" style="padding-right: 15px;">{{{$navigation->page->name}}}</a>
            @endif
            @endforeach
        </div>
    </div>
    <!--FOOTER END-->
</div>
{{ basset_javascripts($website->scripts) }}
<script>
    Socialite.setup({
        facebook: {
            lang: 'en_GB',
            appId: 633052990046045
        }
    });
    var socialbuttons = $('div.socialbuttons');
    Socialite.load(socialbuttons[0]);
    $(document).ready(function () {
        $('body').livequery(function () {
            $(this).tooltip({
                selector: '[data-toggle="tooltip"]'
            });
        });
    });
    $("#LoginForm").validate();
    $("#LoginForm1").validate();
</script>
@if(Session::has('website') && Session::get('website') == $page->id)
<!--<script type="text/javascript" src="{{url('assets/javascripts/Markdown.Converter.js')}}"></script>
<script type="text/javascript" src="{{url('assets/javascripts/Markdown.Sanitizer.js')}}"></script>
<script type="text/javascript" src="{{url('assets/javascripts/Markdown.Editor.js')}}"></script>-->
<script type="text/javascript" src="{{url('assets/javascripts/raptor.min.js')}}"></script>

<script type="text/javascript">
   /* (function () {
        var converter1 = Markdown.getSanitizingConverter();

        converter1.hooks.chain("preBlockGamut", function (text, rbg) {
            return text.replace(/^ {0,3}""" *\n((?:.*?\n)+?) {0,3}""" *$/gm, function (whole, inner) {
                return "<blockquote>" + rbg(inner) + "</blockquote>\n";
            });
        });

        var editor1 = new Markdown.Editor(converter1);

        editor1.run();

    })();*/
    $('#raptor-docked-element').raptor({
        autoEnable: true,            // Enable the editor automaticly
        plugins: {                   // Plugin options
            dock: {                  // Dock specific plugin options
                docked: true,        // Start the editor already docked
                dockToElement: true, // Dock the editor inplace of the element
                persist: false       // Do not save the docked state
            }
        }
    });
    $('#showEdit').click(function(){
        $('#showEdit').hide();
        $('div.wmdEditDiv').slideDown();
    });
    $('#sendcontent').click(function(){
        if($('#raptor-docked-element').html().length >= 5){
            $("input[name='content']").val($('#raptor-docked-element').html());
            $('#errorMessage').hide();
        }
        else {
            $("input[name='content']").val($('#raptor-docked-element').html());
            $('#errorMessage').show();
            event.preventDefault();
        }

    });
</script>
@endif
</body>
</html>