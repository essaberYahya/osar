<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowSecDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('row_sec_data', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("description");
            $table->text("picture");
            $table->text("htmlPart");
            $table->boolean("leftToRight")->default(0);
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
        Schema::dropIfExists('row_sec_data');
    }
}
