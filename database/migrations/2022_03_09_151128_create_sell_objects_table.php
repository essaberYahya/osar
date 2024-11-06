<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_objects', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("description");
            $table->text("htmlPart");
            $table->text("pictureCover");
            $table->integer("category_id")->unsigned();
            $table->date("startAt");
            $table->date("EndDate");
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
        Schema::dropIfExists('sell_objects');
    }
}
