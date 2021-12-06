<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldLeadToAdvReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adv_reports', function (Blueprint $table) {
            $table->integer('lead')->nullable()->after('user_id');
            $table->integer('dashboard')->nullable()->after('lead');
            $table->integer('omset')->nullable()->after('dashboard');
            $table->text('keterangan')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adv_reports', function (Blueprint $table) {
            $table->dropColumn('lead');
            $table->dropColumn('dashboard');
            $table->dropColumn('omset');
            $table->dropColumn('keterangan');
        });
    }
}
