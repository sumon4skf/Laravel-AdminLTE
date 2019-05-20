@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Front menu groping option')

{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("admin-panel/super-admin/bower_components/select2/dist/css/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("admin-panel/super-admin/plugins/iCheck/all.css") }}">
@endsection


@section('page-title', "")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Access control</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url("menu-grouping") }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select group and add menu</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="groupId">Select menu group</label>
                                <select name="groupId" id="groupId" class="form-control shortoption">
                                    @forelse ($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @empty
                                    <option value="">none</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('groupId'))
                                <p class="text-danger margin-bottom-none">
                                    <small>{{ $errors->first('groupId') }}</small>
                                </p>
                                @endif
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="menuTitle">Main menu <span class="pull-right">
                                        <input type="checkbox" id="allactive" class="minimal" value="1"></span></h4>
                                <div class="group-menu">
                                    <ul class="todo-list" id="menu1"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="menuTitle">Submenu 1 <span class="pull-right">
                                        <input type="checkbox" id="allactive" class="minimal"></span></h4>
                                <div class="group-menu">
                                    <ul class="todo-list" id="menu2"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="menuTitle">Submenu 2 <span class="pull-right">
                                        <input type="checkbox" id="allactive" class="minimal"></span></h4>
                                <div class="group-menu">
                                    <ul class="todo-list" id="menu3"> </ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="menuTitle">Submenu 3 <span class="pull-right">
                                        <input type="checkbox" id="allactive" class="minimal"></span></h4>
                                <div class="group-menu">
                                    <ul class="todo-list" id="menu4"> </ul>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-green" value="Save permission" name="submit"
                                        title="Save permission">
                                    <a href="{{ url('access-control/create') }}" class="btn btn-danger"
                                        title="Reset form">Reset</a>
                                </div>
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-12 -->

        </div>
        <!--/.row -->

    </form>

</section>
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<!-- Select2 -->
<script src="{{ asset("admin-panel/super-admin/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="{{ asset("admin-panel/super-admin/plugins/iCheck/icheck.min.js") }}"></script>
<script>
    $(function () {      

        $('.longoption').select2()
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        $(document).on('ifChecked', '#allactive', function () {
            $(this).closest(".menuTitle").siblings().find(".todo-list input.minimal").iCheck('check');
        });
        $(document).on('ifUnchecked', '#allactive', function () {
            $(this).closest(".menuTitle").siblings().find(".todo-list input.minimal").iCheck('uncheck');
        });

        // manu with ajax
        function minimalLoad(){
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        }
        // single menu background menu color
        function singleColor(depth, color){
            $(depth).css({'background': '', 'color': '#454545', 'border': '1px solid #c5c5c5'});
            $(color).css({'background': 'rgba(44, 59, 65, 0.40)', 'color': '#fff', 'border': '1px solid transparent'});
        }
        // menu overlay
        function overlayIcon(){
            $("#menu1").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#menu2").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
            $("#menu3").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
            $("#menu4").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
        }


        groupId = $("#groupId").val();
        overlayIcon();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{ url('find-front-menu') }}',
            data: {'menuId': 0, 'groupId': groupId},
            success: function(data) {
                $("#menu1").html(data);
                minimalLoad();
            },
        });


        // role change ajax event
        $(document).on('change','#groupId',function(){
            var groupId = $(this).val();
            overlayIcon();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ url('find-front-menu') }}',
                data: {'menuId': 0, 'groupId': groupId},
                success: function(data) {
                    $("#menu1").html(data);
                    minimalLoad();
                },
            });
        });

    
        // first menu change event
        $(document).on("click", "#menu1 li", function(){
            var menuId = $(this).find("#menuId").val();
            var groupId = $("#groupId").val();
            $("#menu2").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            singleColor('#menu1 li', this);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: 'POST',
                url: '{{ url('find-front-menu') }}',
                data: {'menuId': menuId, 'groupId': groupId},
                success: function(data) {
                    $("#menu2").html(data);
                    minimalLoad();
                },
            });
        });

        // second menu change event
        $(document).on("click", "#menu2 li", function(){
            var menuId = $(this).find("#menuId").val();
            var groupId = $("#groupId").val();
            $("#menu3").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            singleColor('#menu2 li', this);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: 'POST',
                url: '{{ url('find-front-menu') }}',
                data: {'menuId': menuId, 'groupId': groupId},
                success: function(data) {
                    $("#menu3").html(data);
                    minimalLoad();
                },
            });
        });

        // third menu change event
        $(document).on("click", "#menu3 li", function(){
            var menuId = $(this).find("#menuId").val();
            var groupId = $("#groupId").val();
            $("#menu4").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            singleColor('#menu3 li', this);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: 'POST',
                url: '{{ url('find-front-menu') }}',
                data: {'menuId': menuId, 'groupId': groupId},
                success: function(data) {
                    $("#menu4").html(data);
                    minimalLoad();
                },
            });
        });


    })

</script>
@endsection
