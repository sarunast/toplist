<div class="navbar navbar-default" role="navigation" style="background-color: rgba(255,255,255,0.58); z-index: 10">
        @if (isset($subcategory))
        <form class="col-xs-4" role="search" style="margin-top: 6px; margin-bottom: -10px">
            <div class="form-group col-xs-7" style="padding-left: 0; padding-right: 5px">
                <input type="text" ng-model="search" class="form-control" placeholder="Search">

            </div>
            <button id="search" ng-click="list.items = []; remove(); list.after = 0; list.search = search; list.busy = false; list.end = false;" type="submit" class="btn btn-default">Search</button>

        </form>
        @endif

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a href="{{url('faq')}}">FAQ</a>
            </li>
            <li>
                <a href="{{url('affiliate')}}">Affiliate</a>
            </li>
            <li>
                <a href="{{url('contact')}}">Contact</a>
            </li>
        </ul>
        <div class="pull-right" style="padding-right: 10px">
            @if(!Auth::check())
            <a data-toggle="modal" href="#login"><button type="button" class="btn btn-warning navbar-btn">Add server</button></a>
            @else
            <a href="{{url('panel/top/create')}}" type="button" class="btn btn-warning navbar-btn">Add server</a>
            @endif
        </div>
</div>