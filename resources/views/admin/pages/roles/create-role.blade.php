@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Create new role')

@section('page-title', "Create a new user role")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Role</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url('/role') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create new Role</h3>
                        <a href="{{url("role")}}" class="btn btn-link">show all</a>
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
                                    <label for="roleName">Role Name</label>
                                    <input type="text" name="roleName" value="{{old('roleName')}}" class="form-control"
                                        id="name" placeholder="Role name">
                                    @if ($errors->has('roleName'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('roleName') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Role Description</label>
                                    <textarea name="description" id="description" rows="5" maxlength="400"
                                        class="form-control"
                                        placeholder="Role description">{{old('description')}}</textarea>
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
                            <a href="{{ url('role/create') }}" class="btn btn-danger">Reset</a>
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
                        <strong><i class="fa fa-book margin-r-5"></i> Role Name</strong>
                        <p class="text-muted">
                            Role is the user role. Role can be a group of user. we can set any role for the user.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Role Description</strong>
                        <p class="text-muted">
                            This description is about the role that you create.
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
