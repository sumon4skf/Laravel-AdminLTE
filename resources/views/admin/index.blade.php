@extends('admin.layouts.master')

@section('title', 'Welcome to super admin pannel')


@section('page-title', "")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Home</li>
</ol>
@endsection


@section('content')

<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dashboard</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12">
                	<h3>Welcomo to Admin</h3>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
