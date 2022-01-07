<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidProduitClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_produit_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cid_produit_id')->constrained();
            $table->foreignId('cid_client_id')->constrained();
            $table->string('loginAdd')->nullable();
            $table->string('loginUpd')->nullable();
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
        Schema::dropIfExists('cid_produit_clients');
    }
}
