@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all users')

@section('page-title', "Show all users")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">User</li>
</ol>
@endsection

{{-- main content start form here --}}
@section('content')
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Users data table</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->firstName." ".$user->LastName}}</td>
                            <td>{{$user->gender}}</td>
                            <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                            <td>{{$user->role['name']}}</td>
                            <td>{!! $user->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                                    class="label label-danger">Inactive</span>' !!}</td>
                            <td class="text-center">
                                <a href="{{ url("user-single-show/{$user->id}")}}" class="label label-primary" title="view">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url("user/{$user->id}/edit")}}" class="label label-warning" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="#" class="label label-danger"
                                    onclick="delete_with_confirm('{{"form-{$user->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$user->id}"}}" action="{{ url("user/{$user->id}") }}" method="POST"
                                    style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @empty 
                            <tr class="bg-danger">
                                <td colspan="7">No Data found</td>
                            </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $users->links() }}
                    </div>
                </div> <!-- /.box box-footer -->
            </div> <!-- /.box -->
        </div>
        <!--/.col-md-7 -->
    </div>
    <!--/.row -->

</section>

@endsection


@section('custom-script')

<script>
    function delete_with_confirm(id) {
        var answar = confirm("Do you want to delete !");
        if (answar == true) {
            $("#" + id).submit();
        }
    }

</script>

@endsection
