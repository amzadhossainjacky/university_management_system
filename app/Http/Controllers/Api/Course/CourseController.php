<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Course;
use Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view all course
        try {
            $courses = Course::all();
            return response()->json($courses, 200);
        } catch (\Throwable $th) {
            return response([
                 'message' => $th->getMessage()
             ], 401);
        }
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
        //create course
        try {
            $rules = [
            'c_name' => 'required|unique:courses|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $course= Course::create([
                'c_name' =>$request->c_name,
            ]);

            $data = array();
            $data['message'] = 'success';
            return response()->json($data, 200);

        } catch (\Throwable $th) {
             return response([
                 'message' => $th->getMessage()
             ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
