@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Update selected Role')

@section('page-title', "Update role")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Role</li>
</ol>
@endsection

{{-- main content section start form here --}}
@section('content')
<section class="content">

    <form action="{{ url("role/{$role->id}") }}" method="POST">
        @method("PUT")
        @csrf
        <div class="row">
            <div class="col-md-6">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update new Role</h3>
                        <a href="{{url("role")}}" class="btn btn-link">show all</a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="active" value="1"
                                        {{ $role->active > 0 ? 'checked' : '' }}> Active
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="roleName">Role Name</label>
                                    <input type="text" name="roleName" value="{{$role->name ?? old('roleName')}}"
                                        class="form-control" id="name" placeholder="Role name">
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
                                        placeholder="Role description">{{$role->description ?? old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('description') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div> <!-- /.row -->

                        <div class="form-group">
                            <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="Update">
                            <a href="{{ url("role/{$role->id}/edit") }}" class="btn btn-danger" title="Reset">Reset</a>
                        </div>

                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-7 -->
            <div class="col-sm-6">
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
            </div>
            <!--/.col-md-5 -->
        </div>
        <!--/.row -->

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

    $("#changedPassword").change(function () {
        change = $(this).val();
        if (change == 0) {
            $(this).val(1);
            $(".changable").removeClass('hidden');
        }
        if (change == 1) {
            $(this).val(0);
            $(".changable").addClass('hidden');
        }

    })

</script>

@endsection
