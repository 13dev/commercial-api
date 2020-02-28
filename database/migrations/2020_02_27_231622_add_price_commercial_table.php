<?php

use App\Commercial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceCommercialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Commercial::TABLE, function(Blueprint $table) {
            $table->float(Commercial::PRICE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Commercial::TABLE, function(Blueprint $table) {
            $table->dropColumn(Commercial::PRICE);
        });
    }
}
