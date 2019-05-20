@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Register new front menu')

@section('page-title', "Register new front menu")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Front menu</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url("front-menu") }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create new front menu</h3>
                        <a href="" class="btn btn-link"></a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="active" value="1" checked> Active
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="visible" value="1" checked> Visible
                                </label>
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="menuName">Menu name</label>
                                <input type="text" name="menuName" value="{{old('menuName')}}" class="form-control"
                                    id="menuName" placeholder="Menu name">
                                @if ($errors->has('menuName'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuName') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="menuNameBn">Menu name (Bangla)</label>
                                <input type="text" name="menuNameBn" value="{{old('menuNameBn')}}" class="form-control"
                                    id="menuNameBn" placeholder="Menu name Bangla">
                                @if ($errors->has('menuNameBn'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuNameBn') }}</small>
                                </p>
                                @endif
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label class="radio-inline">
                                    <input type="radio" name="selectURL" value="appUrl" id="appUrl" checked> App URL
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="selectURL" value="customUrl" id="customUrl"> Custom URL
                                </label>
                            </div>

                            <div id="customAppURL">
                                <div class="form-group col-sm-6">
                                    <label for="routeUrl">Route URL</label>
                                    <input type="text" name="routeUrl" value="{{old('routeUrl')}}" class="form-control"
                                        id="routeUrl" placeholder="Route URL">
                                    @if ($errors->has('routeUrl'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('routeUrl') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="routeAction">Route Action</label>
                                    <input type="text" name="routeAction" value="{{old('routeAction')}}"
                                        class="form-control" id="routeAction" placeholder="Controller@method">
                                    @if ($errors->has('routeAction'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('routeAction') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div id="customMenuURL" class="hidden">
                                <div class="form-group col-sm-12">
                                    <label for="custom">Custom URL</label>
                                    <input type="text" name="custom" value="{{old('custom')}}" class="form-control"
                                        id="custom" placeholder="http://example.com">
                                    @if ($errors->has('custom'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('custom') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="routeMethod">Route Method</label>
                                <select name="routeMethod" id="routeMethod" class="form-control shortoption">
                                    <option value="get">GET</option>
                                    <option value="post">POST</option>
                                    <option value="put">UPDATE</option>
                                    <option value="delete">DELETE</option>
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
                                    <option value="0">none</option>
                                    @forelse ($parents as $parent)
                                    <option value="{{$parent->id}}">{{"$parent->id. $parent->name"}}</option>
                                    @empty
                                    <option value="0">none</option>
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
                                    placeholder="Menu description">{{old('menuDescription')}}</textarea>
                                @if ($errors->has('menuDescription'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('menuDescription') }}</small>
                                </p>
                                @endif
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="submit" class="btn btn-green" value="Create" name="submitbtn"
                                    title="submit">
                                <a href="{{ url('admin-menu/create') }}" class="btn btn-danger"
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
<link rel="stylesheet" href="{{ asset("admin-panel/super-admin/bower_components/select2/dist/css/select2.min.css") }}">
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<!-- Select2 -->
<script src="{{ asset("admin-panel/super-admin/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
    $(function () {
        $('.longoption').select2();
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        });

        $("#appUrl").click(function(){            
            $("#customAppURL").removeClass("hidden");
            $("#customMenuURL").addClass("hidden");
        });

        $("#customUrl").click(function(){            
            $("#customAppURL").addClass("hidden");
            $("#customMenuURL").removeClass("hidden");
        });

    })

</script>
@endsection
