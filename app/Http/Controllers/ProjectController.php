<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProductModel;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator) {
            $projects = Project::get();
        } else {
            $projects = Project::where('status', true)->get();
        }
        return view('projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extras = ProductModel::where('extra', true)->where('status', true)->get();

        return view('projects.create')
               ->with(compact('extras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $creator = auth()->user();
       $data = $request->all();
       /*
       $extras = implode(',', $data['extras']);
       $data['extras'] = json_encode($extras);
       */
       $data['created_by'] = $creator->id;
       $data['status'] = true;
       Project::create($data);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $extras = ProductModel::where('extra', true)->where('status', true)->get();

        return view('projects.edit', compact('project'))
               ->with(compact('extras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        /*
        $extras = implode(',', $data['extras']);
        $data['extras'] = json_encode($extras);
        */
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        if (!isset($data['salesing'])) {
            $data['salesing'] = false;
        }
        $project->update($data);

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->status = false;
        $project->save();

        return redirect()->route('projects.index');
    }
}
