<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// DataBase
use Illuminate\Support\Facades\DB;

// Session
use Illuminate\Support\Facades\Session;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students_data = DB::table('students')
            ->join('student_images', 'students.id', '=', 'student_images.student_id')
            ->select('students.*', 'student_images.*')
            ->get();

        return view('Students.Pages.index', ['students' => $students_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Students.Pages.AddStudents');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validation = $request->validate([
            'name' => 'required|min:3|max:15',
            'father_name' => 'required|min:3|max:15',
            'email_address' => 'required|email|unique:students,email_address',
            'contact_no' => 'required|min:11|max:11',
            'address' => 'required',
            'gender' => 'required',
        ]);

        if (isset($Validation)) {

            $NewStudent = [
                'name' => $request->get('name'),
                'father_name' => $request->get('father_name'),
                'email_address' => $request->get('email_address'),
                'contact_no' => $request->get('contact_no'),
                'address' => $request->get('address'),
                'gender' => $request->get('gender'),
            ];

            $Student_Added = DB::table('students')->insert($NewStudent);

            $GetLastInsertedID = DB::getPdo()->lastInsertId($Student_Added);

            $imageName = "";
            $default_image = "";

            $image = $request->file('image');

            if (empty($image)) {
                $default_image = "http://127.0.0.1:8000/assets/Students/images/no_image.png";
            } else {
                $imageName =  $image->getClientOriginalName();

                $path =  public_path('/assets/Students/upload_images/');

                $request->image->move($path, $imageName);
            }

            $response =
                [
                    'image' => $imageName,
                    'default_image' => $default_image,
                    'student_id' => $GetLastInsertedID
                ];

            DB::table('student_images')->insert($response);

            Session::flash('status_icon', 'success');
            return redirect('/')->with('status_title', 'Data Added!')->with('status_text', 'New student has been added successfully!');
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

        $student_images =
            DB::table('student_images')
            ->select('student_images.*')
            ->where('student_id', $student_data->id)
            ->get();

        $students_detail =
            [
                'student' => $student_data,
                'student_images' => $student_images
            ];

        return response()->json($students_detail);
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
            ->where('student_id', $student_data->id)
            ->get();

        return view('Students.Pages.EditStudents', ['students' =>  $student_data, 'student_image' => $student_image]);
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
        $Validation = $request->validate([
            'name' => 'required|min:3|max:15',
            'father_name' => 'required|min:3|max:15',
            'email_address' => 'required|email',
            'contact_no' => 'required|min:11|max:11',
            'address' => 'required',
            // 'image' => 'required',   
        ]);

        if (isset($Validation)) {

            $Student = [
                'name' => $request->get('name'),
                'father_name' => $request->get('father_name'),
                'email_address' => $request->get('email_address'),
                'contact_no' => $request->get('contact_no'),
                'address' => $request->get('address'),
                'gender' => $request->get('gender'),
            ];

            $Student_Updated = DB::table('students')->where('id', $id)->update($Student);

            DB::getPdo()->lastInsertId($Student_Updated);

            $student_image = DB::table('student_images')->find($id);

            $imageName = "";
            $default_image = "";

            $image = $request->file('image');

            if (empty($image)) {
                $default_image =  "/assets/Students/upload_images/$student_image->image";

                $UpdatedStudent = [
                    'image' => $imageName,
                    'default_image' => $default_image,
                ];

                DB::table('student_images')->where('id', $id)->update($UpdatedStudent);

                Session::flash('status_icon', 'success');
                return redirect('/')->with('status_title', 'Data updated!')->with('status_text', 'Student has been updated successfully!');
            } else {
                $imageName =  $image->getClientOriginalName();

                $path =  public_path('/assets/Students/upload_images/');

                $request->image->move($path, $imageName);

                $UpdatedStudent = [
                    'image' => $imageName,
                    'default_image' => $default_image,
                ];

                DB::table('student_images')->where('id', $id)->update($UpdatedStudent);

                Session::flash('status_icon', 'success');
                return redirect('/')->with('status_title', 'Data updated!')->with('status_text', 'Student has been updated successfully!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('students')->find($request->id);

        $student_images = DB::table('student_images')->find($request->id);

        if ($student_images->image == "") {
            DB::table('students')->delete($id);
            DB::table('student_images')->delete($id);

            Session::flash('status_icon', 'success');
            return redirect('/')->with('status_title', 'Data Deleted!')->with('status_text', 'Student has been deleted successfully!');
        } else {
            unlink(public_path('/assets/Students/upload_images/' . $student_images->image));

            DB::table('students')->delete($id);
            DB::table('student_images')->delete($id);

            Session::flash('status_icon', 'success');
            return redirect('/')->with('status_title', 'Data Deleted!')->with('status_text', 'Student has been deleted successfully!');
        }
    }
}
