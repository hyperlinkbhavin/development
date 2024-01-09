@extends('index')
@section('title', 'Edit Faq')
@section('main')


    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">

                        <div class="header">
                            <h2> Edit Provider Detail </h2><br>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_provider') }}" enctype="multipart/form-data"
                                data-parsley-validate="">
                                <input name="id" value="{{ $user['id'] }}" hidden>

                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">

                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    value="{{ $user['email'] }}" placeholder="Enter email" data-parsley-type="email"
                                                    data-parsley-required-message="This field is required" required>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <label for="country_code">Country Code</label>
                                        <div class="form-group">
                                            <div class="">
                                                <select class="js-example-basic-single" name="country_code"
                                                    id="country_code" data-parsley-min="1"
                                                    data-parsley-min-message="This field is required"
                                                    data-parsley-errors-container="#error_category" required="">
                                                    <option>Select Country Code</option>
                                                    @foreach ($code as $k)
                                                        {{ $k }}

                                                        <option @if ($user['country_code'] == $k['phonecode'] && $user['country_iso'] == $k['sortname']) selected @endif
                                                            value="{{ $k->phonecode }}">{{ $k->phonecode }}

                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="error_category"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" style="margin-left: 20px !important">
                                        <label for="mobile">Phone number</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="mobile" id="mobile" class="form-control" data-parsley-type="number" data-parsley-maxlength="15" style="margin-top: -3px;"
                                                    value="{{ $user['mobile'] }}"placeholder="Enter phone number"
                                                    data-parsley-required-message="This field is required" required>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="text-center">
                                    <a href="{{ route('service_provider') }}"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect"
                                        style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                    <button class="btn btn-raised btn-primary m-t-15 waves-effect"
                                        style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        $(document).ready(function(e) {
            // $('#image').on('change',function(){
            //     console.log('hcjdh')
            // })

            $('#image').change(function() {
                //   alert('hhe')
                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endsection
