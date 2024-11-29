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

    public function delete($id, $user_id){

        try {


            $recharge = Recharges::where('id', $id)->where('user_id', $user_id)->first();

            if (!$recharge){

                return response()-json([

                'message' => 'Recarga no encontrada',
                'status' => 404

                ]);

            }


            $recharge->activeRecharge = 0;
            $recharge->statusRecharge = 0;

            $recharge->save();


            return response()->json ([

                'message' => 'Recarga eliminada',
                'data' => $recharge
            ], 200);




        }catch (\Exception $e){

        }


    }

    


}
