@if (Session::has('flash_notice'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('flash_notice') }}
</div>
@endif
<div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <form class="form-horizontal" id="LoginForm1" method="POST" action="{{ url('panel/website/send') }}">
            <div class="form-group">
                <label for="inputEmail" class="col-xs-2 control-label">Email</label>
                <div class="col-xs-10">
                    <input type="email" name="email" value="{{{Input::old('email')}}}" class="form-control" id="inputEmail" placeholder="Your Email" maxlength="50" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSubject" class="col-xs-2 control-label">Subject</label>
                <div class="col-xs-10">
                    <input type="text" name="subject" value="{{{Input::old('subject')}}}" class="form-control" id="inputUsername" placeholder="Message Subject" minlength="5" maxlength="30" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-2 control-label">Message</label>
                <div class="col-xs-10">
                    <textarea rows=5 class="form-control" name="content" required minlength="20" maxlength="1000">{{{Input::old('content')}}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-2"></div>
                <div class="col-xs-10">
                    {{Form::captcha()}}
                    <input type="hidden" name="id" value="{{$page->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input style="margin-top: 10px;" class="btn btn-info col-xs-2" type="submit" value="Send">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-2"></div>
                <div class="col-xs-10">
                    @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>
