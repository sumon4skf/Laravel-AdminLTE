@extends('admin-panel.super-admin.layouts.master')

@section('title', 'File manager file')

@section('content-header')

@section('page-title', "File manager")
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">File manager</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <iframe src="{{ url("file-manager")}}" style="width: 100%; height: 550px; overflow: hidden; border: 1px solid #ccc;"></iframe>
        </div>
        <!--/.col-md-7 -->
    </div>
    <!--/.row -->

</section>
@endsection

