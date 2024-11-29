<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recharges;

class RechargesController extends Controller
{
    public function show ($id){

        $recharges = Recharges::where('user_id', $id)->get();

        if (!$recharges){

            $data = [

                'message' => 'el usuario no tiene recargas',
                'status' => 404

            ];

            return response()->json($data);

        }


        return response()->json($recharges, 200);


    }

    public function delete(Request $request)
    {
        try {
            
            $id = $request->input('id');
            $user_id = $request->input('user_id');

            if (!$id || !$user_id) {
                return response()->json([
                    'message' => 'El id y user_id son obligatorios',
                    'status' => 400
                ], 400);
            }

            $recharge = Recharges::where('id', $id)->where('user_id', $user_id)->first();

            if (!$recharge) {
                return response()->json([
                    'message' => 'Recarga no encontrada',
                    'status' => 404
                ], 404);
            }

           
            $recharge->activeRecharge = 0;
            $recharge->statusRecharge = 0;

          
            $recharge->save();

            return response()->json([
                'message' => 'Recarga eliminada',
                'data' => $recharge
            ], 200);
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Error al procesar la solicitud',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


    


}
