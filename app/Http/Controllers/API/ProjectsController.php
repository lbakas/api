<?php

namespace App\Http\Controllers\API;

use App\Projects;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projects::all();
        return response([ 'projects' => ProjectsResource::collection($projects), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $project = Projects::create($data);

        return response([ 'project' => new ProjectsResource($project), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projects  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project)
    {
        return response([ 'project' => new CEOResource($project), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projects $project)
    {

        $project->update($request->all());

        return response([ 'project' => new ProjectsResource($project), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Projects $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Projects $project)
    {
        $project->delete();

        return response(['message' => 'Deleted']);
    }
}