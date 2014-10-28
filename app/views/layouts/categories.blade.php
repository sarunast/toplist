<div class="panel" style="background-color: rgba(255,255,255,0.61)">
    <div class="panel-body socialbuttons" style="padding-top: 9px">
        <ul class="socialMediaAccounts" style="padding-left: 25px;">
            <li class="socialMediaAccount"><div class="socialite googleplus-one" data-size="medium" data-annotation="none" data-href="//plus.google.com/108853359804831516018"></div></li>
            <li class="socialMediaAccount"><a class="socialite twitter-follow" href="http://twitter.com/tamytoplist" data-screen-name="TamyTop" data-text-color="#aeaeae" data-link-color="#1576a0" data-button="blue" data-show-count="false" data-show-screen-name="false" data-lang="en"></a></li>
            <li class="socialMediaAccount"><div class="socialite facebook-like" data-href="https://www.facebook.com/tamytoplist" data-send="false" data-layout="button_count" data-width="30" data-show-faces="false"></div></li>
        </ul>
    </div>
</div>

<div class="panel panel-info" id="headings">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        @foreach ($categories as $category)
        <h5 style="color: #464646; font-weight: bold ">{{$category->name}}</h5>
        <ul class="nav nav-pills nav-stacked">
            @foreach ($category->subcategories as $subcategory)
            <li><a href="{{url($subcategory->path)}}">{{$subcategory->name}}</a></li>
            @endforeach
        </ul>

        @endforeach
    </div>
</div>
