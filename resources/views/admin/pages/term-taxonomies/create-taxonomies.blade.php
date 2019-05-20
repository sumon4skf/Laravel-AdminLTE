@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Create term and taxonomies')

@section('page-title', "")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomies</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url('term-taxonomy') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create new Term</h3>
                        <a href="{{url("term-taxonomy")}}" class="btn btn-link">show all</a>
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="taxonomyName">Term Name</label>
                                    <input type="text" name="taxonomyName" value="{{old('taxonomyName')}}" class="form-control"
                                        id="name" placeholder="Term Name">
                                    @if ($errors->has('taxonomyName'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('taxonomyName') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="module">Module</label>
                                    <select name="module" id="module" class="form-control">
                                        @forelse ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @empty
                                            <option value="0">No Module</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('module'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('module') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Term Description</label>
                                    <textarea name="description" id="description" rows="5" maxlength="400"
                                        class="form-control" placeholder="Term description">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('description') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div> <!-- /.row -->

                        <div class="form-group">
                            <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
                            <a href="{{ url('term-taxonomy/create') }}" class="btn btn-danger">Reset</a>
                        </div>

                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div> <!--/.col-md-7 -->
            <div class="col-sm-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Help</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Term Name</strong>
                        <p class="text-muted">
                            Taxonom is the post group. create new Term organized post.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Term Description</strong>
                        <p class="text-muted">
                            This description is about the Term that you create.
                        </p>    
                        <hr>                    
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div> <!--/.col-md-5 -->
        </div> <!--/.row -->

    </form>



</section>

@endsection


@section('custom-script')

<script>
    // image preview 
    $("#customFile").change(function () {
        readURL(this);
    });
    // image preview function
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#liveImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@endsection
