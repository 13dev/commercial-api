<?php

use App\Commercial;
use App\Photo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Photo::TABLE, function (Blueprint $table) {
            $table->bigIncrements(Photo::ID);
            $table->unsignedBigInteger(Photo::COMMERCIAL_ID);
            $table->string(Photo::CONTENT, 1000);
            $table->timestamps();

            $table->foreign(Photo::COMMERCIAL_ID)
                ->references(Commercial::ID)
                ->on(Commercial::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Photo::TABLE);
    }
}
