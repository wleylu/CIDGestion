<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_commissions', function (Blueprint $table) {
            $table->id();
            $table->float('taux',3,2)->nullable()->default(0);
            $table->string('libelle',100)->nullable()->default(null);
            $table->float('mnt',5,2)->nullable()->default(0);
            $table->string('codetype',10)->nullable()->default(null);
            $table->string('compte',12)->nullable()->default(null);
            $table->string('loginAdd')->nullable()->default(null);
            $table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();
            $table->foreignId('cid_periode_id')->constrained()->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */


    public function down()
    {
        Schema::dropIfExists('cid_commissions');
    }
}
