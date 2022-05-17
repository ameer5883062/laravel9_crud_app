<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// DataBase
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students_data = DB::table('students')->get();

        $student_images =
            DB::table('students')
            ->join('student_images', 'students.id', '=', 'student_images.student_id')
            ->select('student_images.*')
            ->get();

        if ($students_data->count() >= 1) {

            $response = [
                'status' => true,
                'message' => "Students data shown successfully!",
                'data' => [
                    'student' => $students_data,
                    'student_image' => $student_images,
                ]
            ];

            return response()->json($response);
        } else {
            $response = [
                'status' => false,
                'message' => "Students data not found!",
                'students' => null
            ];

            return response()->json($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = $request->get('name');
        $father_name = $request->get('father_name');
        $email_address = $request->get('email_address');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $gender = $request->get('gender');
        $image = $request->file('image');

        $email_address_check = DB::table('students')->where('email_address', '=', $email_address)->first();

        if (isset($email_address_check)) {
            $response = [
                'status' => false,
                'message' => "Email Address already taken please change it!",
            ];

            return response()->json($response);
        } else {

            $NewStudent = [
                'name' => $name,
                'father_name' => $father_name,
                'email_address' => $email_address,
                'contact_no' => $contact_no,
                'address' => $address,
                'gender' => $gender,
            ];

            if (($name != null) && ($father_name != null) && ($email_address != null) && ($contact_no != null) && ($address != null) && ($gender != null)) {

                $Student_Added = DB::table('students')->insert($NewStudent);

                $GetLastInsertedID = DB::getPdo()->lastInsertId($Student_Added);

                $imageName = "";
                $default_image = "";

                if (empty($image)) {
                    $default_image = "http://127.0.0.1:8000/assets/Students/images/no_image.png";
                } else {
                    $imageName =  $image->getClientOriginalName();

                    $path =  public_path('/assets/Students/upload_images/');

                    $request->image->move($path, $imageName);
                }

                $student_image =
                    [
                        'image' => $imageName,
                        'default_image' => $default_image,
                        'student_id' => $GetLastInsertedID
                    ];

                DB::table('student_images')->insert($student_image);

                $response = [
                    'status' => true,
                    'message' => "New student has been added successfully!"
                ];

                return response()->json($response);
            } else {
                $response = [
                    'status' => false,
                    'message' => "New student has not been added!",
                ];

                return response()->json($response);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student_data = DB::table('students')->find($id);

        $student_image =
            DB::table('student_images')
            ->select('student_images.*')
            ->where('student_id', $id)
            ->get();

        if ($student_data) {
            // Image check
            if ($student_image[0]->image == null) {
                $student_image[0]->default_image = "http://127.0.0.1:8000/assets/Students/images/no_image.png";
            } else {
                $student_image[0]->image = 'http://127.0.0.1:8000/assets/Students/upload_images/' . $student_image[0]->image;
            }

            $response = [
                'status' => true,
                'message' => "Student data of ID: $id shown successfully!",
                'data' => [
                    'student' => $student_data,
                    'student_image' => $student_image[0]
                ]
            ];

            return response()->json($response);
        } else {
            $response = [
                'status' => false,
                'message' => "Student data of ID: $id not found!",
                'student' => null
            ];

            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_data = DB::table('students')->find($id);

        $student_image =
            DB::table('student_images')
            ->select('student_images.*')
            ->where('student_id', $id)
            ->get();

        if ($student_data) {
            // Image check
            if ($student_image[0]->image == null) {
                $student_image[0]->default_image = "http://127.0.0.1:8000/assets/Students/images/no_image.png";
            } else {
                $student_image[0]->image = 'http://127.0.0.1:8000/assets/Students/upload_images/' . $student_image[0]->image;
            }

            $response = [
                'status' => true,
                'message' => "Student data of ID: $id shown successfully!",
                'data' => [
                    'student' => $student_data,
                    'student_image' => $student_image[0]
                ]
            ];

            return response()->json($response);
        } else {
            $response = [
                'status' => false,
                'message' => "Student data of ID: $id not found!",
                'student' => null
            ];

            return response()->json($response);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student_data = DB::table('students')->find($id);

        $student_image = DB::table('student_images')->find($id);

        $imageName = "";
        $default_image = "";

        $name = $request->get('name');
        $father_name = $request->get('father_name');
        $email_address = $request->get('email_address');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $gender = $request->get('gender');
        $image = $request->file('image');

        $UpdatedStudent = [
            'name' => $request->get('name'),
            'father_name' => $request->get('father_name'),
            'email_address' => $request->get('email_address'),
            'contact_no' => $request->get('contact_no'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
        ];

        if ($student_data) {

            if (($name != null) && ($father_name != null) && ($email_address != null) && ($contact_no != null) && ($address != null) && ($gender != null)) {

                if (empty($image)) {
                    $default_image = "/assets/Students/upload_images/$student_image->image";

                    $Student_Updated = DB::table('students')->where('id', $id)->update($UpdatedStudent);

                    DB::getPdo()->lastInsertId($Student_Updated);

                    $UpdatedStudent = [
                        'image' => $imageName,
                        'default_image' => $default_image,
                    ];

                    DB::table('student_images')->where('id', $id)->update($UpdatedStudent);

                    $response = [
                        'status' => true,
                        'message' => "Student of ID: $id has been updated successfully!"
                    ];

                    return response()->json($response);
                } else {

                    $imageName = $image->getClientOriginalName();

                    $path = public_path('/assets/Students/upload_images/');

                    $request->image->move($path, $imageName);

                    $Student_Updated = DB::table('students')->where('id', $id)->update($UpdatedStudent);

                    DB::getPdo()->lastInsertId($Student_Updated);

                    $UpdatedStudent = [
                        'image' => $imageName,
                        'default_image' => $default_image,
                    ];

                    DB::table('student_images')->where('id', $id)->update($UpdatedStudent);

                    $response = [
                        'status' => true,
                        'message' => "Student of ID: $id has been updated successfully!"
                    ];

                    return response()->json($response);
                }
            }
        } else {
            $response = [
                'status' => false,
                'message' => "Student data of ID: $id not be found!"
            ];

            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $student_data =
            DB::table('students')->find($id);

        $student_image = DB::table('student_images')->find($id);

        if ($student_data) {
            if ($student_image->default_image != null) {

                DB::table('students')->delete($id);
                DB::table('student_images')->delete($id);

                $response = [
                    'status' => true,
                    'message' => "Student of ID: $id has been deleted successfully!"
                ];

                return response()->json($response);
            } else {

                unlink(public_path('/assets/Students/upload_images/' . $student_image->image));

                DB::table('students')->delete($id);
                DB::table('student_images')->delete($id);

                $response = [
                    'status' => true,
                    'message' => "Student of ID: $id has been deleted successfully!"
                ];

                return response()->json($response);
            }
        } else {
            $response = [
                'status' => false,
                'message' => "Student data of ID: $id not be found!"
            ];

            return response()->json($response);
        }
    }
}
