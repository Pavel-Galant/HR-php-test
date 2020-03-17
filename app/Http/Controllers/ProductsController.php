<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    const PER_PAGE = 5;
    public function page($page)
    {
        $count = Product::count();  
        $pageCount = ceil($count/self::PER_PAGE);
        $index =  ($page < 1 || $page > $pageCount) ? 1  : (int)$page;
        $products = Product::with(['vendor'])->take(self::PER_PAGE)->skip(($index-1) * self::PER_PAGE)->orderBy('name')->get();
        return response()->json(['products' => $products, 'page_count' => $pageCount]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', (int)$id)->first();
       
        $request->validate([
            'price'  => 'required|integer'
        ]);
        //var_dump((int)$request->price); die();
        $product->price = $request->price;
        if (!$product->save()) return response('Не удалось сохранить данные!', 500)->json();
        return response()->json(['id' => $id]);
    }
}
