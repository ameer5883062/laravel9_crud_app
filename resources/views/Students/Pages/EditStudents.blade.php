@extends('Students.Layouts.index')

@section('PageTitle')
Edit Student
@endsection

@section('Content')

@section('Header')

<!-- Page Heading -->
<div class="container-fluid main_color shadow-lg">
    <div class="container pb-2 pt-3">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="text-white h3">Simple Laravel 9 CRUD Application</div>
            </div>
            <div class="col-sm-6">
                <a href="" class="btn btn-light logout_btn float-end">Log out</a>
            </div><!-- col-sm-6 end -->
        </div>
    </div>
</div>
@endsection



<!-- Container Start -->
<div class="container shadow-lg">
    <div class="row main_color mt-5  pb-2 pt-3">
        <div class="col-sm-6">
            <div class="text-white h3 mt-1">Edit Student</div>
        </div><!-- col-sm-6 end -->
        <div class="col-sm-6">
            <a href="{{ URL('/') }}" class="btn btn-light float-end">students list</a>
        </div><!-- col-sm-6 end -->
    </div><!-- row end -->

    <div class="row mt-5 pb-5">
        <div class="col-sm-12">

            <form method="POST" action="{{ URL('/update_student/'.$students->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value={{ $students->id }} >
                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="name" class="mr-sm-2">Name</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                            placeholder="Enter Your Name" name="name" value="{{ $students->name }}">
                        <!-- Display Error Message -->
                        @if ($errors->has('name'))
                        <span class="invalid feedback">
                            <span class="text-danger">{{ $errors->first('name') }}.</span>
                        </span>
                        @endif
                    </div><!-- col-md-6 col-sm-12 end -->
                    <div class="col-md-6 col-sm-12">
                        <label for="father_name" class="mr-sm-2">Father Name</label>
                        <input type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}"
                            id="father_name" placeholder="Enter Your Father Name" name="father_name"
                            value="{{ $students->father_name}}"><!-- Display Error Message -->
                        @if ($errors->has('father_name'))
                        <span class="invalid feedback">
                            <span class="text-danger">{{ $errors->first('father_name') }}.</span>
                        </span>
                        @endif
                    </div><!-- col-md-6 col-sm-12 end -->
                </div><!-- form-row end -->

                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="email_address" class="mr-sm-2">Email Address</label>
                        <input type="email" class="form-control{{ $errors->has('email_address') ? ' is-invalid' : '' }}"
                            id="email_address" placeholder="Enter Your Email Address" name="email_address"
                            value="{{ $students->email_address }}"><!-- Display Error Message -->
                        @if ($errors->has('email_address'))
                        <span class="invalid feedback">
                            <span class="text-danger">{{ $errors->first('email_address') }}.</span>
                        </span>
                        @endif
                    </div><!-- col-md-6 col-sm-12 end -->
                    <div class="col-md-6 col-sm-12">
                        <label for="contact_no" class="mr-sm-2">Contact Number</label>
                        <input type="number" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}"
                            id="contact_no" placeholder="Enter Your Contact Number" name="contact_no"
                            value="{{ $students->contact_no }}"><!-- Display Error Message -->
                        @if ($errors->has('contact_no'))
                        <span class="invalid feedback">
                            <span class="text-danger">{{ $errors->first('contact_no') }}.</span>
                        </span>
                        @endif
                    </div><!-- col-md-6 col-sm-12 end -->
                </div><!-- form-row end -->

                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="address" class="mr-sm-2">Address</label>
                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                            id="address" placeholder="Enter Your Address" name="address"
                            value="{{ $students->address }}">
                        <!-- Display Error Message -->
                        @if ($errors->has('address'))
                        <span class="invalid feedback">
                            <span class="text-danger">{{ $errors->first('address') }}.</span>
                        </span>
                        @endif
                    </div><!-- col-md-6 col-sm-12 end -->
                    <div class="col-md-6 col-sm-12">
                        <label for="gender" class="mr-sm-2">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="Male" @if ($students->gender == "Male") {{ 'selected' }} @endif>Male</option>
                            <option value="Female" @if ($students->gender == "Female") {{ 'selected' }} @endif>Female
                            </option>
                        </select>
                    </div><!-- col-md-6 col-sm-12 end -->
                </div><!-- form-row end -->

                <div class="row mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="image" class="file-label mr-sm-2">Image</label>
                        <div class="row">
                            <div class="col-sm-8 col-md-10">
                                <div class="custom-file">
                                    <input class="form-control" type="file" id="image" name="image">
                                </div><!-- custom-file end -->
                            </div><!-- col-sm-8 col-md-10 end -->
                            <div class="col-sm-4 col-md-2">
                                @if (($students->image == NULL) || ($students->image == ""))
                                <img src="{{ $students->default_image }}" class="rounded-circle" id="display_image">
                                @else
                                <img src="{{ URL::asset('http://127.0.0.1:8000/assets/Students/upload_images/'.$students->image) }}"
                                    class="rounded-circle" id="display_image">
                                @endif
                            </div><!-- col-sm-4 col-md-2 end -->
                            <!-- Display Error Message -->
                            @if ($errors->has('image'))
                            <span class="invalid feedback">
                                <span class="alert alert-danger text-danger">{{ $errors->first('image') }}.</span>
                            </span>
                            @endif
                        </div><!-- form-row end-->
                    </div><!-- col-md-6 col-sm-12 end -->
                </div><!-- form-row end-->

                <!-- Single Border -->
                <hr>

                <!-- Buttons -->
                <div class="float-md-end mt-4 mb-4">
                    <button type="button" class="btn btn-danger" name="cancel" onclick="history.back()">Cancel</button>
                    <input type="reset" class="btn btn-success" value="Reset">
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                </div>

        </div><!-- form-row end -->

        </form><!-- form end -->
    </div><!-- col-sm-12 end -->
</div><!-- row end -->
</div>
<!-- Container End -->
@endsection

<!-- Jquery Link-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {


        $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#display_image').attr('src', e.target.result);
            }

            let data = reader.readAsDataURL(this.files[0]);

        });

    });

</script>