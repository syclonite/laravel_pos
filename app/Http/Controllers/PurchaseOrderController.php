<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;
use App\Models\StockCount;
use App\Models\Suppliers;
use App\Models\Unit;
use App\CustomClass\StockManipulation;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at','DESC')->get();
        return view('backend.purchase.purchase_order_index',compact('purchaseOrders'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        $suppliers = Suppliers::orderBy('created_at','DESC')->get();
        $units = Unit::orderBy('created_at','DESC')->get();
        return view('backend.purchase.purchase_order_create',compact('products','suppliers','units'));
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
//        dd($request->all()['purchase_order_details']);
//        $test = $request['purchase_order']['billing_amount'];
        $purchase_order = new PurchaseOrder([
            'supplier_id' => $request['purchase_order']['supplier_id'],
            'user_id' => '4',
            'billing_amount' => $request['purchase_order']['billing_amount'],
            'paid_amount' => $request['purchase_order']['paid_amount'],
            'extra_charge' => $request['purchase_order']['extra_charge'],
            'discount' => $request['purchase_order']['discount'],
            'status' => $request['purchase_order']['status'],
        ]);
        $purchase_order->save();
        $purchase_order_details = $request['purchase_order_details'];
        $stocks = new StockManipulation();
        foreach ($purchase_order_details as $purchase_order_detail){
//            dd($purchase_order_detail['quantity']);
            PurchaseOrderDetail::create([
                'supplier_id' => $request['purchase_order']['supplier_id'],
                'user_id' => '4',
                'purchase_order_id' =>  $purchase_order->id,
                'product_id' => $purchase_order_detail['product_id'],
                'unit_id' => $purchase_order_detail['unit_id'],
                'quantity' => $purchase_order_detail['quantity'],
                'purchase_amount' => $purchase_order_detail['purchase_price'],
                'selling_amount' => $purchase_order_detail['selling_price'],
                'status' => '1',
                'discount' =>'0',
                'extra_charge' => '0'
            ]);
            $stocks->add_stock([
               'supplier_id' => $request['purchase_order']['supplier_id'],
               'purchase_order_id' => $purchase_order->id,
               'unit_id' => $purchase_order_detail['unit_id'],
               'product_id' => $purchase_order_detail['product_id'],
               'quantity' => $purchase_order_detail['quantity'],
               'purchase_amount' => $purchase_order_detail['purchase_price'],
               'selling_amount' => $purchase_order_detail['selling_price'],
           ]);
        }

        $stocks->add_update_total_stock($request);
//        return route('purchase.index')->with('success','Purchase successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $id)
    {
        $products = Product::all();
        $suppliers = Suppliers::all();
        $units = Unit::all();
        $purchase_order = PurchaseOrder::find($id)->first();
        $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order->id)->get();
        return view('backend.purchase.purchase_order_edit', compact('purchase_order','purchase_order_details','suppliers','products','units'))->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $purchase_order = PurchaseOrder::find($id);
        $purchase_order->supplier_id = $request['purchase_order']['supplier_id'];
        $purchase_order->user_id = '4';
        $purchase_order->billing_amount = $request['purchase_order']['billing_amount'];
        $purchase_order->paid_amount = $request['purchase_order']['paid_amount'];
        $purchase_order->extra_charge = $request['purchase_order']['extra_charge'];
        $purchase_order->discount = $request['purchase_order']['discount'];
        $purchase_order->status = '1';
        $purchase_order->save();
        $purchase_order_details = $request['purchase_order_details'];
        $stocks = new StockManipulation();
        $stocks->update_purchase_order_total_quantity($purchase_order_details,$id);
        PurchaseOrderDetail::where('purchase_order_id',$id)->delete();
        Stock::where('purchase_order_id',$id)->delete();
        foreach ($purchase_order_details as $purchase_order_detail) {
//            dd($purchase_order_detail['quantity']);
            PurchaseOrderDetail::create([
                'supplier_id' => $request['purchase_order']['supplier_id'],
                'user_id' => '4',
                'purchase_order_id' => $purchase_order->id,
                'product_id' => $purchase_order_detail['product_id'],
                'unit_id' => $purchase_order_detail['unit_id'],
                'quantity' => $purchase_order_detail['quantity'],
                'purchase_amount' => $purchase_order_detail['purchase_price'],
                'selling_amount' => $purchase_order_detail['selling_price'],
                'status' => '1',
                'discount' => '0',
                'extra_charge' => '0'
            ]);
            $stocks->update_stock([
                'supplier_id' => $request['purchase_order']['supplier_id'],
                'purchase_order_id' => $purchase_order->id,
                'unit_id' => $purchase_order_detail['unit_id'],
                'product_id' => $purchase_order_detail['product_id'],
                'quantity' => $purchase_order_detail['quantity'],
                'purchase_amount' => $purchase_order_detail['purchase_price'],
                'selling_amount' => $purchase_order_detail['selling_price'],
            ]);
        }
//        $stocks->add_update_total_stock($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase_order_id = PurchaseOrder::find($id);
//        dd($purchase_order_id->id);
        $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order_id->id)->get();
//      dd($purchase_order_details);
        foreach ($purchase_order_details as $purchase_order_detail){
//            dd($purchase_order_detail);
            $product_id = $purchase_order_detail->product_id;
            $unit_id = $purchase_order_detail->unit_id;
            $quantity = $purchase_order_detail->quantity;
            $stock_quantity = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->value('total_quantity');
            $subtraction = $stock_quantity - $quantity;
            StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
                'total_quantity' => $subtraction
            ]);
            Product::where([['id',$product_id],['unit_id',$unit_id]])->update([
                'quantity' => $subtraction
            ]);
        }
        $purchase_order_id->delete(); // Easy right?
//        $stocks = new StockManipulation();
//        $stocks->adjust_total_stock($data);

        return redirect()->route('purchase.index')->with('success','Purchase Order Deleted.');
    }

    public function get_supplier(Request $request)
    {
//        dd($request['id']);
        $supplier_data = Suppliers::where('id',$request['id'])->first();
        return json_encode(array('supplier_data'=>$supplier_data));
//        return response()->json(['customer_data'=>$customer_data]);

    }

    public function add_new_supplier(Request $request)
    {
//        dd($request->all());
        $add_supplier = new Suppliers([
            'supplier_name' => $request['suppliers']['supplier_name'],
            'phone_1' => $request['suppliers']['supplier_phone'],
            'address' => $request['suppliers']['supplier_address'],
            'status' => '1',
        ]);
        $add_supplier->save();
    }

    public function get_supplier_ajax(Request $request){
        if ($request == true){
            $supplier_data_ajax = Suppliers::orderBy('created_at','DESC')->get();
            return json_encode(array('supplier_data_ajax'=>$supplier_data_ajax));
        }

    }

    public function add_new_unit(Request $request){

        $add_unit = new Unit([
            'unit_name' => $request['units']['unit_name'],
            'unit_description' => $request['units']['unit_des'],
            'status' => '1',
        ]);
        $add_unit->save();
    }

    public function get_units_all_ajax(Request $request)
    {
        if ($request == true) {
            $units_data_ajax = Unit::orderBy('created_at', 'DESC')->get();
            return json_encode(array('units_data_ajax' => $units_data_ajax));
        }
    }


}
