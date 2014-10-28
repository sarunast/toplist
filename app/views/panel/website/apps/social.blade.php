
<div class="panel" style="background-color: rgba(255,255,255,0.5)">
    <div class="panel-body" style="padding-top: 9px">
        <ul class="socialMediaAccounts" style="width: 220px;padding-left: 15px;">
            @if($page->social->gplus)
            <li class="socialMediaAccount"><div class="socialite googleplus-one" data-size="medium" data-annotation="none" data-href="{{{$page->social->gplus}}}"></div></li>
            @endif
            @if($page->social->twitter)
            <li class="socialMediaAccount"><a class="socialite twitter-follow" href="{{{$page->social->twitter}}}" data-screen-name="TamyTop" data-text-color="#aeaeae" data-link-color="#1576a0" data-button="blue" data-show-count="false" data-show-screen-name="false" data-lang="en"></a></li>
            @endif
            @if($page->social->facebook)
            <li class="socialMediaAccount"><div class="socialite facebook-like" data-href="{{{$page->social->facebook}}}" data-send="false" data-layout="button_count" data-width="30" data-show-faces="false"></div></li>
            @endif
        </ul>
    </div>
</div>