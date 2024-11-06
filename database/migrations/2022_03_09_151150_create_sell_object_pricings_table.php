<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellObjectPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_object_pricings', function (Blueprint $table) {
            $table->id();
            $table->integer("object_id");
            $table->float("price");
            $table->text("description");
            $table->text("htmlPart");
            $table->text("name");
            $table->text("icon");
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
        Schema::dropIfExists('sell_object_pricings');
    }
}
