<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Need to paginate
        return [
            'data' => [
                'projects' => Project::all()->reject(function($project) {
                    return $project->deleted_at != null;
                })->values()
            ]
        ];  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:80',
            'description' => 'required|min:16'
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        return Project::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!DB::table('projects')->where('id', $id)->exists()) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        $project = Project::findOrFail($id);
        $comments = $request->query('c') === 'true' ? 
            Comment::where('project_id', $id)
            ->orderBy('created_at', 'asc')
            ->get() : [];

        return [
            'id' => $project->id,
            'title' => $project->title,
            'description' => $project->description,
            'comments' => $comments,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only(['title', 'description']);
        $input['id'] = $id;

        $validator = Validator::make($input, [
            'id' => 'exists:projects,id',
            'title' => 'required|string|max:80',
            'description' => 'required|min:16'
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('id')) {
                return response(['error' => 'Not found'], 404);
            }
        }

        $affected = DB::table('projects')
            ->where('id', $id)
            ->update($input);

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!DB::table('projects')->where('id', $id)->exists()) {
            return response('Not found', 404);
        }

        DB::table('projects')
            ->delete($id);

        return response(null, 204);
    }
}
