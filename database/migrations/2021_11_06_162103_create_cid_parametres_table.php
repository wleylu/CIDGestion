<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidParametresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_parametres', function (Blueprint $table) {
            $table->id();
            $table->date('encours')->nullable();
            $table->date('datoper')->nullable();
            $table->integer('refer1')->nullable()->default(0);
            $table->string('refer2',20)->nullable()->default(null);
            $table->string('refer',20)->nullable()->default(null);
            $table->string('prefixe',20)->nullable()->default(null);
            $table->string('oper',10)->nullable()->default(null);
            $table->integer('tailles')->dafault(0);
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
        Schema::dropIfExists('cid_parametres');
    }
}
