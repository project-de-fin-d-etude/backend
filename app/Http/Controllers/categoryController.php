<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class categoryController extends Controller
{
    public function index(){
        $categories = DB::select('select * from category');
        // echo $categories;
        return (['categories'=>$categories]);
        }
}
// the mysql query is INSERT INTO `product` (`id`, `title`, `description`, `price`, `category_id`, `image_name`) VALUES (NULL, 'Orange Amaryllis\r\n', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.\r\n\r\n', '145', '1', 'ddddddddddddddd');
