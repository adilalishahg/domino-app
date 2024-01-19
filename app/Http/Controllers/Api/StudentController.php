<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

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
}
