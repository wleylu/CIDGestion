<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidQuartiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_quartiers', function (Blueprint $table) {
            $table->id();
            $table->string('libelle',100)->default(null);;
            $table->string('pays',100)->default(null);
            $table->string('ville',100)->default(null);;
            $table->mediumText('description')->default(null);;
            $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
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
        Schema::dropIfExists('cid_quartiers');
    }
}
