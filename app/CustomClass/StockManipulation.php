<?php

namespace App\CustomClass;

use App\Models\SaleOrderDetail;
use App\Models\Stock;
use App\Models\StockCount;
use Illuminate\Support\Facades\Mail;

class StockManipulation
{
   public function add_stock($request){
//      dd(PurchaseOrderDetail::where('product_id',2)->sum('quantity'));
        Stock::create($request);

    }

   public function update_stock($request){
        Stock::create($request);
    }

   public function reduce_stock($request){
       $quantity_array = [];
       foreach ($request as $params){
//        dd($params['product_id']);
           $stocks_quantity = Stock::where([
               ['product_id',$params['product_id']],
               ['unit_id',$params['unit_id']],
           ])->where('quantity','!=',0.0)->pluck('quantity')->toArray();

           $stocks_id = Stock::where([
               ['product_id',$params['product_id']],
               ['unit_id',$params['unit_id']],
           ])->where('quantity','!=',0.0)->pluck('id')->toArray();
//           dd($stocks_id,$stocks_quantity);
           $quantity = $params['quantity'];
           $temp_sum = 0;
           $t = $quantity;
          foreach ($stocks_quantity as $key => $stock_quantity){
               if ($t > $temp_sum){
                   $temp_sum = $temp_sum + $stock_quantity;
                   $result = $temp_sum - $t;
                   if ($result < 0){
                       $result = 0;
                   }elseif ($result > 0 || $result == 0){
                       $result = $temp_sum - $t;
                   }
                   $quantity_array[] = $result;
               }
          }
       }
//       dd($quantity_array);
       $collection = collect($stocks_id);
       $zipped = $collection->zip($quantity_array);
//       dd($zipped);
       $null_filtered_data = collect($zipped)->reject(function($element) {
           return $element[1] === null;
       });
       $null_filtered_data->map(function($data) {
           $id = $data[0];
           $quantity = $data[1];
           Stock::where('id',$id)->update([
               'quantity' => $quantity
           ]);
       });
   }

   public function restore_stock($sale_order_id){
        $quantity_array = [];
        $sale_order_details = SaleOrderDetail::where('sale_order_id', $sale_order_id)->get();
        foreach ($sale_order_details as $sale_order_detail){
            $quantity_reduced = SaleOrderDetail::where([['sale_order_id', $sale_order_detail['sale_order_id']],['product_id', $sale_order_detail['product_id']],['unit_id', $sale_order_detail['unit_id']]])->pluck('quantity');
            $stocks_quantity = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']],])->orderBy('updated_at','DESC')->pluck('quantity')->toArray();
            $stocks_id = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->orderBy('updated_at','DESC')->pluck('id')->toArray();
            foreach ($quantity_reduced as $value){
                $temp_sum = 0;
                $t = $value;
                foreach ($stocks_quantity as $key => $stock_quantity){
                    if ($t > $temp_sum){
                        $temp_sum = $temp_sum + $stock_quantity;
                        $result = $temp_sum + $t;
                        if ($t > $result){
                            $result = $temp_sum - $t;
                        }elseif ($t == $result ){
                            $temp_sum = $t ;
                            $result = $temp_sum - $stock_quantity;
                        }elseif($t < $result){
                            $temp_sum = $t ;
                            $result = $temp_sum + $stock_quantity;
//                            dd($result);
                        }
                        $quantity_array[] = $result;
                    }
                }
//                dd($quantity_array);
                $collection = collect($stocks_id);
                $zipped = $collection->zip($quantity_array);
                $null_filtered_data = collect($zipped)->reject(function($element) {
                    return $element[1] === null;
                });
                $null_filtered_data->map(function($data) {
                    $id = $data[0];
                    $quantity = $data[1];
                    Stock::where('id',$id)->update([
                        'quantity' => $quantity
                    ]);
                });

            }
            $total_quantity = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->sum('quantity');
            //           $data = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->get();
            StockCount::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                'total_quantity' => $total_quantity,
            ]);

        }


    }

   public function add_update_total_stock($request){
       $purchase_stocks = $request['purchase_order_details'];
//       dd($purchase_stocks);
       foreach ($purchase_stocks as $purchase_stock){
          $product_id = $purchase_stock['product_id'];
          $unit_id = $purchase_stock['unit_id'];
          $selling_price = $purchase_stock['selling_price'];
          $total_quantity = Stock::where([['product_id',$product_id],['unit_id',$unit_id]])->sum('quantity');
          $data = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->get();
          if ($data->isEmpty()){
//              dd("empty");
              StockCount::create([
                 'product_id'=> $product_id,
                 'unit_id' => $unit_id,
                 'user_id' => '2',
                 'total_quantity' => $total_quantity,
                 'status' => '1',
                 'currently_product_selling_price' => $selling_price,
              ]);

          }elseif ($data->isNotEmpty()){
//              dd("not Empty");
             StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
                 'total_quantity' => $total_quantity,
                 'currently_product_selling_price' => $selling_price,
             ]);
          }
       }

   }

   public function reduce_total_stock($request){
       $sale_stocks = $request['sale_order_details'];
       foreach ($sale_stocks as $sale_stock){
           $product_id = $sale_stock['product_id'];
           $unit_id = $sale_stock['unit_id'];
           $total_quantity = Stock::where([['product_id',$product_id],['unit_id',$unit_id]])->sum('quantity');
//           dd($total_quantity);
//           $data = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->get();
           StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
               'total_quantity' => $total_quantity,
           ]);

       }
       $low_stock_count = StockCount::where('total_quantity','<=', 799)->join('products', 'products.id', '=', 'stock_counts.product_id')
           ->join('units', 'units.id', '=', 'stock_counts.unit_id')
           ->get(['products.product_name', 'units.unit_name', 'stock_counts.total_quantity']);
       ;
        if ($low_stock_count->isNotEmpty()){
             Mail::send('mail.low_stock_mail',['data' => $low_stock_count] ,function($messages){
                $messages->to('admin@gmail.com');
                $messages->subject('Low Stock Product');
             });
        }
   }

   public function adjust_total_stock($data){
       foreach ($data as $value){
           $product_id = $value['product_id'];
           $unit_id = $value['unit_id'];
//           dd($product_id);
           $total_quantity = Stock::where([['product_id',$product_id],['unit_id',$unit_id]])->sum('quantity');
           StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
               'total_quantity' => $total_quantity,
           ]);

       }

   }

}
