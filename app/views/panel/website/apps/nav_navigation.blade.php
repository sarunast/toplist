<div class="panel panel-info" id="headings">
    <div class="panel-heading">Navigation</div>
    <div class="panel-body">

        <ul class="nav nav-pills nav-stacked">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            @foreach($navigations as $navigation)
            @if($navigation->type == 1)
            <li>
                <a href="{{{url($navigation->page->path)}}}">{{{$navigation->page->name}}}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>