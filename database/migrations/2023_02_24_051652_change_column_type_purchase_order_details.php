<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypePurchaseOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->bigInteger('purchase_amount',)->nullable()->change();
            $table->bigInteger('selling_amount',)->nullable()->change();
            $table->bigInteger('quantity',)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            //
        });
    }
}
