@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Update selected user')

@section('page-title', "Update user")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">User</li>
</ol>
@endsection

@section('content')
<section class="content">

    <form action="{{ url("user/{$user->id}") }}" method="POST" enctype="multipart/form-data">
        @method("PUT")
        @csrf
        <div class="row">
            <div class="col-md-7">
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">User update form</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="active" value="1"
                                        {{ $user->active > 0 ? 'checked' : '' }}> Active
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="firstName">First name</label>
                                    <input type="text" name="firstName" value="{{$user->firstName}}"
                                        class="form-control" id="firstName" placeholder="First name">
                                    @if ($errors->has('firstName'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('firstName') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last name</label>
                                    <input type="text" name="lastName" value="{{$user->LastName}}" class="form-control"
                                        id="lastName" placeholder="Last name">
                                    @if ($errors->has('lastName'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('lastName') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="gender">Gender: </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="male"
                                            {{ $user->gender == "male" ? "checked" : "" }}> Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="female"
                                            {{ $user->gender == "female" ? "checked" : "" }}> Female
                                    </label>
                                </div>
                            </div> <!-- /.col-sm-9 -->

                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder" title="Select Image">
                                        <img src="{{asset($user->picture)}}" title="upload profile picture" id="holder"
                                            class="img-responsive user-picture">
                                    </label>
                                    <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                                </div>
                            </div> <!-- /.col-sm-3 -->
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{$user->email}}" class="form-control"
                                    id="email" placeholder="email" disabled>
                                @if ($errors->has('email'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('email') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="userRole">Role</label>
                                <select name="userRole" class="form-control shortoption" id="userRole">
                                    @empty(!$user->role['id'])
                                    <option value="{{$user->role['id']}}">{{$user->role['name']}}</option>
                                    @endempty
                                    @forelse ($roles as $role)
                                    @if ($role->id !== $user->role['id'])
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                    @empty
                                    <option value="">No data</option>
                                    @endforelse
                                </select>
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="changedPassword" id="changedPassword"
                                            value="{{old('changedPassword') ?? 0 }}"
                                            {{old('changedPassword') == 1 ? "checked" : ""}}>
                                        Change password
                                    </label>
                                </div>
                            </div>
                        </div>
                        @php
                        $hidden = old('changedPassword') == 1 ? "" : "hidden";
                        @endphp
                        <div class="row changable {{$hidden}}">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="password" name="oldpassword" class="form-control" id="oldpassword"
                                        placeholder="old password">
                                    @if ($errors->has('oldpassword'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('oldpassword') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row changable {{$hidden}}">
                            <div class="form-group col-sm-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="password">
                                @if ($errors->has('password'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('password') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="confirm password">
                                @if ($errors->has('password_confirmation'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('password_confirmation') }}</small>
                                </p>
                                @endif
                            </div>
                        </div> <!-- /.row -->

                        <div class="form-group">
                            <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="submit">
                            <a href="{{ url("user/{$user->id}/edit") }}" class="btn btn-danger">Reset</a>
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
                        <strong><i class="fa fa-book margin-r-5"></i> First name and Last name</strong>
                        <p class="text-muted">
                            User first name and last name are different field that are combine or user only one on the
                            view.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Upload Picture</strong>
                        <p class="text-muted">
                            Upload user picture format as jpeg, jpg, png, gif. Picture size must be lower than 1mb.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Email</strong>
                        <p class="text-muted">
                            Email can not be changed in edit option
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Role</strong>
                        <p class="text-muted">
                            Select a user role for grouping the user.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Change password</strong>
                        <p class="text-muted">
                            Checked change password you can find more field. Old password must be same that we given
                            before. password and confirm password must be same and min 6 character.
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
        //select 2 option
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        })

        // image preview 
        $('#customFile').filemanager('file');

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
        });

    })

</script>
@endsection
