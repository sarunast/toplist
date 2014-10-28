@foreach($contents as $content)
<div class="row">
    <div class="col-xs-12">
        <h3>{{{$content->title}}}</h3>
        <p>{{{$content->content}}}</p>
        <div class="row">
            <div class="col-xs-6 text-left">
                @if($pageInfo->comments)
                <a href="{{url('post/'.$content->id)}}#disqus_thread">0 Comments</a>
                @endif

            </div>
            <div class="col-xs-6 text-right">
                Posted At: {{{$content->created_at}}}
                @if(Session::has('website') && Session::get('website') == $page->id)
                <form class="" method="post" action="{{url('panel/website/content/'.$content->id)}}">
                    <a href="{{url('page/'.$page->path.'/post/'.$content->id)}}" class="btn btn-info btn-xs">Edit</a>
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