<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_operations', function (Blueprint $table) {
            $table->id();
            $table->string('sens',1)->nullable()->default(null);
            $table->integer('montant')->nullable()->default(0);
            $table->string('compte',10)->nullable()->default(null);
            $table->date('dateTransact')->nullable()->default(null);
            $table->date('dateValeur')->nullable()->default(null);
            $table->integer('soldeavt')->nullable()->default(0);
            $table->integer('solde')->nullable()->default(0);
            $table->string('refer',20)->nullable()->default(null);
            $table->string('oper',5)->nullable()->default(null);
            $table->string('libelle',100)->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->string('pieceId',50)->nullable()->default(null);
            $table->date('dateEtabl')->nullable()->default(null);
            $table->date('dateExpire')->nullable()->default(null);
            $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();


            $table->foreignId('cid_utilisateur_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_compte_cli_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_code_oper_id')->constrained()->nullable()->default(0);

        });
    }



    public function down()
    {
        Schema::dropIfExists('cid_operations');
    }
}
