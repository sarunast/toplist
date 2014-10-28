@extends('layouts.empty_base')
@section('title')
TamyTop User panel page
@stop
@section('body')
<div class="col-xs-3">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="{{url('panel')}}">Home</a></li>
            <li><a href="{{url('panel/login')}}">Login Settings</a></li>
            <li><a href="{{url('panel/top')}}">Manage your Servers</a></li>
            <li class="active"><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>
    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>

</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="page-header">Affiliate</h3>
            <h4>Coming Soon!</h4>
            <p>
                Affiliate is system which dramatically increases visitors on your website. Every user who wishes to use
                affiliate will get is own unique HTML code which will have to be inserted into your website. That piece
                of code will display few adds in your website. Every time person click on that code you will get 1 point
                which later could be spend for good use.
            </p>

            <p>
                Points can be traded in for things such as posting an ad on TamyTop.com, and if you accumulate a large enough amount, you can trade in your points for a banner that will be submitted into the Affiliate system. The Affiliate system posts ads all over the web, much in the same way that Google Ads operates. Your banner ad will be showcased in multiple websites that are all using the Affiliate system, further increasing traffic to your own personal website.
            </p>
            <p>
                With Affiliate you can also trade in points for votes for your published website, which will increase your ranking with TamyTop.com. If you prefer to not have ads featured on your website, an alternative way to earn some points would be by donating to TamyTop.
            </p>
            <p>
                Affiliate should be up and running no later than late September! To avoid missing out on information that could benefit your site or missing Affiliate’s launch, sign up for our newsletter, we promise not to spam your inbox!
            </p>
            <p>
                For any questions or clarification on the Affiliate system, feel free to contact us.
            </p>
        </div>
    </div>
</div>
@stop