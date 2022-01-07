<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_roles', function (Blueprint $table) {
            $table->id();
            $table->string('libelle',25)->nullable()->default(null);
            $table->timestamps();
        });
    }

    

    public function down()
    {
        Schema::dropIfExists('cid_roles');
    }
}
