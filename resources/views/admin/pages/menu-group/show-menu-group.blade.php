@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Show all Menu group')

@section('content-header')

@section('page-title', "Show all menu group")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Group Menu</li>
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
                        Menu Group data table
                    </h3>
                    <a href="{{url("group-menu/create")}}" class="btn btn-link">Create new</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Menu-slug</th>
                                <th>Style</th>
                                <th>Description</th>
                                <th>Creadet by</th>
                                <th class="text-center">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($groupMenus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->slug_name}}</td>
                                <td>{{$menu->style}}</td>
                                <td>{{$menu->description}}</td>
                                <td>{{$menu->user['firstName']}}</td>
                                <td class="text-center">
                                    <a href="{{ url("group-menu/{$menu->id}/edit")}}" class="label label-warning" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="label label-danger" onclick="event.preventDefault(); document.getElementById('{{"form-{$menu->id}"}}').submit();" title="delete">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <form id="{{"form-{$menu->id}"}}" action="{{ url("group-menu/{$menu->id}") }}"
                                        method="POST" style="display: none;">
                                        @method('delete') @csrf
                                    </form>
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