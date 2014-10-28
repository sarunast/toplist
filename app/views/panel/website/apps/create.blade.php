@if (Session::has('flash_notice'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('flash_notice') }}
</div>
@endif
@foreach($errors->all() as $message)
<li>{{ $message }}</li>
@endforeach
<button class="btn btn-success" id="showEdit">New Post</button>
<hr/>
<div class="wmdEditDiv" style="display: none">
    <form action="{{url('panel/website/content')}}" id="LoginForm" method="post" >
        <input name="title" class="form-control" minlength="5" maxlength="100" required placeholder="Title">
        <div id="raptor-docked-element"></div>
        <input type="hidden" name="content">
        <p class="text-info" id="errorMessage"  style="display: none"><em>Content must have at least 5 characters</em></p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="page" value="{{{$pageInfo->id}}}">
        <input type="submit" id="sendcontent" Value="Post" class="btn btn-success btn-sm">
    </form>
</div>
