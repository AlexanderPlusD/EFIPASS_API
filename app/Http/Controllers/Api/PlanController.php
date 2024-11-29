<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index(){

        $plans = Plan::all();

        if($plans -> isEmpty()){

            $data = [

                'message' => 'No hay registros disponibles',
                'status' => 404

            ];

            return response()->json($data);

        }

        return response()->json($plans);

    }

    public function store(Request $request){

        $validator = Validator::make( $request -> all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'company' => 'required|string',
        ]);

        if($validator ->fails()){

            return response()->json([

                'message' => 'Erro de validación',
                'errors' => $validator->errors(),

            ]);

        }

        try {

            $Plan = Plan::create([

                'name'=> $request -> input('name'),
                'description'=> $request -> input('description'),
                'price'=> $request -> input('price'),
                'company' => $request -> input('company'),

            ]);

            return response()->json([

                'message' => 'Plan creado con éxito',
                'plan' => $Plan,

            ]);


        }catch(\Exception $e){

            return response()->json([

                'message' => 'Erro al crear el plan',
                'error' => $e->getMessage(),

            ]);


        }

    }
}
