<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $product_id = $request->input('product_id');
        if (!$product_id) {
            $products = $category_id ? DB::select('select * from product where category_id=?', [$category_id]) : DB::select('select * from product');
        }
        if (!$category_id) {
            $product_id ? $products = DB::select('select * from product where id=?', [$product_id]) : $products = DB::select('select * from product');
        }
        $products[0]->images = json_decode($products[0]->images, true);
        return (['products' => $products]);
    }
}
// the mysql query is INSERT INTO `product` (`id`, `title`, `description`, `price`, `category_id`, `image_name`) VALUES (NULL, 'Orange Amaryllis\r\n',
//  'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.\r\n\r\n', '145', '1', 'ddddddddddddddd');
