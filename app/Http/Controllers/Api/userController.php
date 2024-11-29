<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function delete($id, Request $request)
    {
        
        $user = User::find($id);

        
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        
        $validated = $request->validate([
            'activoUser' => 'required|boolean',
            'estadoUser' => 'required|boolean',
        ]);

   
        $user->activoUser = $validated['activoUser'];
        $user->estadoUser = $validated['statusUser'];
        $user->save();

        
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'status' => 200,
            'data' => $user
        ], 200);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|digits:10', 
            'direction' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|string|min:8', 
        ]);
    
        
        $user = User::create([
            'id' => \Illuminate\Support\Str::uuid()->toString(), 
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'phone' => $validatedData['phone'],
            'direction' => $validatedData['direction'],
            'type' => $validatedData['type'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
        return response()->json([
            'message' => 'Usuario creado exitosamente.',
            'user' => $user,
        ]);
    }
    


    
}
