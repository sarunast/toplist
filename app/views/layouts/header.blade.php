<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    @section('description')
    @show
    <title>
        @section('title')
        Game Tops and Ranking Website - TamyTop
        @show
    </title>
	{{ basset_stylesheets($website->styles) }}
	<!--[if IE 8]>
    <script src="{{ url('assets/javascripts/modernizer.js')}}"></script>
    <![endif]-->

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-43443050-1', 'tamytop.com');
		ga('send', 'pageview');

	</script>
</head>

<body>
<!--Register modal-->
@if(!Auth::check())
<div class="modal fade"  id="register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="RegForm" method="POST" action="{{ url('register') }}">
                    <div class="form-group">
                        <label for="inputUsername" class="col-xs-2 control-label">Username</label>
                        <div class="col-xs-10">
                            <input minlength="4" maxlength="32" required type="text" name="username" class="form-control" id="inputUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-xs-2 control-label">Email</label>
                        <div class="col-xs-10">
                            <input type="email" required name="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-xs-2 control-label">Password</label>
                        <div class="col-xs-10">
                            <input type="password" id="password" name="password" class="form-control" id="inputPassword" placeholder="Password" minlength="5" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConPassword" class="col-xs-2 control-label">Confirm Password</label>
                        <div class="col-xs-10">
                            <input type="password" name="password_confirmation" class="form-control" id="inputConPassword" placeholder="Confirm Password" minlength="5" maxlength="100" required>
                            <div class="checkbox">
                                <label>
                                    <input CHECKED name="subscription" type="checkbox" value="1"> Receive important updates
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input CHECKED name="terms" type="checkbox" required> Agree with terms and conditions
                                </label>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--End register Modal -->

<!--Login Modal-->
<div class="modal fade"  id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="LoginForm" method="POST" action="{{ url('login') }}">
                    <div class="form-group">
                        <label for="inputUsername" class="col-xs-2 control-label">Username</label>
                        <div class="col-xs-10">
                            <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" minlength="4" maxlength="32" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-xs-2 control-label">Password</label>
                        <div class="col-xs-10">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" minlength="5" maxlength="100" required>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" value="true" type="checkbox"> Remember me
                                </label>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="Login" class="btn btn-default">
                            <a style="padding-left: 10px;" href="{{url('remind')}}">Forgot your password?</a>
                            <p style="padding-top: 10px; padding-bottom: 0">Don't have user account? <a href="{{url('register')}}">Register Here</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endif
<!--End login modal-->

<!--PAGE Header-->
<div class="container">
    <div class="row">
        <a href="{{ url('/') }}">
            <div class="col-xs-7">
                <h1 style="margin-bottom: 0; font-size: 40px; color: #686868">TamyTop @if(isset($subcategory))<small style="color: #868da3; font-weight: lighter"> {{$subcategory->name}}</small>@endif</h1>
                <h2 style="margin: 0;padding-left: 130px;padding-bottom: 10px;"><small style="font-weight: lighter"> Most advanced games top system</small></h2>
            </div>
        </a>
        <div class="col-xs-5">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-right">

                        @if(!Auth::check())
                        <a data-toggle="modal" href="#register"><button style="background-color: #686868; border: 0"  type="button" class="btn btn-danger btn-sm navbar-btn">Register</button></a>
                        <a data-toggle="modal" href="#login"><button style="background-color: #686868; border: 0" type="button" class="btn btn-danger btn-sm navbar-btn">Login</button></a>
                        @else
                        @if (!Request::is('panel/top/create','panel/top/html'))
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" style="background-color: #686868; border: 0;z-index: 99">
                            User Panel
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('panel') }}">Manage Your account</a></li>
                            <li><a href="{{ url('panel/top') }}">Your Servers</a></li>
                            <li><a href="{{ url('panel/affiliate') }}">Affiliate system</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                        @endif
                        @endif
                    </div>
                </div>
            </div>



        </div>

    </div>


