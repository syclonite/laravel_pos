<?php

namespace App\Http\Controllers;

use App\CustomClass\StockManipulation;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetail;
use App\Models\Unit;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_orders = SaleOrder::all();
        return view('backend.sale.sale_order_index',compact('sale_orders'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $units = Unit::all();
        $customers = Customer::all();
        $sale_order_bill_no = SaleOrder::pluck('id')->last();
        return view('backend.sale.sale_order_create',compact('products','units','customers','sale_order_bill_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $sale_order = new SaleOrder([
            'customer_id' => $request['sale_order']['customer_id'],
            'user_id' => '2',
            'billing_amount' => $request['sale_order']['billing_amount'],
            'paid_amount' => $request['sale_order']['paid_amount'],
            'extra_charge' => $request['sale_order']['extra_charge'],
            'discount' => $request['sale_order']['discount'],
            'status' => '1',
        ]);
        $sale_order->save();
        $sale_order_details = $request['sale_order_details'];
        foreach( $sale_order_details as $sale_order_detail){
//            dd($sale_order_detail);
            SaleOrderDetail::create([
                'customer_id' => $request['sale_order']['customer_id'],
                'user_id' => '2',
                'sale_order_id' => $sale_order->id,
                'product_id' => $sale_order_detail['product_id'],
                'unit_id' => $sale_order_detail['unit_id'],
                'quantity' => $sale_order_detail['quantity'],
                'product_selling_price' => $sale_order_detail['product_price'],
                'status' => '1',
                'discount' =>'0',
                'extra_charge' => '0'
            ]);
        }


        $stocks = new StockManipulation();
        $stocks->reduce_stock($sale_order_details);
        $stocks->reduce_total_stock($request);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $units = Unit::all();
        $customers = Customer::all();
        $sale_order = SaleOrder::find($id);
        $sale_order_details = SaleOrderDetail::get()->where('sale_order_id',$id);
        return view('backend.sale.sale_order_edit', compact('sale_order','sale_order_details','customers','products','units'))->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $sale_order = SaleOrder::find($id);
        $sale_order_id = SaleOrder::where('id',$id)->pluck('id');
        $sale_order->customer_id = $request['sale_order']['customer_id'];
        $sale_order->user_id = '2';
        $sale_order->billing_amount = $request['sale_order']['billing_amount'];
        $sale_order->paid_amount = $request['sale_order']['paid_amount'];
        $sale_order->extra_charge = $request['sale_order']['extra_charge'];
        $sale_order->discount = $request['sale_order']['discount'];
        $sale_order->status = '1';
        $sale_order->save();
        $sale_order_details = $request['sale_order_details'];
//        dd($sale_order_details);
        $stock = New StockManipulation();
        $stock-> restore_stock($sale_order_id);
        SaleOrderDetail::where('sale_order_id',$id)->delete();
        foreach ($sale_order_details as $sale_order_detail) {
//            dd($purchase_order_detail['quantity']);
            SaleOrderDetail::create([
                'customer_id' => $request['sale_order']['customer_id'],
                'user_id' => '2',
                'sale_order_id' => $sale_order->id,
                'product_id' => $sale_order_detail['product_id'],
                'unit_id' => $sale_order_detail['unit_id'],
                'quantity' => $sale_order_detail['quantity'],
                'product_selling_price' => $sale_order_detail['product_price'],
                'status' => '1',
                'discount' => '0',
                'extra_charge' => '0'
            ]);
        }
        $stocks = new StockManipulation();
        $stocks->reduce_stock($sale_order_details);
        $stocks->reduce_total_stock($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale_order_id = SaleOrder::where('id',$id)->pluck('id');
        $sale_order = SaleOrder::find($id);
        $stocks = new StockManipulation();
        $stocks->restore_stock($sale_order_id);
//        dd($sale_order);
        $sale_order->delete(); // Easy right?
        return redirect()->route('sales.index')->with('success','Order Deleted.');
    }

}
