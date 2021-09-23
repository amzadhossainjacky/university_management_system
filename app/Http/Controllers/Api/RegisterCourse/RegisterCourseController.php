<?php

namespace App\Http\Controllers\api\RegisterCourse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\RegisterCourse;
use Validator;
use Auth;

class RegisterCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
       
        //register Course
         try {

            $rules = [
            'rc_userId' => 'required|max:255',
            'rc_courseId' => 'required|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            //already taken course
            $alreadyTakenCourse = RegisterCourse::where('rc_userId', $request->rc_userId)
                                    ->where('rc_courseId', $request->rc_courseId)
                                    ->where('rc_status','valid')
                                    ->where('rc_complete','=', '0')
                                    ->orWhere('rc_userId', $request->rc_userId)
                                    ->where('rc_courseId', $request->rc_courseId)
                                    ->where('rc_status','valid')
                                    ->Where('rc_complete', '=', '1')
                                    ->first();

            if($alreadyTakenCourse == null){
                
                $registerCourse= RegisterCourse::create([
                'rc_userId' => $request->rc_userId,
                'rc_courseId' =>$request->rc_courseId,
                ]);

                $data = array();
                $data['message'] = 'success';
                return response()->json($data, 200);     
            }else{
                $data = array();
                $data['message'] = 'failed';
                $data['status'] = 'already taken course';
                return response()->json($data, 200);
            }

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
        //view all courses taken by student
        try {
            $allCourses = RegisterCourse::where('rc_userId', $id)->orderBy('id', 'desc')->get();
            $data = array();
            $data['message'] = 'success';
            $data['data'] = $allCourses;
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            return response([
                 'message' => $th->getMessage()
             ], 401);
        }
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

    public function drop($id){
        try {
            $dropCourse = array();
            $dropCourse['rc_status'] = 'drop';
            $update = RegisterCourse::where('id', $id)->update($dropCourse);

            $data = array();
            $data['message'] = 'success';
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            return response([
                 'message' => $th->getMessage()
             ], 401);
        }
    }
}
