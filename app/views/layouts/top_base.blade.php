@include('layouts.header')
<div ng-app='myApp' ng-init="category={{$subcategory->id}};">
<div ng-controller='DemoController'>
    @include('layouts.bar')
    <div class="row">
        <div class="col-xs-9">
                @yield('body')

        </div>
        <div class="col-xs-3">
            @include('layouts.categories')
        </div>

    </div>
</div>
</div>
@include('layouts.footer')