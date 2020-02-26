<?php

use App\Commercial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Commercial::TABLE, function (Blueprint $table) {
            $table->bigIncrements(Commercial::ID);
            $table->string(Commercial::TITLE, 200);
            $table->string(Commercial::DESCRIPTION, 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Commercial::TABLE);
    }
}
