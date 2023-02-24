<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeStockCounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_counts', function (Blueprint $table) {
            $table->bigInteger('total_quantity',)->nullable()->change();
            $table->bigInteger('currently_product_selling_price',)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_counts', function (Blueprint $table) {
            //
        });
    }
}
