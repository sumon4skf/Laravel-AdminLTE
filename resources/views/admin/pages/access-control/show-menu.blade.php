@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all admin menus')

@section('content-header')

@section('page-title', "Show all admin menus")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Admin-menu</li>
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
                    <h3 class="box-title">
                        Admin menu data table
                    </h3>
                    <a href="{{url("admin-menu/create")}}" class="btn btn-link">Create new</a>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center">Option</th>
                                <th>URL</th>
                                <th>Action</th>
                                <th>Method</th>
                                <th class="text-center">Menu visiblity</th>
                                <th>Parent</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>
                                    <a href="{{ url("admin-menu/{$menu->id}/clone")}}" class="label label-primary"
                                        title="clone menu">
                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ url("admin-menu/{$menu->id}/edit")}}" class="label label-warning"
                                        title="Edit">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="label label-danger" onclick="event.preventDefault(); document.getElementById('{{"form-{$menu->id}"}}').submit();" title="delete">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <form id="{{"form-{$menu->id}"}}" action="{{ url("admin-menu/{$menu->id}") }}"
                                        method="POST" style="display: none;">
                                        @method('delete') @csrf
                                    </form>
                                </td>
                                <td>{{$menu->routeUrl}}</td>
                                <td>{{$menu->routeAction}}</td>
                                <td class="text-center">{{$menu->method}}</td>
                                <td class="text-center">
                                    @if ($menu->visibility == 1)
                                        <span class="label label-success" title="Menu visible"><i class="fa fa-eye"></i></span>
                                    @else
                                        <span class="label label-danger" title="Menu Invisible"><i class="fa fa-eye-slash"></i></span>
                                    @endif
                                </td>
                                <td>{{$menu->ParentMenu['name'] ?? "No parent"}}</td>
                                <td>{{$menu->description}}</td>
                                <td>
                                    @if ($menu->active == 1)
                                        <span class="label label-success" title="Menu Active">Active</span>
                                    @else
                                        <span class="label label-danger" title="Menu Inactive">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-danger">
                                <td colspan="10">No data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> <!-- /.box -->
        </div>
        <!--/.col-md-7 -->
    </div>
    <!--/.row -->

</section>
@endsection




{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@endsection

{{-- custom script for this page --}}
@section('custom-script')

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<script>
    var table;
    $(document).ready(function() {
        table = $('#example').DataTable( {
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Details for '+data[0]+' '+data[1];
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
            "order": [[ 0, 'DSC' ]]
        });
        table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            alert( 'Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden') );
        });
        
    });

</script>
@endsection