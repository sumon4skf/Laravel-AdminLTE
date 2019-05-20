@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all modules')

@section('page-title', "")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Module</li>
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
                    <h3 class="box-title">Module data table</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($modules as $module)
                        <tr>
                            <td>{{$module->id}}</td>
                            <td>{{$module->name}}</td>
                            <td>{{$module->slug}}</td>
                            <td>{{$module->discription}}</td>
                            <td>{!! $module->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                                    class="label label-danger">Inactive</span>' !!}</td>
                            <td class="text-center">
                                <a href="{{ url("module/{$module->id}/edit")}}" class="label label-warning" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="javascript:" class="label label-danger" onclick="delete_with_confirm('{{"form-{$module->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$module->id}"}}" action="{{ url("module/{$module->id}") }}" method="POST" style="display: none;">
                                    @method('delete') @csrf
                                </form>
                            </td>
                        </tr>
                        @empty 
                            <tr class="bg-danger">
                                <td colspan="6">No Data found</td>
                            </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $modules->links() }}
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
