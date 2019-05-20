@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Updated selected Module')

@section('page-title', "")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url("dashboard") }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Module</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')
<section class="content">

    <form action="{{ url('/module') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Updated selected Module</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="active" value="1" checked> Active
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="moduleName">Module name</label>
                                    <input type="text" name="moduleName" value="{{old('moduleName')}}"
                                        class="form-control" id="moduleName" placeholder="Module name">
                                    @if ($errors->has('moduleName'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('moduleName') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="About module...">{{ old("description")}}</textarea>
                                    @if ($errors->has('description'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('description') }}</small>
                                    </p>
                                    @endif
                                </div>

                            </div> <!-- /.col-sm-9-->
                            <div class="col-sm-3 pl-0" style="margin-top: 5px;">
                                <div class="form-group ">
                                    <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder" title="Select Image">
                                        <img src="{{asset('img/no-image.png')}}" title="Module picture" id="holder" class="img-responsive user-picture">
                                    </label>
                                    <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                                </div>
                            </div>
                        </div> <!-- /.row -->

                        <div class="form-group">
                            <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
                            <a href="{{ url('module/create') }}" class="btn btn-danger">Reset</a>
                        </div>

                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-7 -->
            <div class="col-sm-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Help</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Module name</strong>
                        <p class="text-muted">
                            Fill the module name for managing content by module.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Upload Picture</strong>
                        <p class="text-muted">
                            Upload picture format as jpeg, jpg, png, gif. Picture size must be lower than 1mb.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Description</strong>
                        <p class="text-muted">
                            Why you use this module, Note about  that in this Description fild in 400 workds.
                        </p>
                        <hr>
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-5 -->
        </div>
        <!--/.row -->

    </form>



</section>
@endsection


{{-- custom style for this page --}}
@section('custom-css-file')
    <link rel="stylesheet" href="{{ asset("admin-panel/super-admin/bower_components/select2/dist/css/select2.min.css") }}">    
@endsection    

{{-- custom script for this page --}}
@section('custom-script')
    <script src="{{ asset("admin-panel/super-admin/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $(function () {
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        });

        $('#customFile').filemanager('file');
    })
</script>
@endsection