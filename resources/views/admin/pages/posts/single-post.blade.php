@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all roles')

@section('content-header')

@section('page-title', "Show all Roles")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Role</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles data table</h3>
                    <a href="{{url("role/create")}}" class="btn btn-link">Create new</a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created by</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                            <td>{!! $role->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                                    class="label label-danger">Inactive</span>' !!}</td>
                            <td>{{$role->user['firstName']}}</td>
                            <td class="text-center">
                                <a href="{{ url("role/{$role->id}/edit")}}" class="label label-warning" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="javascript:" class="label label-danger" onclick="delete_with_confirm('{{"form-{$role->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$role->id}"}}" action="{{ url("role/{$role->id}") }}" method="POST"
                                    style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-danger">
                            <td colspan="6">No data</td>
                        </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $roles->links() }}
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
