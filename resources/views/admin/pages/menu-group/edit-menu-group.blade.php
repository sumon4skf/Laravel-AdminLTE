@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Update new front menu group')

@section('page-title', "Update Front Menu Group")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Menu Group</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Update menu group</h3>
                    <a href="{{ url("group-menu") }}" class="nav-link">show all</a>
                </div>
                <div class="box-body">
                    <form action="{{ url("group-menu/{$groupMenu->id}")}}" method="POST" class="form-horizontal">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="groupname" class="col-sm-2 control-label">Group Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="groupname" value="{{$groupMenu->name}}" class="form-control" id="groupname" placeholder="Menu group name">
                                @if ($errors->has('groupname'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('groupname') }}</small>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mstyle" class="col-sm-2 control-label">Menu style</label>
                            <div class="col-sm-10">
                                <select name="mstyle" id="mstyle" class="form-control">
                                    @if ($groupMenu->style == "horizontal")
                                        <option value="horizontal">Horizontal</option>
                                        <option value="verticle">Verticle</option>
                                        <option value="mega">Mega menu</option>
                                    @elseif ($groupMenu->style == "verticle")
                                        <option value="verticle">Verticle</option>
                                        <option value="horizontal">Horizontal</option>
                                        <option value="mega">Mega menu</option>
                                    @elseif ($groupMenu->style == "mega")
                                        <option value="mega">Mega menu</option>
                                        <option value="horizontal">Horizontal</option>
                                        <option value="verticle">Verticle</option>
                                    @endif
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" placeholder="description">{{$groupMenu->description}}</textarea>
                                @if ($errors->has('description'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('description') }}</small>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-green" value="Update">
                                <a href="{{ url("group-menu/{$groupMenu->id}/edit") }}" class="btn btn-danger"
                                    title="Reset form">Reset</a>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            <!-- /.box box-success-->

        </div>
        <!--/.col-md-8 -->
        <div class="col-sm-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Help</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>Group Name</strong>
                    <p class="text-muted">
                        Menu group name is the set of menu that you grouping in Front menu groping menu
                    </p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Menu style</strong>
                    <p class="text-muted">
                        This is the group menu style
                    </p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Description</strong>
                    <p class="text-muted">
                        Description about the group menu
                    </p>
                    <hr>
                </div> <!-- /.box-body -->
            </div> <!-- /.box -->
        </div>
        <!--/.col-md-4 -->

    </div>
    <!--/.row -->


</section>
@endsection

