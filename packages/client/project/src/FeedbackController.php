<?php

namespace Client\Project;

use App\User;
use Client\Project\Feedback;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Image;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $feedbacks=Feedback::all();
        return view('projects::feedback')
            ->with('feedbacks',$feedbacks)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $projects = Project::all();
        return view('projects::feedback_create',['projects'=>$projects])
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:100',
            'message'=>'required|string|max:255',
            'file'=>'mimes:xls,xlsx,doc,docx,pdf|max:500000',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('file')){
            $data['file'] = $this->file($request->file);
        }
        $feedback=new Feedback();
        $feedback->fill($data);
        $feedback->save();

        return redirect('admin/feedbacks');
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return void
     */
    public function show(Feedback $feedback)
    {
         dd($feedback);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feedback $feedback
     * @return Factory|View
     */
    public function edit(Feedback $feedback)
    {
        $projects = Project::all();
        return view('projects::feedback_edit',['feedback'=>$feedback,'projects'=>$projects])
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Feedback $feedback
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'title'=>'required|string|max:100',
            'message'=>'required|string|max:255',
            'file'=>'mimes:xls,xlsx,doc,docx,pdf|max:500000',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('file')){
            $file = base_path("feedback_files/{$feedback->file}");
            if (File::exists($file)) unlink($file);
            $data['file'] = $this->file($request->file);
        }
        $feedback->fill($data);
        $feedback->save();

        return redirect('admin/feedbacks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Feedback $feedback)
    {
        $file = base_path("feedback_files/{$feedback->file}");
        if (!empty($feedback->file) && File::exists($file)) unlink($file);
        $feedback->delete();
        return redirect('admin/feedbacks');
    }
    private function file($file)
    {
        $fileName = rand(1,99999).'-'.time().'.'.$file->extension();
        $file->move(base_path('feedback_files'), $fileName);
        return $fileName;
    }
}
