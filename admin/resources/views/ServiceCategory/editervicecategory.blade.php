
@extends('index')
@section('title','Edit Faq')
@section('main')


<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    
                    <div class="header">
                        <h2> Edit Categories  </h2><br>
              
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_categories') }}" enctype="multipart/form-data" data-parsley-validate="">
                            <input name="id" value="{{$user['id']}}" hidden>

                            {{ csrf_field() }}
                            <label for="question">Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$user['name']}}"  placeholder="Enter your question"  data-parsley-required-message="This field is required" >
                                    
                                </div>  
                            </div>

                            <input type="file" id="image" name="image"
                                    accept="image/png, image/jpeg, image/jpg" value="{{$user['image']}}" data-buttonname="btn-white"
                                    class="form-control" onchange="return ValidateAuthorImage(event,1)">

                                <label class="image_error" id="image_error"
                                    style="font-size: 12px;list-style: none;color: red;"></label><br>

                          {{-- <input type="file" class="form-control" id="image" name="image" value="{{$user['image']}}" placeholder="upload media" />                                
                       <span style="color: red">@error('image'){{$message}}@enderror</span><br> --}}
                           
                            
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/category/".$user->image}}" height="100px" width="100px"
                                    alt="preview image" style="max-height: 100px;">
                            </div>
                            <div class="text-center">
                            <a href="{{route('service_categories')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                            <button  class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('.image_error').hide();

    function ValidateAuthorImage(event, id) {
        var n = 0;
        var files = event.target.files;
        var image_id = event.target.id;
        var valid = true;
        var height = 0;
        var width = 0;
        var _URL = window.URL || window.webkitURL;
        for (var i = 0; i < files.length; i++) {

            var imagesize = files[0].size;

            var img = new Image();
            var reader = new FileReader();
            var files1 = $("#" + image_id + "").get(0).files[0];
            reader.onload = function() {
                var imagehtml =
                    `<div class="col-md-2 mb-2 uploaded-img-wrap" style="margin-left: 156px;" id="addImage">` +
                    `<img id="uploaded-image"` +
                    `src="${window.URL.createObjectURL(reader.result)}"` +
                    `class="img-fluid img-thumbnail" alt="Responsive image">` +
                    `<a onclick="removeTemp();" class="btn btn-danger removeTemp">Remove</a>` +
                    `</div>`;

                $(".image-display-div").html(imagehtml);
            }
            reader.readAsDataURL(files1);
            img.onload = function() {
                var height1 = img.height;
                var width1 = img.width;
                var aspect_ration = width1 / height1;

                var width = 512;
                var height = 512;
                var texthint = width + "*" + height
                var defined_aspect_ratio = 1; // height = 242 , width = 375


                if (imagesize <= 1033414) {

                    if (height1 == height && width1 == width) {
                        $("#image_error").hide()
                        $("#image_error").html("");
                        $('#add_category').removeAttr('disabled');
                    } else {
                        // if(!clickckeck.includes(image_id)){
                        n = n + 1;
                        // }
                        // clickckeck.push(image_id);
                        $("#image_error").show()
                        $("#image_error").html("Please upload another image with proper aspect size Example - (" +
                            texthint + ")");
                    }
                } else {
                    // if(!clickckeck.includes(image_id)){
                    n = n + 1;
                    // }
                    clickckeck.push(image_id);
                    $("#image_error").show()
                    $("#image_error").html("Please uplaod image less than or equal to 1 MB");
                }


                //console.log(urlvaliad);
                if (n != 0) {
                    console.log("a");
                    $('#add_category').prop('disabled', true);
                } else {
                    $('#add_category').removeAttr('disabled');
                }
            }

            img.src = _URL.createObjectURL(files[i]);
        }
    }
    $(document).ready(function(e) {


        $('#image').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
</script>

@endsection