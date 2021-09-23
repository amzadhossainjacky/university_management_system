<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view all students.
        try {
            $students = User::Where('role_id', 2)->get();
            return response()->json($students, 200);
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
        //create student
         try {

            $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $user= User::create([
            'name' =>$request->name,
            'role_id' =>2,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
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
        //update student
         try {

            $rules = [
            'name' => 'required|max:255',
            'email' => "required|max:255|unique:users,email,$id",
            'password' => 'required|min:6',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $student = array();
            $student['name'] = $request->name;
            $student['email'] = $request->email;
            $student['password'] = Hash::make($request->password);
            $update = User::where('id', $id)->update($student);

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
