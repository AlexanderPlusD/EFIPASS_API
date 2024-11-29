<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index() {

        $State = State::all();

        if ($State -> isEmpty()) {

            $data = [

                'message' => 'No hay registros disponibles',
                'status' => 404

            ];

            return response()->json($data);        

        }

        return response()->json($State);

    }


    public function show ($id) {

        $State = State::find($id);

        if (!$State){

            $data = [

                'message' => 'Estado no encontrado',
                'status' => 404

            ];

            return response()->json( $data, 200 );

        }

        return response()->json($State, 200);


    }


    public function delete($id) {


        try {

            $State = State::find($id);

            if (!$State){

                return response()->json([

                    'message'=> 'Estado no encontrado',
                    'status'=> 404


                ], status: 404);

            }


            $State->activeState = 0;
            $State->statusState = 0;

            $State->save();

            return response()->json([

                'message' => 'Estado desactivado correctamente',
                'data' => $State

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'message' => 'Error al desactivar el estado',
                'error' => $e->getMessage()

            ], status: 500);

        }


    }


    public function store(Request $request) {

        try {

            $name = $request->input('name');
            $images = $request->input('image');


            if (!$name){


                return response()->json() ([

                    'message'=> 'Proporciona los datos correctos',
                    'status'=> 404

                ], 404);

            }

            $state = State::create([

                'name'=> $name,
                'image' => $images

            ]);


            return response()->json([

                'message'=> 'Estado creado exitosamente',
                'data'=> $state

            
            ], 200);


        }catch  (\Exception $e){


            return response()->json([

                'message' => 'Error al crear estado',
                'error' => $e->getMessage()

            ]);


        }

    }
}
