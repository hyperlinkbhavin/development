<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <title>Bawabat Admin Panel</title>
    <style type="text/css">
        .dropdown-toggle {
            display: none !important;
        }

        .image_area {
            position: relative;
            width: 150px;
            height: 180px;
            margin: 0 auto;
        }

        img {
            display: block;
            max-width: 100%;
        }

        #uploaded_image {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: .25rem;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        .overlay {
            position: absolute;
            top: inherit;
            bottom: 0 !important;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }

        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
            display: block;
        }

        .text {
            color: #333;
            font-size: 17px;
            width: 100%;
            font-weight: 700;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
    @extends('index')
    @section('title', 'Manage Customers')
    @section('main')

        <section class="content">

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                        <div class="card">
                            <div class="header">
                                <h2> Add Advertisement Banner</h2><br>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('add_data') }}" enctype="multipart/form-data"
                                    data-parsley-validate="">

                                    {{ csrf_field() }}
                                    {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="datetime-local" name="start_date" class="form-control"
                                            id="from_date">
                                    </div>
                                </div>
                            </div> --}}

                                    {{-- <select class="js-example-basic-single" name="advertisement_type"
                                id="advertisement_type" onchange="changeUser(this)">
                                <option>select advertisement type</option>
                                <option value="normal">normal</option>
                                <option value="celebrity">celebrity</option>
                            </select> $('#uploaded_image').attr('src', base64data);
                            <br><br> --}}

                                    <label for="media">Media</label><br>

                                    <input type="file" id="upload_image" name="media" required><br>

                                    <div id="showImg"></div>

                                    {{-- <input type="file" id="media" name="media"
                                    accept="image/png, image/jpeg, image/jpg" required data-buttonname="btn-white"
                                    class="form-control" onchange="return ValidateAuthorImage(event,1)"> --}}

                                    <label class="image_error" id="image_error"
                                        style="font-size: 12px;list-style: none;color: red;"></label><br>

                                    {{-- <input type="file" class="form-control" id="media" name="media" width="50px" 
                            height="50px"
                                accept="file_extension|video/*|image" placeholder="upload image" data-parsley-required
                                required multiple /><span style="color: red">@error('media'){{$message}}@enderror</span><br> --}}
                                    <span style="color: black">Note : file supported only jpeg,png,jpg format.</span>
                                    <br>
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image-before-upload" style="max-height: 100px;">
                                    </div>

                                    <label for="name">Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" id="name" class="form-control"
                                                required placeholder="Enter name" required="">
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datetimepicker form-control"
                                            placeholder="Please choose date & time...">
                                    </div>
                                </div>
                            </div> --}}
                                    <label for="start_date">Start Duration</label>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <?php date_default_timezone_set('Asia/Kolkata'); ?>
                                                <input type="datetime-local" name="start_date" class="form-control"
                                                    id="from_date" required="" value="<?php echo date('Y-m-d H:i'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="end_date">End Duration</label>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="datetime-local" name="end_date" class="form-control"
                                                    id="end_date">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="description">Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="description" id="description" class="form-control"
                                                required placeholder="Enter description" required="">
                                        </div>
                                    </div>
                                    <label for="name">Link</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="url" name="link" id="link" class="form-control"
                                                required placeholder="Enter link" required="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <a href="{{ route('advertisement_list') }}"
                                            class="btn btn-raised btn-primary m-t-15 waves-effect"
                                            style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                        <button class="btn btn-raised btn-primary m-t-15 waves-effect"
                                            style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit
                                        </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>`
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="clearFileInput()">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function clearFileInput() {
                // Clear the value of the input file field
                document.getElementById('upload_image').value = '';
            }
        </script>
        <script> 
            $(document).ready(function() {
                var $modal = $('#modal');
                var image = document.getElementById('sample_image');
                var cropper;

                //$("body").on("change", ".image", function(e){

                $('#upload_image').change(function(event) {
                    var files = event.target.files;

                    var done = function(url) {
                        image.src = url;
                        $modal.modal('show');
                    };
                    //var reader;
                    //var file;
                    //var url;

                    if (files && files.length > 0) {
                        /*file = files[0];
                        if(URL)
                        {
                            done(URL.createObjectURL(file));
                        }
                        else if(FileReader)
                        {*/
                        reader = new FileReader();
                        reader.onload = function(event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                        //}
                    }
                });

                $modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        dragMode: 'move',
                        autoCropArea: 0.65,
                        restore: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false,
                        preview: '.preview',
                        data: { //define cropbox size
                            width: 750,
                            height: 240,
                        },
                    });
                }).on('hidden.bs.modal', function() {
                    cropper.destroy();
                    cropper = null;
                });

                $("#crop").click(function() {
                    canvas = cropper.getCroppedCanvas({
                        width: 750,
                        height: 240,
                        imageSmoothingEnabled: false,
                        imageSmoothingQuality: 'high',
                    });

                    canvas.toBlob(function(blob) {
                        console.log(blob)
                        //url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            $('#base64data').val(base64data)

                            $modal.modal('hide');
                            $('#showImg').empty();
                            $('#showImg').append('<img src="' + base64data +
                                '" id="uploaded_image" style="max-height:150px">');
                            var fileInput = document.getElementById('upload_image');

                            // Create a new File object


                            // Now let's create a DataTransfer to get a FileList
                            var dataTransfer = new DataTransfer();
                            dataTransfer.items.add(new File([blob], Date.now().toString() +
                            '.png', {
                                'type': 'image'
                            }));
                            fileInput.files = dataTransfer.files;
                            console.log(fileInput.files);
                            /*$.ajax({
                                url: BASE_URL+'',
                                method: "POST",                 
                                data: {image: base64data},
                                success: function(data){
                                    console.log(data);
                                    $modal.modal('hide');
                                    $('#uploaded_image').attr('src', data);
                                    //alert("success upload image");
                                }
                            });*/
                        }
                    });
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            })
        </script>
    @endsection
