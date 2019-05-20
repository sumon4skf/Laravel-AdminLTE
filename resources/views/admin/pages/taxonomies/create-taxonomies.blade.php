@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Create term and taxonomies')

@section('page-title', "")

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomies</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
@php
    $taxoURl = \Request::route()->getName();
    $taxoArray = explode("/", $taxoURl );
    $module = strtolower($taxoArray[0]);
    if(count($taxoArray) > 1){
        $taxonomy = strtolower($taxoArray[1]);
    }else{
        $taxonomy = strtolower($taxoArray[0]);
    }    

    $taxonomydata = get_taxonomy_parent($taxonomy, $module);
@endphp

<section class="content">
        <div class="row">
            <div class="col-md-4 pr-0">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    @if (in_array("edit", $taxoArray))
                        <form action="{{ url($module."/".$taxonomy."/{$editItem["id"]}") }}" method="POST">
                            @method("PUT")
                            @csrf
                    @else
                        <form action="{{ url('taxonomy') }}" method="POST">
                            @csrf
                    @endif
                        <input type="hidden" name="module" value="{{$module}}">
                        <div class="box-header with-border">
                            <h3 class="box-title"> 
                                {{ (in_array("edit", $taxoArray)) ? "Edit" : "Add new"}}
                                {{ucfirst($taxonomy)}}
                            </h3>
                            @if (in_array("edit", $taxoArray))
                            <a href="{{ url($module."/".$taxonomy) }}" class="nav-link pull-right"> Add new {{$taxonomy}}</a>
                            @endif
                        </div>
                        <input type="hidden" name="term" value="{{$taxonomy}}">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="checkbox-inline">
                                        @if (in_array("edit", $taxoArray))
                                            @php
                                                $checked = $editItem["active"] == 1 ? "checked" : "";
                                            @endphp
                                            <input type="checkbox" name="active" value="1" {{$checked}}> Active
                                        @else
                                            <input type="checkbox" name="active" value="1" checked> Active
                                        @endif
                                        
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="taxonomyName">{{ucfirst($taxonomy)}} name</label>
                                        <input type="text" name="taxonomyName" value="{{ $editItem["name"] ?? old('taxonomyName')}}"
                                            class="form-control" id="taxonomyName" placeholder="{{ucfirst($taxonomy)}} name">
                                        @if ($errors->has('taxonomyName'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('taxonomyName') }}</small>
                                        </p>
                                        @endif
                                    </div>
                                    @if ($taxonomy !== "tags" && $taxonomy !== "tag")
                                    <div class="form-group">
                                        <label for="taxonomyParent">{{ucfirst($taxonomy)}} Parent</label>
                                        <select name="taxonomyParent" class="form-control" id="taxonomyParent">
                                            @if (in_array("edit", $taxoArray))
                                                @php
                                                    $single = get_taxonomy_single_parent($editItem["parent_id"]);
                                                @endphp
                                                @if (!empty($single["id"]))
                                                    <option value="{{$single["id"]}}">{{$single["name"]}}</option>
                                                @endif
                                                <option value="">None</option>
                                                @forelse (get_taxonomy_parent($taxonomy, $module) as $item)
                                                    @if ($single["id"] !== $item->id && $item->id !== $editItem["id"] )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif                                                
                                                @empty
                                                @endforelse
                                            @else
                                                <option value="">None</option>
                                                @forelse (get_taxonomy_parent($taxonomy, $module) as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                                @empty
                                                @endforelse
                                            @endif
                                        </select>
                                        @if ($errors->has('taxonomyParent'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('taxonomyParent') }}</small>
                                        </p>
                                        @endif
                                    </div>                                        
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder" title="Select Image">
                                            <img src="{{asset($editItem["picture"] ?? 'img/no-image.png')}}" title="Upload picture" id="holder" class="img-responsive user-picture">
                                        </label>
                                        <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="description">{{ucfirst($taxonomy)}} Description</label>
                                        <textarea name="description" id="description" rows="5" maxlength="400"
                                            class="form-control" placeholder="{{ucfirst($taxonomy)}} description">{{$editItem["description"] ?? old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('description') }}</small>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div> <!-- /.row -->

                            <div class="form-group">
                                @if (in_array("edit", $taxoArray))
                                    <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="Update">
                                    <a href="{{ url($taxonomy."/{$editItem["id"]}"."/edit") }}" class="btn btn-danger">Reset</a>
                                @else
                                    <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
                                    <a href="{{ url($taxonomy) }}" class="btn btn-danger">Reset</a>
                                @endif
                            </div>

                        </div> <!-- /.box-body -->

                    </form>

                </div> <!-- /.box -->
            </div>
            <!--/.col-md-5 -->

            <div class="col-sm-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ ucfirst($taxonomy)}} table</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th width="200">Description</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th>Module</th>
                                <th class="text-center">Option</th>
                            </tr>
                            <?php $i=0; $all = count($taxonomydata); ?>
                            @forelse ($taxonomydata as $item)
                            <tr>
                                <td>{{ $all - $i }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->ParentMenu['name'] ?? "none"}}</td>
                                <td>{!! $item->active == 1 ? '<span class="label label-success" title="Active">Active</span>' :
                                    '<span class="label label-danger" title="Inactive">Inactive</span>' !!}</td>
                                <td>{{$item->module}}</td>
                                <td class="text-center">
                                    <a href="{{ url("{$module}/{$taxonomy}/{$item->id}/edit")}}" class="label label-warning" title="Edit">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:" class="label label-danger" onclick="delete_with_confirm('{{"form-{$item->id}"}}')">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <form id="{{"form-{$item->id}"}}" action="{{ url("{$module}/{$taxonomy}/{$item->id}") }}" method="POST" style="display: none;">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            <?php  $i++ ;?>
                            @empty
                            <tr class="bg-danger">
                                <td colspan="8">No data</td>
                            </tr>
                            @endforelse

                        </table>
                    </div> <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-right">
                            {{ $taxonomydata->links() }}
                        </div>
                    </div> <!-- /.box box-footer -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-5 -->
        </div>
        <!--/.row -->

</section>

@endsection


@section('custom-script')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>

    function delete_with_confirm(id) {
        var answar = confirm("Do you want to delete !");
        if (answar == true) {
            $("#" + id).submit();
        }
    }
    
    // image preview 
    $('#customFile').filemanager('file');

</script>

@endsection
