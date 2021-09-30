<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTypeToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('type_pembelian')->comment('0: ecer, 1: paket komplit, 2: paket hemat')->after('stock');
            $table->boolean('type_product')->comment('0: BPOM, 1: farma')->after('type_pembelian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type_pembelian');
            $table->dropColumn('type_product');
        });
    }
}
