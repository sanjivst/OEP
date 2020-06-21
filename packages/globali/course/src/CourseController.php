<?php

namespace Globali\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course=Course::all();
        return view('course::course.courses')->with('course',$course);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course::course.form', ['layout' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $course = Course::create($this->validateRequest());

        $this->storeImage($course);

        return redirect('admin/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        dd($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course::course.form', ['layout' => 'edit'])->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:2',
            'description' => 'required|string',
            'image' => 'file|image|max:10000',
            'faculty' => 'required',
            'associated_uni' => 'required',
            'opportunities' => 'required|string',
            'associated_teacher' => 'required',
        ]);

        $course = Course::find($id);
        $course->name = $request->input('name') ;
        $course->description = $request->input('description') ;
        $course->faculty = $request->input('faculty') ;
        $course->associated_uni = $request->input('associated_uni') ;
        $course->opportunities = $request->input('opportunities') ;
        $course->online_course = $request->input('online_course') ;
        $course->online_exam= $request->input('online_exam') ;
        $course->associated_teacher = $request->input('associated_teacher') ;
        
        if(request()->has('image')) {
            $this->storeImage($course);
        }

        $course->save() ;
        return redirect('admin/courses') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course=Course::find($id);
        $course->delete();
        return redirect('admin/courses');
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:2',
            'description' => 'required|string',
            'image' => 'required|file|image|max:10000',
            'faculty' => 'required',
            'associated_uni' => 'required',
            'opportunities' => 'required|string',
            'associated_teacher' => 'required',
        ]);
    }

    private function storeImage($course)
    {
        if(request()->has('image')) {
            $course->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }
}
