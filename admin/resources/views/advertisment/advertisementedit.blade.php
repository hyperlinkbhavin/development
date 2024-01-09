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
@section('title', 'Edit Faq')
@section('main')


    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">

                        <div class="header">
                            <h2> Edit Advertisement Banner </h2><br>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_advertisement') }}" enctype="multipart/form-data"
                                data-parsley-validate="">
                                <input name="id" value="{{ $user['id'] }}" hidden>

                                {{ csrf_field() }}
                                {{-- <label for="start_date">Start Duration</label>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="datetime-local" name="start_date" class="form-control"
                                        id="from_date">
                                    </div>
                                </div>
                            </div>
                            <label for="question">Advertisement Type</label> --}}
                                {{-- <select class="js-example-basic-single" name="advertisement_type" id="advertisement_type"
                            onchange="changeUser(this)">
                            <option >select advertisement type</option>
                            <option value="{{$user['advertisement_type']}}">normal</option>
                            <option value="{{$user['advertisement_type']}}">celebrity</option>
                        </select> --}}
                                {{-- <br><br> --}}
                                {{-- <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="advertisement_type" id="advertisement_type" class="form-control" value="{{$user['advertisement_type']}}" required placeholder="Enter advertisement type - normal or celebrity"  data-parsley-required-message="This field is required" required="">
                                    
                                </div>
                            </div> --}}
                                <label for="question"> Name</label>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $user['name'] }}" placeholder="Enter name">

                                    </div>
                                </div>
                                {{-- <label for="question">Media Type</label> --}}
                                {{--                             
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="media_type" id="media_type" class="form-control" value="{{$user['media_type']}}" required placeholder="Enter advertisement type - normal or celebrity"  data-parsley-required-message="This field is required" required="">
                                    
                                </div>
                            </div> --}}

                                <label for="media">Media</label><br>

                                <input type="file" id="upload_image" name="media" value="{{ old($user['media']) }}"
                                    required><br><br>

                                <div id="showImg"></div>

                                {{-- <label for="media">Media</label> --}}

                                {{-- <input type="file" id="media" name="media"
                            accept="image/png, image/jpeg, image/jpg" value="{{old($user['media'])}}" required data-buttonname="btn-white"
                            class="form-control" onchange="return ValidateAuthorImage(event,1)"> --}}

                                <label class="image_error" id="image_error"
                                    style="font-size: 12px;list-style: none;color: red;"></label><br>
                                {{-- <input type="text" name="" id="image" class="form-control" value="{{$user['image']}}" required placeholder="Uploaad Image"  data-parsley-required-message="This field is required" required=""> --}}
                                {{-- <input type="file" class="form-control" id="media"  accept="file_extension|video/*|image" name="media" value="{{old($user['media'])}}" placeholder="upload media" />
                          <span style="color: red">@error('media'){{$message}}@enderror</span>        <br>                                     --}}
                                <div class="col-md-12 mb-2">
                                    <img id="preview-image-before-upload"
                                        src="{{ 'https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/banner/' . $user->media }}"
                                        height="150px" width="250px" alt="preview image" >
                                </div><br>
                                
                                <label for="start_date">Start Duration</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="datetime-local" name="start_date" value="{{ $user['start_date'] }}"
                                                class="form-control" id="start_date">

                                            {{-- <input type="text" name="start_date" id="start_date" class="form-control"  required placeholder="Enter time duration"  data-parsley-required-message="This field is required" required=""> --}}

                                        </div>
                                    </div>
                                </div>
                                <label for="end_date">End Duration</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="datetime-local" name="end_date" value="{{ $user['end_date'] }}"
                                                class="form-control" id="end_date">

                                            {{-- <input type="text" name="start_date" id="start_date" class="form-control"  required placeholder="Enter time duration"  data-parsley-required-message="This field is required" required=""> --}}

                                        </div>
                                    </div>
                                    <label for="description">Description</label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="description" id="description" class="form-control"
                                                value="{{ $user['description'] }}" placeholder="Enter description">

                                        </div>
                                    </div>
                                    <label for="link"> Link</label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="link" id="link" class="form-control"
                                                value="{{ $user['link'] }}" placeholder="Enter link">

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
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
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
    {{-- <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
    {{-- <script>
    $(document).ready(function (e) {
       // $('#image').on('change',function(){
       //     console.log('hcjdh')
       // })
  
$('#media').change(function(){
       //   alert('hhe')
 let reader = new FileReader();

 reader.onload = (e) => { 

   $('#preview-image-before-upload').attr('src', e.target.result); 
 }

 reader.readAsDataURL(this.files[0]); 

});

});
</script> --}}
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

                        $('#preview-image-before-upload').attr('src',base64data)
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
    <script>
        // $('.image_error').hide();

        // function ValidateAuthorImage(event, id) {
        //     var n = 0;
        //     var files = event.target.files;
        //     var image_id = event.target.id;
        //     var valid = true;
        //     var height = 0;
        //     var width = 0;
        //     var _URL = window.URL || window.webkitURL;
        //     for (var i = 0; i < files.length; i++) {

        //         var imagesize = files[0].size;

        //         var img = new Image();
        //         var reader = new FileReader();
        //         var files1 = $("#" + image_id + "").get(0).files[0];
        //         reader.onload = function() {
        //             var imagehtml =
        //                 `<div class="col-md-2 mb-2 uploaded-img-wrap" style="margin-left: 156px;" id="addImage">` +
        //                 `<img id="uploaded-image"` +
        //                 `src="${window.URL.createObjectURL(reader.result)}"` +
        //                 `class="img-fluid img-thumbnail" alt="Responsive image">` +
        //                 `<a onclick="removeTemp();" class="btn btn-danger removeTemp">Remove</a>` +
        //                 `</div>`;

        //             $(".image-display-div").html(imagehtml);
        //         }
        //         reader.readAsDataURL(files1);
        //         img.onload = function() {
        //             var height1 = img.height;
        //             var width1 = img.width;
        //             var aspect_ration = width1 / height1;

        //             var width = 375;
        //             var height = 120;
        //             var texthint = width + "*" + height
        //             var defined_aspect_ratio = 1; // height = 242 , width = 375


        //             if (imagesize <= 1033414) {

        //                 if (height1 == height && width1 == width) {
        //                     $("#image_error").hide()
        //                     $("#image_error").html("");
        //                     $('#add_category').removeAttr('disabled');
        //                 } else {
        //                     // if(!clickckeck.includes(image_id)){
        //                     n = n + 1;
        //                     // }
        //                     // clickckeck.push(image_id);
        //                     $("#image_error").show()
        //                     $("#image_error").html("Please upload another image with proper aspect size Example - (" +
        //                         texthint + ")");
        //                 }
        //             } else {
        //                 // if(!clickckeck.includes(image_id)){
        //                 n = n + 1;
        //                 // }
        //                 clickckeck.push(image_id);
        //                 $("#image_error").show()
        //                 $("#image_error").html("Please uplaod image less than or equal to 1 MB");
        //             }


        //             //console.log(urlvaliad);
        //             if (n != 0) {
        //                 console.log("a");
        //                 $('#add_category').prop('disabled', true);
        //             } else {
        //                 $('#add_category').removeAttr('disabled');
        //             }
        //         }

        //         img.src = _URL.createObjectURL(files[i]);
        //     }
        // }
        $(document).ready(function(e) {


            $('#media').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endsection
