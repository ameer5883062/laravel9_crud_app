<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Site Favicon -->
    <link rel="shortcut icon" href="{{ URL('assets/Students/images/favicon.svg') }}">
    <!-- Site Title -->
    <title>Laravel 9 || @yield('PageTitle')</title>
    <!-- Google Fonts Css Link -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- Bootstrap5 Css Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Fontawesome Icon Link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Custom Css File Link -->
    <link rel="stylesheet" href="{{ URL('assets/Students/style.css') }}">
    <!-- Data Tables Link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<body>

    <div class="container-fluid p-0">
        @section('Header')
        @show
        @yield('Content')
    </div>
    <!-- Bootstrap5 Js Link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Js Data Tables Link -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script>
        // Data Table
        $('#data_table').DataTable({
        lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All'],
        ],
        });

        // Sweet Alert for Add/Storing data
        @if(session('status_title'))
        swal({
            title: "{{ session('status_title') }}",
            text: "{{ session('status_text') }}",
            icon: "{{ session('status_icon') }}",
            button: "Ok",
        });
        @endif

        // Sweet Alert for Removing/Deleting data
        $(document).ready(function() {
            $('.confirm_delete_btn').click(function(e) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                e.preventDefault();
                swal({
                        title: "Are you sure you want to delete this record?",
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        type: "warning",
                        buttons: true,
                        dangerMode: true,
                        }).then((willDelete) => {
                        if (willDelete) {
                        form.submit();
                    }
                });
            });
        });


        // View Modal
        $(document).ready(function(){

            $('body').on('click', '#student_detail_modal', function () {
                    var URL = $(this).data('url');
                    $.get(URL, function (response) {
                    $('#Students_Detail_Modal').modal('show');
                    $('#name').val(response.student.name);
                    $('#father_name').val(response.student.father_name);
                    $('#email_address').val(response.student.email_address);
                    $('#address').val(response.student.address);
                    $('#contact_no').val(response.student.contact_no);
                    $('#gender').val(response.student.gender);
                    if ((response.student_images[0].image == "") || (response.student_images[0].image == null)) {
                    $('#image').attr('src', response.student_images[0].default_image);
                    } else {
                    $('#image').attr('src', '/assets/Students/upload_images/' + response.student_images[0].image);
                    }
                })
            });
        });
        
        // Sweet Alert for Update data
        @if(session('status_title'))
        swal({
            title: "{{ session('status_title') }}",
            text: "{{ session('status_text') }}",
            icon: "{{ session('status_icon') }}",
            button: "Ok",
        });
        @endif

        
    </script>

    <body>

</html>