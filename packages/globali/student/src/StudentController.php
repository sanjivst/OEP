<?php

namespace Globali\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student=Student::all();
        return view('student::student.students')->with('student',$student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student::student.form', ['layout' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::create($this->validateRequest());

        $this->storeImage($student);

        return redirect('admin/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        dd($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // dd($student);
        return view('student::student.form', ['layout' => 'edit'])->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'file|image|max:10000',
            'address' => 'required|max:50',
            'phone' => 'required|max:10|min:10|unique:students,phone,'.$id,
            'email' => 'required|email|unique:students,email,'.$id,
            'nationality' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'previous_course' => 'required',
            'selected_course' => 'required',
            'package_selected' => 'required',
        ]);

        $student = Student::find($id);
        $student->name = $request->input('name') ;
        $student->address = $request->input('address') ;
        $student->phone = $request->input('phone') ;
        $student->email = $request->input('email') ;
        $student->nationality = $request->input('nationality') ;
        $student->state = $request->input('state') ;
        $student->post_code = $request->input('post_code') ;
        $student->previous_course = $request->input('previous_course') ;
        $student->selected_course = $request->input('selected_course') ;
        $student->package_selected = $request->input('package_selected') ;

        if(request()->has('image')) {
            $this->storeImage($student);
        }

        $student->save() ;
        return redirect('admin/students') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        return redirect('admin/students');
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:2',
            'image' => 'required|file|image|max:10000',
            'address' => 'required|max:50',
            'phone' => 'required|max:10|min:10|unique:students',
            'email' => 'required|email|unique:students',
            'nationality' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'previous_course' => 'required',
            'selected_course' => 'required',
            'package_selected' => 'required',
        ]);
    }

    private function storeImage($student)
    {
        if(request()->has('image')) {
            $student->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }
}
