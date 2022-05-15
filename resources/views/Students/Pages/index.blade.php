@extends('Students.Layouts.index')

@section('PageTitle')
Students List
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

<div class="container mt-4 mt-3" id="alert">
    <div class="row">
        <div class="col-md-4 offset-md-8">
            <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show">
                <div>
                    An example warning alert with an icon
                </div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<!-- Container Start -->
<div class="container shadow-lg">
    <div class="row main_color pb-2 pt-3 margin">
        <div class="col-sm-6">
            <div class="text-white h3 mt-1">Students List</div>
        </div><!-- col-sm-6 end -->
        <div class="col-sm-6">
            <a href="{{ URL('/create_student') }}" class="btn btn-light float-end">add student</a>
        </div><!-- col-sm-6 end -->
    </div><!-- row end -->

    <div class="row mt-5 pb-5">
        <div class="col-sm-12">
            <table class="table table-bordered table-striped table-responsive-sm w-100" id="data_table">
                <thead class="main_color text-light">
                    <tr>
                        <th>Sr#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Gender</th>
                        <th>Contact No</th>
                        <th>Actions</th>
                    </tr>
                </thead><!-- thead end -->
                <tbody>
                    @foreach($students as $student)
                    <tr class="row_id">
                        <td>{{ $student->id }}</td>
                        <td>
                            @if($student->image != NULL)
                            <img src={{
                                URL::asset('http://127.0.0.1:8000/assets/Students/upload_images/'.$student->image) }}
                            class="rounded-circle border border-light border-3 shadow" width="80" height="80">
                            @else
                            <img src={{ $student->default_image }}
                            class="rounded img-thumbnail" width="80">
                            @endif
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->contact_no }}</td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm px-3 float-start" id="student_detail_modal"
                                data-url="{{ URL('view_student/'.$student->id) }}"><i
                                    class="fa fa-book-open me-2"></i>View</a>
                            <a href="{{ URL('edit_student/'.$student->id) }}"
                                class="btn btn-primary btn-sm px-3 mx-2 float-start"><i
                                    class="fa fa-edit me-2"></i>Edit</a>

                            <form method="POST" class="float-start" action="{{ URL('delete_student/'.$student->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="px-3 btn btn-danger btn-sm confirm_delete_btn"><i
                                        class="fas fa-trash-alt me-2"></i>Delete</button>
                            </form>
                    </tr>
                    @endforeach
                </tbody><!-- tbody end -->
            </table><!-- table end -->
        </div><!-- col-sm-12 end -->
    </div><!-- row end -->
    <!-- The Modal -->
    <div class="modal fade" id="Students_Detail_Modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-light main_color">
                    <h3 class="modal-title ">Students Detail</h3>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-header">
                    <img src="" id="image" alt="Image" height="120" width="120" class="rounded-circle mx-auto">
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name:</label>
                                <div>
                                    <input class="form-control" id="name" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Father Name:</label>
                                <div>
                                    <input class="form-control" id="father_name" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Contact No:</label>
                                <div>
                                    <input class="form-control" id="contact_no" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email Address:</label>
                                <div>
                                    <input class="form-control" id="email_address" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Address:</label>
                                <div>
                                    <input class="form-control" id="address" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Gender:</label>
                                <div>
                                    <input class="form-control" id="gender" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
    @endsection