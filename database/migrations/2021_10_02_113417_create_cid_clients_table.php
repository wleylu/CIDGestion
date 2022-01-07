<?php


use App\Models\CidContrat;
use App\Models\CidProduit;
use App\Models\CidCompteCli;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_clients', function (Blueprint $table) {
            $table->id();
            $table->string('client',10)->unique();
            $table->string('nom',100)->nullable();
            $table->string('prenom',150)->nullable();
            $table->string('email',200)->nullable();
            $table->string('pere',200)->nullable();
            $table->string('mere',200)->nullable();
            $table->string('adresse',200)->nullable();
            $table->string('numpiece',40)->nullable();
            $table->string('tel',40)->nullable();
            $table->mediumText('adrgeo')->nullable();
            $table->string('adrpost')->nullable();
            $table->mediumText('photo')->nullable();
            $table->mediumText('sign')->nullable();
            $table->date('dateouv')->nullable();
            $table->date('dateferme')->nullable();
            $table->date('datesign')->nullable();
            $table->date('datenaiss')->nullable();
            $table->string('action',1)->default('A');
            $table->integer('solde')->default(0);
            $table->integer('soldeVeille')->default(0);
            $table->string('loginAdd')->nullable();
            $table->string('loginUpd')->nullable();
            $table->string('typeClient',20)->nullable()->default(null);
            $table->integer('valide')->default(0);
            $table->timestamps();

            $table->foreignId('cid_quartier_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_activite_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_situation_id')->constrained()->nullable()->default(0);
            $table->foreignId('cid_nature_piece_id')->constrained()->nullable()->default(0);
            $table->foreignId('user_id')->constrained()->nullable()->default(0);

        });
    }



    public function down()
    {
        Schema::dropIfExists('cid_clients');
    }
}
