<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function index(){

        $users = User::all();

        if($users->isEmpty()){

            $data = [
                'message' => 'No hay registros disponibles',
                'status' => 404
            ];

            return response()->json($data);

        }

        return response()->json($users,200);

    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        return response()->json($user, 200);
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                    'status' => 404
                ], 404);
            }

            
            $user->activeUser = 0;
            $user->statusUser = 0;

            $user->save();

            return response()->json([
                'message' => 'Usuario desactivado correctamente',
                'status' => 200,
                'data' => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al desactivar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone',
            'address' => 'required|string|max:255',
            'type' => 'required|string|in:admin,user',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'message' => 'Usuario creado exitosamente.',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
