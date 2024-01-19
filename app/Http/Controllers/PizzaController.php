<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas =  Pizza::all();

        $data = [
            'status' => 200,
            'pizzas' => $pizzas
        ];
        return response()->json($data, 200);
    }
    public function upload(Request $request)
    {
        $validator = Validator($request->all(), [
            'size' => 'required', 'status' => 'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'status' => 422,
                "messages" => $validator->errors()
            ];
            return response()->json($data, 422);
        } else {
            $student = new Pizza();
            $student->user_id = $request->user_id;
            $student->size = $request->size;
            $student->crust = $request->size;
            $student->toppings = $request->toppings;
            $student->status = $request->status;
            $student->save();
            $data = [
                'status' => 200, 'message' => $student
            ];
            return response()->json($data, 200);
        }
    }
    public function edit(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'size' => 'required', 'status' => 'required'
        ]);
        if ($validator->fails()) {
            $data = [
                'status' => 422,
                "messages" => $validator->errors()
            ];
            return response()->json($data, 422);
        } else {
            $student =   Pizza::find($id);
            if (!$student) {
                $data = [
                    'status' => 404, 'message' => 'no record found'
                ];
                return  response()->json($data, 200);
            }

            $student->user_id = $request->user_id;
            $student->size = $request->size;
            $student->crust = $request->size;
            $student->toppings = $request->toppings;
            $student->status = $request->status;
            $student->save();
            $data = [
                'status' => 200, 'message' => $student
            ];
            return response()->json($data, 200);
        }
    }
    public function delete($id)
    {
        $student =   Pizza::find($id);
        if (!$student) {
            $data = [
                'status' => 404, 'message' => 'no record found'
            ];
            return  response()->json($data, 200);
        }
        $student->delete();

        $data = [
            'status' => 200, 'message' => $student
        ];
        return response()->json($data, 200);
    }
}
