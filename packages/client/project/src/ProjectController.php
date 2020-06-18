<?php

namespace Client\Project;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $projects=Project::all();
        return view('projects::project')
            ->with('projects',$projects)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::where('role',3)->get();
        return view('projects::project_create',['users'=>$users])
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
            'name'=>'required|string',
            'type'=>'required|string',
            'excerpt'=>'required|string',
            'detail'=>'required|string',
            'logo'=>'mimes:jpeg,bmp,png|max:100000',
            'thumbnail'=>'mimes:jpeg,bmp,png|max:200000',
            'banner'=>'mimes:jpeg,bmp,png|max:500000',
            'featured_image'=>'mimes:jpeg,bmp,png|max:500000',
            'web'=>'url|nullable',
            'platform'=>'string|max:255|nullable',
            'designed'=>'string|max:255|nullable',
            'tools'=>'string|max:255|nullable',
            'address'=>'string|max:255|nullable',
            'email'=>'string|email|nullable',
            'phone'=>'string|max:10|nullable',
            'mobile'=>'string|max:10|nullable',
            'work_progress'=>'string',
            'other'=>'string|max:255|nullable',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('logo')){
            $data['logo'] = $this->image($request->logo);
        }
        if($request->hasFile('thumbnail')){
            $data['thumbnail'] = $this->image($request->thumbnail);
        }
        if($request->hasFile('banner')){
            $data['banner'] = $this->image($request->banner);
        }
        if($request->hasFile('featured_image')){
            $data['featured_image'] = $this->image($request->featured_image);
        }
        $project=new Project();

        $slug = ($request->slug)?
            preg_replace('/\s/', '-', $request->slug):
            preg_replace('/\s/', '-', $request->name);

        $data['slug']=$this->getSlug($slug);

        $project->fill($data);
        $project->save();

        return redirect('admin/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return void
     */
    public function show(Project $project)
    {
         dd($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Factory|View
     */
    public function edit(Project $project)
    {
        $users = User::where('role',3)->get();
        return view('projects::project_edit',['project'=>$project,'users'=>$users])
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'=>'required|string',
            'type'=>'required|string',
            'excerpt'=>'required|string',
            'detail'=>'required|string',
            'logo'=>'mimes:jpeg,bmp,png|max:100000',
            'thumbnail'=>'mimes:jpeg,bmp,png|max:200000',
            'banner'=>'mimes:jpeg,bmp,png|max:500000',
            'featured_image'=>'mimes:jpeg,bmp,png|max:500000',
            'web'=>'url|nullable',
            'platform'=>'string|max:255|nullable',
            'designed'=>'string|max:255|nullable',
            'tools'=>'string|max:255|nullable',
            'address'=>'string|max:255|nullable',
            'email'=>'string|email|nullable',
            'phone'=>'string|max:10|nullable',
            'mobile'=>'string|max:10|nullable',
            'work_progress'=>'string',
            'other'=>'string|max:255|nullable',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('logo')){
            if($project->logo)
            {
                
            $image = public_path("project_images/{$project->logo}");
            if (File::exists($image)) unlink($image);
            }
            $data['logo'] = $this->image($request->logo);
        }
        if($request->hasFile('thumbnail')){
            if($project->thumbnail){
            $image = public_path("project_images/{$project->thumbnail}");
            if (File::exists($image)) unlink($image);
            }
            $data['thumbnail'] = $this->image($request->thumbnail);
        }
        if($request->hasFile('banner')){
            if($project->banner){
            $image = public_path("project_images/{$project->banner}");
            if (File::exists($image)) unlink($image);
            }
            $data['banner'] = $this->image($request->banner);
        }
        if($request->hasFile('featured_image')){
            if($project->featured_image){
            $image = public_path("project_images/{$project->featured_image}");
            if (File::exists($image)) unlink($image);
            }
            $data['featured_image'] = $this->image($request->featured_image);
        }

        if($request->slug)
            $data['slug']=$this->getSlug($request->slug,$project->id);

        $project->fill($data);
        $project->save();

        return redirect('admin/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $image = public_path("project_images/{$project->logo}");
        if (!empty($project->logo) && File::exists($image)) unlink($image);
        $image = public_path("project_images/{$project->thumbnail}");
        if (!empty($project->thumbnail) && File::exists($image)) unlink($image);
        $image = public_path("project_images/{$project->banner}");
        if (!empty($project->banner) && File::exists($image)) unlink($image);
        $image = public_path("project_images/{$project->featured_image}");
        if (!empty($project->featured_image) && File::exists($image)) unlink($image);

        $project->delete();
        return redirect('admin/projects');
    }
    private function image($image)
    {
        //dd($image);
        $imageName = rand(1,99999).'-'.time().'.'.$image->extension();
        $image->move(public_path('project_images'), $imageName);
        return $imageName;
    }
    private function getSlug($r_slug,$model_id=0)
    {
        if(Project::where('slug',$r_slug)->whereNotIn('id',[$model_id])->get()->count()>0)
        {
            $string_slug = explode('-',$r_slug);
            $increment = end($string_slug);
            if(is_numeric($increment))
            {
                $increment++;
                array_pop($string_slug);
            }
            else
            {
                $increment = 1;
            }
            $r_slug = implode('-',$string_slug);
            $r_slug .= '-'.$increment;
            return $this->getSlug($r_slug,$model_id);
        }
        else
        {
            return $r_slug;
        }
    }
}
