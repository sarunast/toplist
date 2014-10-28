
<div class="panel" style="background-color: #F9F9F9">
    <div class="panel-body" style="padding-top: 5px; padding-bottom: 8px">
        @if(count($servers))
        <div class="row">
        @foreach($servers as $server)
            <div class="col-xs-6 text-center">
                <small style="font-size: 10px">{{{$server->server->title}}}</small>
                <a href="http://tamytop.com/vote/{{{$server->server->id}}}">
                    <img border="0" src="http://tamytop.com/top-img/{{{$server->server->subcategory->path}}}.jpg" alt="Vote for the San Andreas MP - TamyTop">
                </a>
            </div>
        @endforeach
        </div>
        @else
        <p class="text-center">
            Add server to your Website
        </p>
        @endif
    </div>
</div>