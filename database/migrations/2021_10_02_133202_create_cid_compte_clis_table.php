<?php

use App\Models\CidClient;
use App\Models\CidOperation;
use App\Models\CidUtilisateur;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidCompteClisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_compte_clis', function (Blueprint $table) {
            $table->id();
            $table->string('compte',15)->unique()->nullable();
            $table->string('client',10)->nullable();
            $table->string('nom',150)->nullable();
            $table->string('rubrique',10)->nullable();
            $table->integer('solde')->default(0);
            $table->integer('soldeVeille')->default(0);
            $table->date('dateouv')->nullable();
            $table->date('dateSolde')->nullable();
            $table->date('dateVeille')->nullable();
            $table->string('agence',10)->nullable();
            $table->string('loginAdd')->nullable();
		    $table->string('loginUpd')->nullable();
            $table->integer('valide')->default(0);
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->defautt(0);
            $table->foreignId('cid_client_id')->constrained()->defautt(0);
            $table->foreignId('cid_type_id')->constrained()->defautt(0);


        });
    }



    public function down()
    {
        Schema::dropIfExists('cid_compte_clis');
    }
}
