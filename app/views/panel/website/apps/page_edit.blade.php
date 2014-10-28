@if (Session::has('flash_notice'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('flash_notice') }}
</div>
@endif
@foreach($errors->all() as $message)
<li>{{ $message }}</li>
@endforeach
<button class="btn btn-success btn-sm" id="showEdit">Edit</button>
<div class="wmdEditDiv" style="display: none">
    <form action="{{url('panel/website/content/edit')}}" id="LoginForm" method="post" >
        <input name="title" class="form-control" minlength="5" maxlength="100" value="{{{$pageInfo->content[0]->title}}}" required placeholder="Title">
        <div id="raptor-docked-element">{{$pageInfo->content[0]->content}}</div>
        <input type="hidden" name="content">
        <p class="text-info" id="errorMessage"  style="display: none"><em>Content must have at least 5 characters</em></p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="content_id" value="{{{$pageInfo->content[0]->id}}}">
        <input type="submit" id="sendcontent" Value="Save Changes" class="btn btn-info btn-sm">


    </form>
</div>
<form method="post" class="text-right" style="margin-top: -30px" action="{{url('panel/website/content/'.$pageInfo->content[0]->id)}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Delete" class="btn btn-warning btn-sm">
</form>
