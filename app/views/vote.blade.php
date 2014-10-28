@extends('layouts.empty_base')
@section('title')
{{$server->title}} - {{$server->subcategory->name}}, {{$server->subcategory->alias}} server Vote - TamyTop
@stop
@section('body')

<div class="col-xs-3"></div>
<div class="col-xs-6">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="text-center">{{$server->title}}</h3>
            @if (Session::has('flash_notice'))
            <div class="alert alert-danger">{{ Session::get('flash_notice') }}</div>
            @endif
            <form method="POST">
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        {{Form::captcha()}}
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-xs-2"></div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" class="fingerprint" name="fingerprint">
                    <input class="btn btn-info col-xs-3" type="submit" value="Vote" onclick="$('input.fingerprint').val(new Fingerprint().get());">
                    <div class="col-xs-2"></div>
                    <a class="btn btn-default col-xs-3" type="submit" href="{{url($server->subcategory->path)}}"><small>Continue to Website</small></a>
                </div>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </form>
        </div>
    </div>
</div>
@stop