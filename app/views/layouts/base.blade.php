@include('layouts.header')
@include('layouts.bar')

<div class="row">
    <div class="col-xs-9">
        @yield('body')
    </div>
    <div class="col-xs-3">
        @include('layouts.categories')
    </div>

</div>

@include('layouts.footer')