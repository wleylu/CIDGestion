<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_produits', function (Blueprint $table) {
            $table->id();
            $table->string('codeProd',10)->unique();
            $table->string('produit',30)->nullable()->default(null);
            $table->float('taux',3,2)->nullable()->default(0);
            $table->float('commission',5,2)->nullable()->default(0);
             $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();

            $table->foreignId('cid_commission_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_periode_id')->constrained()->default(0);

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */


    public function down()
    {
        Schema::dropIfExists('cid_produits');
    }
}
