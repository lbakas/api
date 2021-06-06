<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response([ 'users' => UsersResource::collection($users), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ( Auth::check() && Auth::user()->is_admin ) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response([ 'user' => new UsersResource($user), 'message' => 'Created successfully'], 200);
      }

      return response([ 'message' => 'Not authorized' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projects  $project
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response([ 'user' => new UsersResource($user), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      if ( Auth::check() && Auth::user()->is_admin || Auth::user()->id == $user->id) {

        $data = $request->all();

        if (array_key_exists('password', $data)) {
          $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response([ 'user' => new UsersResource($user), 'message' => 'Retrieved successfully'], 200);
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
    public function destroy(User $user)
    {
      if ( Auth::check() && Auth::user()->is_admin ) {

        $user->delete();

        return response(['message' => 'Deleted']);
      }
      return response([ 'message' => 'Not authorized' ]);
    }
}