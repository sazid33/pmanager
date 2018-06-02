<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index', ['projects'=>$projects]);
        }

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $company_id = null )
    {

        //dump($project->id);
        $companies = null;
        if(!$company_id)
        {
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }

        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->Input('company_id'),
                'user_id' => Auth::user()->id
            ]);

            if($project){
                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success', 'Project Created Successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error Creating New project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //$project = Projects::where( 'id', $project->id )->first();
        $project = Project::find($project->id);

        $comments = $project->comments;

        return view('projects.show', ['project'=>$comments, 'comments'=>$comments] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);

        return view('projects.edit', ['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data
        $projectUpdate = Project::where('id', $project->id)->update([
            'name'=> $request->input('name'),
            'description'=> $request->input('description')
        ]);

        if($projectUpdate){
            return redirect()->route('projects.show', 
            ['project'=>$project->id])->with('success', 'project Updated Successfully');
        }

        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            
            //redirect
            return redirect()->route('projects.index')
            ->with('success', 'project Deleted Successfully');
        }

        return back()->withInput()->with('error', 'project Could not be Deleted');
        
    }
}
