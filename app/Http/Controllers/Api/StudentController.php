<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if ($students->isEmpty()) {
            $data = ['status' => 404, 'message' => 'No record found'];
        } else {
            $data = ['status' => 200, 'students' => $students];
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',

        ]);
        if ($validator->fails()) {
            $data = ['status' => 422, 'errors' => $validator->errors()];
            return response()->json($data, 200);
        }

        $students = Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        if (!$students) {
            return response()->json(['status' => 500, 'message' => 'something went wrong'], 200);
        }
        return response()->json(['status' => 200, 'message' => 'Student created successfully'], 200);
    }
    public function show($id)
    {
        $students = Student::find($id);
        if (!$students) {
            $data = ['status' => 404, 'message' => 'No record found'];
        } else {
            $data = ['status' => 200, 'students' => $students];
        }
        return response()->json($data, 200);
    }
    public function edit($id)
    {
        $students = Student::find($id);
        if (!$students) {
            $data = ['status' => 404, 'message' => 'No record found'];
        } else {
            $data = ['status' => 200, 'students' => $students];
        }
        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $students = Student::find($id);
        if (!$students) {
            $data = ['status' => 404, 'message' => 'No record found'];
        } else {
            $students->delete();
            $data = ['status' => 200, 'students' => 'student named ' . $students->name . ' deleted successfully'];
        }
        return response()->json($data, 200);
    }
    public function update(Request $request, int $id)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',

        ]);
        if ($validator->fails()) {
            $data = ['status' => 422, 'errors' => $validator->errors()];
            return response()->json($data, 200);
        }
        $students = Student::find($id);
        if (!$students) {
            return response()->json(['status' => 500, 'message' => 'No such student found'], 200);
        }
        $students->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json(['status' => 200, 'message' => 'Student updated successfully'], 200);
    }
}
