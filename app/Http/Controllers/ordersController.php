<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ordersController extends Controller
{
    public function index(Request $request){
        // dd($request->input('user_id'));
        $orders = DB::select('select * from orders where user_id=?',[$request->input('user_id')]);
        $user = DB::select('select * from users where id=?',[$request->input('user_id')]);
        foreach ($orders as $key => $value) {
            $value->items = json_decode($value->items);
            $value->user = $user[0];

        //    dd($value,$key);
        }
        return ($orders);
        }
}
