<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class owner_products_controller extends Controller
{
    public function index(Request $request)
    {
        $owner_id = $request->input('owner_id');
        $products = $owner_id ? DB::select('select * from product where owner_id=?', [$owner_id]) : DB::select('select * from product');
        foreach ($products as $key => $value) {
            $value->category_payload = DB::select('select * from category where id=?', [$value->category_id])[0];
        }
        return (['products' => $products]);
    }
    public function edit_product(Request $request)
    {
        if ($request->file('image')) {
            $uploadedFile = $request->file('image');
            $photoPath = $uploadedFile->store('products', 'public');
            $photoPath = explode('/', $photoPath)[1];
        }
        if ($request->file('video')) {
            $uploadedVideo = $request->file('video');
            $videoPath = $uploadedVideo->store('products', 'public');
            $videoPath = explode('/', $videoPath)[1];
         
        }
        // dd($photoPath);
        $product = DB::table('product')->where('id', request()->input('id'))->update(array(
            'name' => request()->input('name'),
            'description' => request()->input('description'),
            'quantity' => request()->input('quantity'),
            'price' => request()->input('price'),
            'category_id' => request()->input('category_id'),
            'weight' => request()->input('weight'),
            'dimensions' => request()->input('dimensions'),
            'image_name' =>  $request->file('image') ? $photoPath :  $request->input('image'),
            'video_name' => $request->file('video') ? $videoPath : "",
            'owner_id' => request()->input('owner_id'),
        ));

        if ($product) {
            $product = DB::table('product')->find(request()->input('id'));
            return response()->json($product);
        } else {
            return (['product' => 'error']);
        }

    }
    public function add_product(Request $request)
    {
        if ($request->file('image')) {
            $uploadedFile = $request->file('image');
            $photoPath = $uploadedFile->store('products', 'public');
            $photoPath = explode('/', $photoPath)[1];
        }
        if ($request->file('video')) {
            $uploadedVideo = $request->file('video');
            $videoPath = $uploadedVideo->store('products', 'public');
            $videoPath = explode('/', $videoPath)[1];
        }

        $product = DB::table('product')->insert(array(
            'name' => request()->input('name'),
            'description' => request()->input('description'),
            'quantity' => request()->input('quantity'),
            'price' => request()->input('price'),
            'image_name' => $request->file('image') ? $photoPath : "",
            'video_name' => $request->file('video') ? $videoPath : "",
            'category_id' => request()->input('category_id'),
            'weight' => request()->input('weight'),
            'dimensions' => request()->input('dimensions'),
            'owner_id' => request()->input('owner_id'),
        ));
        // dd($product);
        if ($product) {
            $product = DB::table('product')->orderBy('id', 'desc')->first();
            $product->category_payload = DB::select('select * from category where id=?', [$product->category_id])[0];
            return response()->json($product);
        } else {
            return (['product' => 'error']);
        }

    }
    public function delete_product(Request $request)
    {
        // dd(request()->input('id'));
        $product = DB::table('product')->where('id', request()->input('id'))->delete();
        if ($product) {
            return response()->json($product);
        } else {
            return (['product' => 'error']);
        }

    }
}
