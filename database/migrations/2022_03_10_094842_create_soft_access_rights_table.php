<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftAccessRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soft_access_rights', function (Blueprint $table) {
            $table->id();
            $table->integer("softLicenceId");
            $table->boolean("write");
            $table->boolean("editText");
            $table->boolean("delete");
            $table->boolean("editPicture");
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
        Schema::dropIfExists('soft_access_rights');
    }
}
