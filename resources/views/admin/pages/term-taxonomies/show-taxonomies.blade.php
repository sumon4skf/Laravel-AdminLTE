@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all term taxonomies')

@section('content-header')

@section('page-title', "")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomies</li>
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
                    <h3 class="box-title">Term Taxonomy data table</h3>
                    <a href="{{url("term-taxonomy/create")}}" class="btn btn-link">Create new</a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Module</th>
                            <th>Status</th>
                            <th>Created by</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($termTaxonomies as $termTaxonomy)
                        <tr>
                            <td>{{$termTaxonomy->id}}</td>
                            <td>{{$termTaxonomy->name}}</td>
                            <td>{{$termTaxonomy->slug}}</td>
                            <td>{{$termTaxonomy->description}}</td>
                            <td>{{$termTaxonomy->module["name"]}}</td>
                            <td>{!! $termTaxonomy->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                                    class="label label-danger">Inactive</span>' !!}</td>
                            <td>{{$termTaxonomy->user['firstName']}}</td>
                            <td class="text-center">
                                <a href="{{ url("term-taxonomy/{$termTaxonomy->id}/edit")}}" class="label label-warning" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="javascript:" class="label label-danger" onclick="delete_with_confirm('{{"form-{$termTaxonomy->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$termTaxonomy->id}"}}" action="{{ url("term-taxonomy/{$termTaxonomy->id}") }}" method="POST"
                                    style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-danger">
                            <td colspan="7">No data</td>
                        </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $termTaxonomies->links() }}
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
