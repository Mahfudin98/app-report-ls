<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOngkirToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('prov_id')->nullable()->after('waybill');
            $table->string('city_id')->nullable()->after('prov_id');
            $table->string('district_id')->nullable()->after('city_id');
            $table->integer('ongkir')->after('image');
            $table->boolean('metode')->default(0)->comment('0: transfer, 1: COD')->after('ongkir');
            $table->integer('biaya')->nullable()->after('metode');
            $table->integer('total')->after('biaya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('district_id');
            $table->dropColumn('ongkir');
            $table->dropColumn('metode');
            $table->dropColumn('biaya');
            $table->dropColumn('total');
        });
    }
}
