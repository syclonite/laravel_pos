<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.products.index',compact('products'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::get();
        return view('backend.products.create',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product([
            'product_name' => $request->get('product_name'),
            'product_description' => $request->get('product_des'),
            'status' => $request->get('status'),
            'subcategory_id' => $request->get('subcategory_id'),
        ]);
        $product->save();
        return redirect()->route('products.index')->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::get();
        return view('backend.products.edit',compact('product','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->product_name = $request->get('product_name');
        $product->product_description = $request->get('product_des');
        $product->status = $request->get('status');
        $product->subcategory_id = $request->get('subcategory_id');
        $product->save();
        return redirect()->route('products.index')->with('success','Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete(); // Easy right?

        return redirect()->route('products.index')->with('success','Product Deleted.');
    }

    public function restore($id)
    {
        Product::where('id', $id)->withTrashed()->restore();

        return redirect()->route('products.index')->with('Product restored successfully.');
    }

    public function forceDelete($id)
    {
        Product::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('products.index')->with('Product force deleted successfully.');
    }
}
