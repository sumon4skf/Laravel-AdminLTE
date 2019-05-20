@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Clone admin menu option')

@section('page-title', "Clone admin menu")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Admin menu</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url("admin-menu") }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Clone admin menu</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="active" value="1" {{ $menu->active == 1 ? 'checked' : ''}}> Active
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="visible" value="1" {{ $menu->visibility == 1 ? 'checked' : ''}}> Visible
                                </label>
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="menuName">Menu name</label>
                                <input type="text" name="menuName" value="{{$menu->name}}" class="form-control"
                                    id="menuName" placeholder="Menu name">
                                @if ($errors->has('menuName'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuName') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="menuIcon">Menu Icon (Font awesome)</label>
                                <input type="text" name="menuIcon" value="{{$menu->menuIcon}}" class="form-control"
                                    id="menuIcon" placeholder="fa-icon">
                                @if ($errors->has('menuIcon'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuIcon') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="routeUrl">Route URL</label>
                                <input type="text" name="routeUrl" value="{{$menu->routeUrl}}" class="form-control"
                                    id="routeUrl" placeholder="Route URL">
                                @if ($errors->has('routeUrl'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('routeUrl') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="routeAction">Route Action</label>
                                <input type="text" name="routeAction" value="{{$menu->routeAction}}" class="form-control"
                                    id="routeAction" placeholder="Controller@method">
                                @if ($errors->has('routeAction'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('routeAction') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="routeMethod">Route Method</label>
                                <select name="routeMethod" id="routeMethod" class="form-control shortoption">
                                    @if ($menu->method == "get")
                                        <option value="get">GET</option>
                                        <option value="post">POST</option>
                                        <option value="put">UPDATE</option>
                                        <option value="delete">DELETE</option>
                                    @elseif($menu->method == "post")
                                        <option value="post">POST</option>
                                        <option value="get">GET</option>
                                        <option value="put">UPDATE</option>
                                        <option value="delete">DELETE</option>
                                    @elseif($menu->method == "put")
                                        <option value="put">UPDATE</option>
                                        <option value="get">GET</option>
                                        <option value="post">POST</option>
                                        <option value="delete">DELETE</option>
                                    @elseif($menu->method == "delete")
                                        <option value="delete">DELETE</option>
                                        <option value="get">GET</option>
                                        <option value="post">POST</option>
                                        <option value="put">UPDATE</option>
                                    @endif
                                </select>
                                @if ($errors->has('routeMethod'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('routeMethod') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="menuParent">Menu parent</label>
                                <select name="menuParent" id="menuParent" class="form-control longoption">
                                    @if ($menu->parent_id > 0)
                                        <option value="{{$menu->parent_id}}">{{ $menu->parent_id.". ".$menu->ParentMenu['name']}}</option>
                                    @endif 
                                    <option value="0">none</option>
                                    @forelse ($parents as $parent)
                                        @if ($menu->parent_id !== $parent->id)
                                            <option value="{{$parent->id}}">{{"$parent->id. $parent->name"}}</option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('menuParent'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuParent') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="menuDescription">Menu Description</label>
                                <textarea name="menuDescription" id="menuDescription" rows="5" maxlength="400"
                                    class="form-control"
                                    placeholder="Menu description">{{$menu->description}}</textarea>
                                @if ($errors->has('menuDescription'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuDescription') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="submit" class="btn btn-green" value="Save clone" name="submitbtn"
                                    title="Save clone">
                                <a href="{{ url("admin-menu/{$menu->id}/clone") }}" class="btn btn-danger"
                                    title="Reset form">Reset</a>
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-8 -->
            <div class="col-sm-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Help</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Menu name</strong>
                        <p class="text-muted">
                            Menu name is the visible name of the menu. we can modify Menu name in anytime. Menu name
                            must be a relevend name.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Menu name (Bangla)</strong>
                        <p class="text-muted">
                            Menu name (Bangla) is optional. It is helpfull for Bangla language settings.
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Route URL</strong>
                        <p class="text-muted">
                            Route URL Laravel Routing URL. You can set only the name of the Route URL. Example
                            <b>something/{id}/edit</b>
                        </p>
                        <hr>
                        <strong><i class="fa fa-book margin-r-5"></i> Route Action</strong>
                        <p class="text-muted">
                            Route Action is the Laravel Route Action. You can set Route action controller. Example
                            <b>Controller@method</b>
                        </p>
                        <hr>
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-4 -->

        </div>
        <!--/.row -->

    </form>

</section>
@endsection

{{-- custom style for this page --}}
@section('custom-css-file')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("admin-panel/super-admin/bower_components/select2/dist/css/select2.min.css") }}">
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<!-- Select2 -->
<script src="{{ asset("admin-panel/super-admin/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
    $(function () {
        $('.longoption').select2()

        $('.shortoption').select2({
            minimumResultsForSearch: -1
        })
    })

</script>
@endsection
