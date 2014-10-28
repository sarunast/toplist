@extends('layouts.empty_base')
@section('title')
TamyTop User panel page
@stop
@section('body')
<div class="col-xs-3">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="{{url('panel')}}">Home</a></li>
            <li><a href="{{url('panel/login')}}">Login Settings</a></li>
            <li class="active"><a href="{{url('panel/top')}}">Manage your Servers</a></li>
            <li><a href="{{url('panel/website')}}">Your Website</a></li>
            <li><a href="{{url('panel/affiliate')}}">Your Affiliates</a></li>
            <li><a href="{{url('panel/statistics')}}">Your Statistics</a></li>
        </ul>
    </div>
    <a href="{{url('/')}}"><button type="button" class="btn btn-primary">Back to Tops</button></a>

</div>
<div class="col-xs-9">
    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="page-header" style="margin-bottom: 20px;">Add server</h3>
            <div class="row fuelux">
                <div id="MyWizard" class="wizard">
                    <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Basic Info<span class="chevron"></span></li>
                        <li data-target="#step2"><span class="badge">2</span>Server Info<span class="chevron"></span></li>
                        <li data-target="#step3"><span class="badge">3</span>Image (Optional)<span class="chevron"></span></li>
                        <li data-target="#step4"><span class="badge">4</span>Your HTML<span class="chevron"></span></li>
                    </ul>
                    <!--<div class="actions">
                        <button type="button" class="btn btn-mini btn-prev">Previous</button>
                        <button type="button" class="btn btn-mini btn-next" data-last="Finish">Next</button>
                    </div>-->
                </div>
                {{ Form::open(array('url' => 'panel/top','class'=>'form-horizontal', 'id'=>'CreateServer' ,'method' => 'POST','files'=> true)) }}
                <div class="col-xs-8" style="padding-top: 20px">

                    <div class="step-content">
                        <div class="step-pane active" id="step1">
                            <div class="form-group">
                                <label for="inputTitle" class="col-xs-3 control-label">Title</label>
                                <div class="col-xs-9">
                                    <input class="form-control" value="{{{Input::old('title')}}}" id="inputTitle" name="title" placeholder="Short title" minlength="3" maxlength="15" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUrl" class="col-xs-3 control-label">Website URL</label>
                                <div class="col-xs-9">
                                    <input class="form-control" id="inputUrl" name="url" type="url" placeholder="Website URL" value="http://" minlength="5" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCategory" class="col-xs-3 control-label">Category</label>
                                <div class="col-xs-9">
                                    <select class="form-control" id="inputCategory" name="subcategory_id" required>
                                        @foreach ($categories as $category)
                                        <option value="">Select Category:</option>
                                        <optgroup label="{{{$category->name}}}">
                                            @foreach ($category->subcategories as $subcategoryReg)
                                            <option value="{{$subcategoryReg->id}}">{{{$subcategoryReg->name}}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-xs-3 control-label">Description</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" rows="3" id="inputDescription" name="description" placeholder="Short Description" minlength="5" maxlength="110" required>{{{Input::old('description')}}}</textarea></br>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="button" class="btn btn-info" id="btnWizardNext" value="Next">
                                </div>
                            </div>

                        </div>
                        <div class="step-pane" id="step2">
                            <div class="form-group">
                                <label for="inputIP" class="col-xs-3 control-label">Server IP</label>
                                <div class="col-xs-9">
                                    <input class="form-control" value="{{{Input::old('ip')}}}" id="inputIP" name="ip" placeholder="IP address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPort" class="col-xs-3 control-label">Server Port</label>
                                <div class="col-xs-9">
                                    <input class="form-control" value="{{{Input::old('port')}}}" type="digits" id="inputPort" name="port" placeholder="Server Port"  maxlength="5" required>
                                    <div style="padding-top: 20px">
                                        <input type="button" class="btn btn-info" id="btnWizardPrev" value="Previous">
                                        <input type="button" class="btn btn-info" id="btnWizardNext" value="Next">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-pane" id="step3">
                            <div class="form-group">
                                <label for="inputImage" class="col-xs-3 control-label" id="image">Upload Image (optional)</label>

                                <div class="col-xs-5" style="padding-top: 10px">
                                    <input id="inputImage" name="image" type="file">

                                </div>
                            </div>
                            <p class="text-info" style="padding-left: 150px; padding-top: 0;">
                                Image size must be at least 210x170 pixels. GIF must be exactly 210x170 pixels.
                            </p>
                            <div class="form-group">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-5">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div style="padding-top: 20px">
                                        <input type="button" class="btn btn-info" id="btnWizardPrev" value="Previous">
                                        <input type="submit" value="Create Top" class="btn btn-success">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
                {{ Form::close() }}


            </div>
        </div>
    </div>
</div>
@stop