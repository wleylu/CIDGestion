<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_comptes', function (Blueprint $table) {
            $table->id();
            $table->string('compte',12)->unique();
            $table->string('codbnq',5)->nullable()->default(null);
            $table->string('codeguichet',5)->nullable()->default(null);
            $table->string('rib',2)->nullable()->default(null);
            $table->string('banque',30)->nullable()->default(null);
            $table->string('loginAdd',50)->nullable()->default(null);
            $table->string('loginUpd',50)->nullable()->default(null);
            $table->timestamps();
            $table->foreignId('cid_client_id')->constrained();
        });
    }



    public function down()
    {
        Schema::dropIfExists('cid_comptes');
    }
}
