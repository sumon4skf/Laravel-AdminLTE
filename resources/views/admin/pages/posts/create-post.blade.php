@extends('admin-panel.super-admin.layouts.master')

@section('title', 'Add new post')

@section('page-title', "")
@php
$taxoURl = \Request::route()->getName();
$taxoArray = explode("/", $taxoURl );
$module = strtolower($taxoArray[0]);
if(count($taxoArray) > 1){
$taxonomy = strtolower($taxoArray[1]);
}else{
$taxonomy = strtolower($taxoArray[0]);
}
@endphp
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">{{$module}}</li>
</ol>
@endsection

@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("admin-panel/super-admin/bower_components/select2/dist/css/select2.min.css") }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

    <form action="{{ url('post') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <!-- Form Element sizes -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new {{$module}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Title</h5>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control"
                                    id="title" placeholder="Post title" ajax-url="{{url("get_slug_menu")}}">
                                    @if ($errors->has('title'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('title') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span>URL: </span>
                                    <a href="javascript:" id="editslug" title="click to edit">{{ url("/")}}/<span
                                            id="urlslug"></span></a>
                                    <input type="text" name="slug" class="hide" value="{{old('slug')}}" id="slug"
                                        style="width: 250px;">
                                    @if ($errors->has('slug'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('slug') }}</small>
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <textarea name="article-ckeditor" id="article-ckeditor"
                                        class="form-control">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('description') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div> <!-- /.row -->

                        {{-- attachement option --}}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="checkbox-inline" title="check to show post excerpt field">
                                    <input type="checkbox" name="excerpt" class="attachment" value="excerpt">Post Excerpt
                                </label>
                                <label class="checkbox-inline" title="check to show attachment">
                                    <input type="checkbox" name="attached" class="attachment" value="attached">Attachment
                                </label>
                                <label class="checkbox-inline" title="Allow comments">
                                    <input type="checkbox" name="comments" class="attachment" value="comments">Allow Comments
                                </label>
                                <label class="checkbox-inline" title="Allow comments">
                                    <input type="checkbox" name="popup" class="attachment" value="popup">Allow Pop-Up
                                </label>
                                <label class="checkbox-inline" title="Check to show other options">
                                    <input type="checkbox" name="option" class="attachment" value="option">Other Options
                                </label>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="row">
                            <div id="excerpt" class="hide">
                                <div class="form-group col-sm-12">
                                    <h5>Post Excerpt</h5>
                                    <textarea name="excerpt" id="excerpt" rows="2" class="form-control">{{old('excerpt')}}</textarea>
                                    @if ($errors->has('excerpt'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('excerpt') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div> <!--/.excerpt -->

                            <div id="attached" class="hide">
                                <div class="col-sm-12">
                                    <h5>Attachement</h5>
                                </div>
                                <div class="col-sm-2">
                                    <ul class="upoptions">
                                        <li>
                                            <label class="radio-inline">
                                                <input type="radio" name="attItem" class="path" value="video" checked>Video
                                            </label>
                                        </li>
                                        <li>
                                            <label class="radio-inline">
                                                <input type="radio" name="attItem" class="path" value="audio">Audio
                                            </label>
                                        </li>
                                        <li>
                                            <label class="radio-inline">
                                                <input type="radio" name="attItem" class="path" value="file">File
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-sm-12 -->
                                <div class="col-sm-10" id="attVideo">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="video" value="local" class="path" checked>Local Video
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="video" value="youtube" class="path">YouTube
                                        </label>
                                    </div><!-- /input-group -->
                                    <div class="form-group">
                                        <input type="text" name="local" class="form-control" id="localPath" placeholder="Local video file path">
                                        <input type="text" name="youtube" class="form-control hide" id="youtubePath" placeholder="YouTube Video embeded link">
                                    </div><!-- /input-group -->
                                </div>
                                <div class="col-sm-10 hide" id="attAudio">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="audio" value="localAudio" class="path" checked>Local Audio
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="audio" value="otherAudio" class="path">Other Audio
                                        </label>
                                    </div><!-- /input-group -->
                                    <div class="form-group">
                                        <input type="text" name="local" class="form-control" id="localAudio" placeholder="Local Audio file path">
                                        <input type="text" name="local" class="form-control hide" id="otherAudio" placeholder="Other Audio file path">
                                    </div><!-- /input-group -->
                                </div>
                                <div class="col-sm-10 hide" id="attItem">
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="audio" value="localFile" class="path" checked>Local File
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="audio" value="otherFile" class="path" checked>Other File
                                        </label>
                                    </div><!-- /input-group -->
                                    <div class="form-group">
                                        <input type="text" name="localFile" class="form-control" id="localFile" placeholder="Local file path">
                                        <input type="text" name="otherFile" class="form-control hide" id="otherFile" placeholder="Other file path">
                                    </div><!-- /input-group -->
                                </div>
                            </div> <!--/.attached -->

                            <div id="comments" class="hide">
                                <div class="form-group col-sm-12">
                                    <h5>Add first Comments</h5>
                                    <textarea name="comments" id="comments" rows="2" class="form-control">{{old('comments')}}</textarea>
                                    @if ($errors->has('comments'))
                                    <p class="text-danger margin-bottom-none">
                                        <small>{{ $errors->first('comments') }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div> <!--/.comments -->

                            <div id="popup" class="hide">
                                <div class="col-sm-12">
                                    <h5>Setting Post Pop-Up</h5>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="main-page" id="main-page" value="main-page" > Main Page
                                        </label>
                                    </div>
                                    <ul class="upoptions">
                                        <li>
                                            
                                        </li>
                                        <li>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="module-page" id="module-page" value="module-page" > Module Page
                                            </label>
                                        </li>
                                    </ul> 
                                    <!-- /.upoptions -->
                                </div>
                                <!-- /.col-sm-4 -->
                                <div class="col-sm-4">

                                </div>
                            </div> 
                            <!--/.popup -->

                            <div id="option" class="hide">
                                <div class="col-sm-12">
                                    <h5>Other Options</h5>
                                </div>
                                <div class="col-sm-6">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="popup" value="popUp" > Open Popup
                                    </label>
                                </div>
                            </div> <!--/.option -->

                        </div>
                        <!--/.row -->
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <input type="submit" class="btn btn-green" value="Save" name="submitbtn"
                                    title="submit">
                                <a href="{{ url("{$module}/create") }}" class="btn btn-danger">Reset</a>
                            </div>
                        </div>

                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-7 -->


            <div class="col-sm-3 pl-0">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Publishing Tools</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="publish" class="cheking" checked> Publish
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="draft" class="cheking"> Draft
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="schedule" class="cheking"> Schedule
                                </label>
                            </div>
                            <div class="form-group col-sm-12 hide" id="scheduleDate">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' value="scheduleDate" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <h5>Template</h5>
                                <ul class="post_taxonomy">
                                    @forelse (post_template() as $template)
                                    <li>
                                        <label class="radio-inline">
                                            <input type="radio" name="template" value="{{strtolower($template)}}">
                                            {{$template }}
                                        </label>
                                    </li>
                                    @empty
                                    <li>
                                        <span>Template not set</span>
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="col-sm-12">
                                @forelse ($terms as $term)
                                <div class="catblock">
                                    @if ($term->slug == "tags")
                                    <div class="form-group">
                                        <h5>{{ $term->name }}</h5>
                                        <select class="form-control shortoption" multiple="multiple"
                                            data-placeholder="Select a tags" style="width: 100%;">
                                            @forelse ( find_post_taxonomies($term->slug, $module, 0) as $tags)
                                                <option value="{{$tags->id}}">{{$tags->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @else
                                    <h5>{{ $term->name }}</h5>
                                    <ul class="post_taxonomy">
                                        @forelse ( find_post_taxonomies($term->slug, $module, 0) as $item)
                                        <li>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="taxonomy[]" value="{{$item->id}}">
                                                {{$item->name }}
                                            </label>
                                            @if (count(find_post_taxonomies($item->term, $module, $item->id)) > 0)
                                            <ul>
                                                @forelse ( find_post_taxonomies($item->term, $module, $item->id) as
                                                $item2)
                                                <li>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="taxonomy[]" value="{{$item2->id}}">
                                                        {{$item2->name}}
                                                    </label>

                                                    @if (count(find_post_taxonomies($item2->term, $module, $item2->id))
                                                    > 0)
                                                    <ul>
                                                        @forelse ( find_post_taxonomies($item2->term, $module,
                                                        $item2->id) as $item3)
                                                        <li>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="taxonomy[]"
                                                                    value="{{$item3->id}}"> {{$item3->name}}
                                                            </label>
                                                        </li>
                                                        @empty
                                                        @endforelse
                                                    </ul>
                                                    @endif
                                                </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                            @endif
                                        </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                    @endif
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div> <!-- /.row -->
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <h5>Thumbnail</h5>
                                <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder"
                                    title="Select Image">
                                    <img src="{{asset($editItem["picture"] ?? 'img/no-image-available.jpg')}}"
                                        title="select picture" id="holder" class="img-responsive user-picture m-0">
                                </label>
                                <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                            </div>
                        </div> <!-- /.row -->


                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
            <!--/.col-md-5 -->
        </div>
        <!--/.row -->

    </form>


</section>

@endsection


@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset("vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="{{ asset("admin-panel/super-admin/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/file-manager?type=Images',
        filebrowserImageUploadUrl: '/file-manager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/file-manager?type=Files',
        filebrowserUploadUrl: '/file-manager/upload?type=Files&_token=',
        height: 350,
    };
    CKEDITOR.replace('article-ckeditor', options);

    function ajax_slug_url(title, ajaxurl) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'title': title
            },
            success: function (data) {
                $("#slug").val(data);
                $("#urlslug").html(data);
            },
        });
    }

    $(function () {
        $(document).on("keyup", "#title", function () {
            var title = $(this).val();
            var ajaxurl = $(this).attr("ajax-url");
            ajax_slug_url(title, ajaxurl);
        });
        $("#editslug").click(function () {
            $("#slug").removeClass("hide").focus();
            $("#urlslug").addClass("hide")
        });
        $("#slug").blur(function () {
            var title = $(this).val();
            ajax_slug_url(title);
            $(this).addClass("hide")
            $("#urlslug").removeClass("hide")
        });
        $(".cheking").click(function () {
            var cheking = $(this).val();
            if (cheking == "schedule") {
                $("#scheduleDate").removeClass("hide");
                $('#datetimepicker1').datetimepicker();
            } else {
                $("#scheduleDate").addClass("hide");
            }
        });
        $('.longoption').select2();
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        });
        // image preview 
        $('#customFile').filemanager('file');

        function check_uncheck( checkId, value = ""){
            if( $(checkId).is(":checked") ){ 
                if(value == "attached"){
                    $("#attached").removeClass("hide");
                }else if(value == "option"){
                    $("#option").removeClass("hide");
                }else if(value == "excerpt"){
                    $("#excerpt").removeClass("hide");
                }else if(value == "popup"){
                    $("#popup").removeClass("hide");
                }else if(value == "comments"){
                    $("#comments").removeClass("hide");
                }
            }
            if( !$(checkId).is(":checked") ){ 
                if(value == "attached"){
                    $("#attached").addClass("hide");
                }else if(value == "option"){
                    $("#option").addClass("hide");
                }else if(value == "excerpt"){
                    $("#excerpt").addClass("hide");
                }else if(value == "popup"){
                    $("#popup").addClass("hide");
                }else if(value == "comments"){
                    $("#comments").addClass("hide");
                }
            }
        }

        $( ".attachment" ).each(function() {
            value = $(this).val();
            check_uncheck( this, value);
        });      

        // option and attachment option start from here        
        $(".attachment").click(function(){
            value = $(this).val();
            check_uncheck( this, value);
        });

        $(document).on("click", ".path", function(){
            var value = $(this).val();
            if(value == "attachment"){
                $("#attachment").removeClass("hide");
                $("#option").addClass("hide");
            }
            if(value == "video"){
                $("#attVideo").removeClass("hide");
                $("#attAudio").addClass("hide");
                $("#attItem").addClass("hide");
            }
            if(value == "audio"){
                $("#attAudio").removeClass("hide");
                $("#attItem").addClass("hide");
                $("#attVideo").addClass("hide");
            }
            if(value == "file"){
                $("#attItem").removeClass("hide");
                $("#attVideo").addClass("hide");
                $("#attAudio").addClass("hide");
            }
            if(value == "local"){
                $("#youtubePath").addClass("hide");
                $("#localPath").removeClass("hide");
            }
            if(value == "youtube"){
                $("#localPath").addClass("hide");
                $("#youtubePath").removeClass("hide");
            }
            if(value == "localAudio"){
                $("#localAudio").removeClass("hide");
                $("#otherAudio").addClass("hide");
            }
            if(value == "otherAudio"){
                $("#otherAudio").removeClass("hide");
                $("#localAudio").addClass("hide");
            }
            if(value == "localFile"){
                $("#localFile").removeClass("hide");
                $("#otherFile").addClass("hide");
            }
            if(value == "otherFile"){
                $("#otherFile").removeClass("hide");
                $("#localFile").addClass("hide");
            }
        });

    })

</script>

@endsection
