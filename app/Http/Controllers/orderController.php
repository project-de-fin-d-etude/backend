<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class orderController extends Controller
{
   public function placeOrder(Request $request){
    $date = Carbon::now();
     //dd( $date->timestamp);
    $this->validate($request, [
        'items'     =>  'required',
        'user_id'     =>  'required',
        'total_price'     =>  'required',
    ]);
    $data = array(
            'date'      => $date,
            'items'      => json_encode($request->items),
            'user_id'      =>  $request->user_id,
            'total_price'      =>  $request->total_price,
           );
        try {   
            $response =DB::table('orders')->insert($data);
            if ($response) {
                $response = ["message" => "Order  placed  successfully"];
                 $id = DB::getPdo()->lastInsertId();
                 $data["id"] = $id;
                 return response($data, 200);
            } else {
                $response = ["message" => "Order  failed"];
                return response($response, 422);
            }
        } catch (\Throwable $th) {
            return  response($th);

        }
   }
}
