<?php

namespace App\Http\Controllers\API;

use App\Models\Projects;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectsResource;
use Auth;
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

        if(!Auth::user()->is_admin) {
          $data['user_id'] = Auth::user()->id;
        }

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
        return response([ 'project' => new ProjectsResource($project), 'message' => 'Retrieved successfully'], 200);

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
      if ( Auth::check() && Auth::user()->is_admin || Auth::user()->id == $project->user_id) {

        $data = $request->all();

        if(array_key_exists('user_id', $data) && !Auth::user()->is_admin) {
          $data['user_id'] = Auth::user()->id;
        }

        $project->update($data);

        return response([ 'project' => new ProjectsResource($project), 'message' => 'Retrieved successfully'], 200);
      }
      return response([ 'message' => 'Not authorized' ]);
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
      if ( Auth::check() && Auth::user()->is_admin || Auth::user()->id == $project->user_id) {

        $project->delete();

        return response(['message' => 'Deleted']);
      }
      return response([ 'message' => 'Not authorized' ]);
    }
}