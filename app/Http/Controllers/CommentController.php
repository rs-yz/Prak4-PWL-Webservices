<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $input['project_id'] = $request->project_id;

        $validator = Validator::make($input, [
            'name' => 'required',
            'comment' => 'required',
            'project_id' => 'required|exists:projects,id'
        ]);

        if ($validator->fails()){
            if ($validator->errors()->has('project_id')) {
                return response()->json([
                    'errors' => 'Project not found'
                ], 404);
            }

            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        return Comment::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $project_id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id) {
        if (!DB::table('projects')->where('id', $project_id)->exists()) {
            return response()->json([
                'errors' => 'Project not found'
            ], 404);
        }

        return [
            "data" => [
                "comments" => Comment::where('project_id', $project_id)
                        ->orderBy('created_at', 'desc')
                        ->get()
            ]
        ];
    }
}
