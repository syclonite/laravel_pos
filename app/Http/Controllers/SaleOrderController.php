<?php

namespace App\Http\Controllers;

use App\CustomClass\StockManipulation;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetail;
use App\Models\Stock;
use App\Models\StockCount;
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
        $sale_orders = SaleOrder::orderBy('created_at', 'DESC')->get();
        return view('backend.sale.sale_order_index', compact('sale_orders'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $units = Unit::get();
        $customers = Customer::where('name', 'Walking Customer')->get();
        $customers_due = Customer::where('name', '!=', 'Walking Customer')->get();
        $sale_order_bill_no = SaleOrder::pluck('id')->last();
//        $customers_due_ajax = Customer::where('name','!=','Walking Customer')->get();
//        return json_encode(array('customer_data'=>$customers_due_ajax));
        return view('backend.sale.sale_order_create', compact('products', 'units', 'customers', 'sale_order_bill_no', 'customers_due'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $sale_order = new SaleOrder([
            'customer_id' => $request['sale_order']['customer_id'],
            'user_id' => '4',
            'billing_amount' => $request['sale_order']['billing_amount'],
            'paid_amount' => $request['sale_order']['paid_amount'],
            'extra_charge' => $request['sale_order']['extra_charge'],
            'discount' => $request['sale_order']['discount'],
            'status' => $request['sale_order']['status'],
        ]);
        $sale_order->save();
        $sale_order_details = $request['sale_order_details'];
        foreach ($sale_order_details as $sale_order_detail) {
//            dd($sale_order_detail);
            SaleOrderDetail::create([
                'customer_id' => $request['sale_order']['customer_id'],
                'user_id' => '4',
                'sale_order_id' => $sale_order->id,
                'product_id' => $sale_order_detail['product_id'],
                'unit_id' => $sale_order_detail['unit_id'],
                'quantity' => $sale_order_detail['quantity'],
                'product_selling_price' => $sale_order_detail['product_price'],
                'status' => $request['sale_order']['status'],
                'discount' => '0',
                'extra_charge' => '0'
            ]);
            $current_stock = Stock::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->get();
            if ($current_stock->isEmpty()) {
                $stock_count_quantity = StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('total_quantity');
                $sale_order_quantity = $sale_order_detail['quantity'];
                $total_quantity = $stock_count_quantity - $sale_order_quantity;
                StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                    'total_quantity'=>$total_quantity
                ]);
                Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                    'quantity'=>$total_quantity
                ]);

            } else {
                $stocks = new StockManipulation();
                $stocks->reduce_stock($sale_order_details);
                $stocks->reduce_total_stock($request);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $units = Unit::all();
        $customers = Customer::all();
        $sale_order = SaleOrder::find($id);
        $sale_order_details = SaleOrderDetail::get()->where('sale_order_id', $id);
        return view('backend.sale.sale_order_edit', compact('sale_order', 'sale_order_details', 'customers', 'products', 'units'))->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $sale_order = SaleOrder::find($id);
        $sale_order_id = SaleOrder::where('id', $id)->pluck('id');
        $sale_order->customer_id = $request['sale_order']['customer_id'];
        $sale_order->user_id = '4';
        $sale_order->billing_amount = $request['sale_order']['billing_amount'];
        $sale_order->paid_amount = $request['sale_order']['paid_amount'];
        $sale_order->extra_charge = $request['sale_order']['extra_charge'];
        $sale_order->discount = $request['sale_order']['discount'];
        $sale_order->status = '1';
        $sale_order->save();
        $sale_order_details = $request['sale_order_details'];

        foreach ($sale_order_details as $sale_order_detail) {
            $current_stock = Stock::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->get();
            if ($current_stock->isEmpty()) {
                $stock_count_quantity = StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('total_quantity');
                $sale_order_detail_quantity = SaleOrderDetail::where([['sale_order_id',$id],['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('quantity');
                $quantity_parameters = $sale_order_detail['quantity'];

                if ($sale_order_detail_quantity > $quantity_parameters){
                    $calculate_quantity = $stock_count_quantity + $quantity_parameters;
                    StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                    'total_quantity'=>$calculate_quantity
                ]);
                 Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                    'quantity'=>$calculate_quantity
                ]);

//            dd($purchase_order_detail['quantity']);
                    SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                        'customer_id' => $request['sale_order']['customer_id'],
                        'user_id' => '4',
                        'sale_order_id' => $sale_order->id,
                        'product_id' => $sale_order_detail['product_id'],
                        'unit_id' => $sale_order_detail['unit_id'],
                        'quantity' => $sale_order_detail['quantity'],
                        'product_selling_price' => $sale_order_detail['product_price'],
                        'status' => '1',
                        'discount' => '0',
                        'extra_charge' => '0'
                    ]);

                }elseif ($stock_count_quantity == $sale_order_detail_quantity){

                    StockCount::where([['product_id', $sale_order_detail['product_id']],['unit_id', $sale_order_detail['unit_id']]])->update([
                        'total_quantity'=>$sale_order_detail_quantity
                    ]);

                    Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                        'quantity'=>$sale_order_detail_quantity
                    ]);


//            dd($purchase_order_detail['quantity']);
                    SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                        'customer_id' => $request['sale_order']['customer_id'],
                        'user_id' => '4',
                        'sale_order_id' => $sale_order->id,
                        'product_id' => $sale_order_detail['product_id'],
                        'unit_id' => $sale_order_detail['unit_id'],
                        'quantity' => $sale_order_detail['quantity'],
                        'product_selling_price' => $sale_order_detail['product_price'],
                        'status' => '1',
                        'discount' => '0',
                        'extra_charge' => '0'
                    ]);

                }elseif ($sale_order_detail_quantity < $quantity_parameters){
                    $result = $quantity_parameters - $sale_order_detail_quantity;
                    $quantity_result = $stock_count_quantity - $result;

                    StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                        'total_quantity'=>$quantity_result
                    ]);

                    Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                        'quantity'=>$quantity_result
                    ]);

//            dd($purchase_order_detail['quantity']);
                    SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                        'customer_id' => $request['sale_order']['customer_id'],
                        'user_id' => '4',
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

            }else{

            $stock = new StockManipulation();
            $stock->restore_stock($sale_order_id);
            SaleOrderDetail::where('sale_order_id', $id)->delete();
//            dd($purchase_order_detail['quantity']);
            SaleOrderDetail::create([
                'customer_id' => $request['sale_order']['customer_id'],
                'user_id' => '4',
                'sale_order_id' => $sale_order->id,
                'product_id' => $sale_order_detail['product_id'],
                'unit_id' => $sale_order_detail['unit_id'],
                'quantity' => $sale_order_detail['quantity'],
                'product_selling_price' => $sale_order_detail['product_price'],
                'status' => '1',
                'discount' => '0',
                'extra_charge' => '0'
            ]);
            $stocks = new StockManipulation();
            $stocks->reduce_stock($sale_order_details);
            $stocks->reduce_total_stock($request);
          }

        }

//        $stock = new StockManipulation();
//        $stock->restore_stock($sale_order_id);
//        SaleOrderDetail::where('sale_order_id', $id)->delete();
//        foreach ($sale_order_details as $sale_order_detail) {
////            dd($purchase_order_detail['quantity']);
//            SaleOrderDetail::create([
//                'customer_id' => $request['sale_order']['customer_id'],
//                'user_id' => '2',
//                'sale_order_id' => $sale_order->id,
//                'product_id' => $sale_order_detail['product_id'],
//                'unit_id' => $sale_order_detail['unit_id'],
//                'quantity' => $sale_order_detail['quantity'],
//                'product_selling_price' => $sale_order_detail['product_price'],
//                'status' => '1',
//                'discount' => '0',
//                'extra_charge' => '0'
//            ]);
//        }
//        $stocks = new StockManipulation();
//        $stocks->reduce_stock($sale_order_details);
//        $stocks->reduce_total_stock($request);
    }
//        dd($sale_order_details);

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

    /**
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function get_customer(Request $request)
    {
//        dd($request['id']);
        $customer_data = Customer::where('id',$request['id'])->first();
        return json_encode(array('customer_data'=>$customer_data));
//        return response()->json(['customer_data'=>$customer_data]);

    }

    public function add_new_customer(Request $request)
    {
//        dd($request['customers']);
        $add_customer = new Customer([
            'name' => $request['customers']['name'],
            'phone' => $request['customers']['phone'],
            'address' => $request['customers']['address'],
            'status' => '1',
        ]);
        $add_customer->save();
    }

    public function get_customer_ajax(Request $request){
        if ($request == true){
            $customer_data_ajax = Customer::where('name','!=','Walking Customer')->get();
            return json_encode(array('customer_data_ajax'=>$customer_data_ajax));
        }

    }

    public function available_stock_price_ajax(Request $request){
//        dd($request->all());
        if ($request == true){
            $product_id = $request['product_id'];
            $unit_id = $request['unit_id'];
            $available_stock_ajax = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('quantity');
            $available_product_price_ajax = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('selling_price');
            return json_encode(array('available_stock_ajax'=>$available_stock_ajax,'product_price'=>$available_product_price_ajax));
        }
    }

    public function print_sale_invoice($id){

        $sale_order = SaleOrder::find($id);
        $customers = Customer::find($sale_order->customer_id);
        $sale_order_details = SaleOrderDetail::where('sale_order_id',$sale_order->id)->get();
//        $product_price = SaleOrderDetail::where('sale_order_id',$sale_order->id)->value('product_price');
//        $quantity = SaleOrderDetail::where('sale_order_id',$sale_order->id)->value('quantity');
//        $result = $product_price * $quantity;
//        dd($voucher_details);
        return view('backend.sale.print_sale_invoice',compact('sale_order','customers','sale_order_details'));

    }




}
