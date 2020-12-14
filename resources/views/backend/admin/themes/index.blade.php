@extends('layouts.app')

@section('title')
    Background Themes
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/bower_components/lightbox2/css/lightbox.min.css">

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
   <div class="row">
    <div class="col-sm-12">
        <!-- Image grid card start -->
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Background Themes</h5>
                <div class="btn-group d-flex justify-content-end mb-2">
                    <button class="btn-warning btn btn-mini"><i class="ti-reload mr-2" onclick="location.reload();"></i>Reload</button>
                    <button class="btn-primary btn btn-mini" data-target="#backgroundThemeModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Upload New Theme</button>
                </div>
                <div class="row gallery-page" id="themeWrapper">
                    @foreach ($themes as $theme)
                        <div class="col-lg-4 col-sm-6">
                            <div class="thumbnail">
                                <div class="thumb">
                                    <a href="/assets/uploads/themes/{{$theme->theme ?? ''}}" data-lightbox="1" data-title="{{$theme->theme_name ?? ''}}">
                                        <img src="/assets/uploads/themes/{{$theme->theme ?? ''}}" alt="{{$theme->theme_name ?? ''}}" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection

@section('dialog-section')
<div class="modal fade" id="backgroundThemeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-uppercase">New Background Theme</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="themeUploadForm" data-parsley-validate>
                    <div class="form-group">
                        <label for="">Theme Name</label>
                        <input type="text" placeholder="Theme Name" required name="theme_name" id="theme_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" id="attachment" name="attachment" required class="form-control">
                    </div>
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox"  name="dark" id="dark">
                            <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                            </span>
                            <span>Dark Color Scheme</span>
                        </label>
                    </div>
                    <p><strong class="text-danger">Note:</strong> The default color scheme is light.</p>
                    <hr>
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="uploadTheme"><i class="mr-2 ti-check"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/lightbox2/js/lightbox.min.js"></script>
<script>
$(document).ready(function(){
            var theme = null;
        $(document).on('change', '#attachment', function(e){
            e.preventDefault();
            var extension = $('#attachment').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['jpeg', 'jpg', 'png', 'gif']) == -1) {
                $.notify('Ooops! File format not supported.', 'error');
                $('#attachment').val('');
            }else{
                theme = $('#attachment').prop('files')[0];

            }
        });
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#dark').val(1);
            }
            else if($(this).prop("checked") == false){
                $('#dark').val(0);
            }
        });
         $('#themeUploadForm').parsley().on('field:validated', function() {


        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('name',$('#theme_name').val());
                form_data.append('scheme',$('#dark').val());
                form_data.append('attachment',theme);
                $('#uploadTheme').text('Processing...');
                 axios.post('/theme/gallery/upload',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#uploadTheme').text('Done');
                    setTimeout(function () {
                        $("#uploadTheme").text("Save");
                        $('#theme_name').val('');
                        $('#attachment').val('');
                        $('#backgroundThemeModal').modal('hide');
                        $('#themeWrapper').load(location.href + ' #themeWrapper');
                    }, 2000);

                })
                .catch(error=>{
                    $.notify('Error! Something went wrong.', 'error');
                    $('#uploadTheme').text("Ooops...We couldn't upload theme.");
                    setTimeout(function () {
                        $("#uploadTheme").text("Save");
                    }, 2000);
                });

                return false;
            });

        });
</script>
@endsection
