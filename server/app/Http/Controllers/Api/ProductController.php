<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\SaveImageService;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $status   = $products->count() ? true : false;

        return response()->json([
            'data'   => $products,
            'status' => $status,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $attributes = ['front_image', 'back_image', 'left_image', 'right_image'];

        $product = Product::create(array_merge(
            $request->validated(),
            ['slug' => Str::slug($request->validated()['product_name'])],
            (new SaveImageService)
                ->saveImage($request, $attributes,
                    $request->validated()['sku'], 'images/products/')
                ->get()
        ));

        $status = $product ? true : false;

        return response()->json([
            'data'    => $product,
            'status'  => $status,
            'message' => 'Product Added Successfully.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $attributes = ['front_image', 'back_image', 'left_image', 'right_image'];

        $status = $product->update(array_merge(
            $request->validated(),
            ['slug' => Str::slug($request->validated()['product_name'])],
            (new SaveImageService)
                ->saveImage($request, $attributes, $request->validated()['sku'], 'images/products/')
                ->get()
        ));

        $status = $product ? true : false;

        return response()->json([
            'status'  => $status,
            'message' => 'Product Updated Successfully.',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getproductsbyid($id)
    {
        //dd($id);
        $products = DB::table('products')
         ->select('products.*', 'products.id AS pid','products.product_name')
        ->where('category_id', '=', $id)
        ->get();
        $status   = $products->count() ? true : false;

        return response()->json([
            'data'   => $products,
            'status' => $status,
        ], 201);
    }
}
