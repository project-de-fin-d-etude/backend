<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class registerController extends Controller
{
    function send(Request $request){

        $this->validate($request, [
            'name'     =>  'required',
            'family_name'     =>  'required',
            'phone_number'     =>  'required',
            'email'     =>  'required',
            'address'     =>  'required',
            'type'     =>  'required',
            'password'     =>  'required',
        ]);
        $data = array(
                'name'      =>  $request->name,
                'family_name'      =>  $request->family_name,
                'phone_number'      =>  $request->phone_number,
                'email'      =>  $request->email,
                'address'   =>   $request->address,
                'type'   =>   $request->type,
                'password'   =>  Hash::make($request['password']),

            );
            try {
                $response =DB::table('users')->insert($data);
                if ($response) {
                    $response = ["message" => "User registered successfully"];
                    $id = DB::getPdo()->lastInsertId();;
                    $data["id"] = $id;
                    return response($data, 200);
                } else {
                    $response = ["message" => "User registration failed"];
                    return response($response, 422);
                }
            } catch (\Throwable $th) {
                return  response($th->getMessage(),$th->getCode());

            }

    }
}
