<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class userController extends Controller
{
    public function index(Request $request){
        $user = DB::select('select * from users where id=?',[$request->input('id')]);

        return (json_encode($user));
        }
}
