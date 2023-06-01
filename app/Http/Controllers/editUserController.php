<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class editUserController extends Controller
{
    public function index(Request $request){
    $this->validate($request, [
        'name'     =>  'required',
        'family_name'     =>  'required',
        'phone_number'     =>  'required',
        'email'     =>  'required',
        'address'     =>  'required',
    ]);
    $data = array(
            'name'      =>  $request->name,
            'family_name'      =>  $request->family_name,
            'phone_number'      =>  $request->phone_number,
            'email'      =>  $request->email,
            'address'   =>   $request->address,
        );
        try {
            $response =DB::table('users')->where('id',[$request->input('id')])->update(array(
                'name'      =>  $request->name,
                'family_name'      =>  $request->family_name,
                'phone_number'      =>  $request->phone_number,
                'email'      =>  $request->email,
                'address'   =>   $request->address,
));
            if ($response) {
                $response = ["message" => "User registered successfully"];
                $id = DB::getPdo()->lastInsertId();;
                $data["id"] = $id;
                return response($data, 200);
            } 
            else {
                $response = ["message" => "User registration failed"];
                return response($response, 422);
            }
        } catch (\Throwable $th) {
            return  response($th);

        }

       }
}
