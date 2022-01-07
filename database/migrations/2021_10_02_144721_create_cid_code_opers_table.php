<?php

use App\Models\CidComptable;
use App\Models\CidOperation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidCodeOpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_code_opers', function (Blueprint $table) {
            $table->id();
            $table->string('oper',5)->unique();
            $table->string('libelle',100)->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->string('compteOper',12)->nullable()->default(null);
            $table->string('compteCom',12)->nullable()->default(null);
            $table->integer('taux')->nullable()->default(0);
            $table->integer('mntCom')->nullable()->default(0);
            $table->string('acteur',1)->nullable()->default(null);
            $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();

            $table->foreignId('cid_commission_id')->constrained()->default(0);
        });
    }


    public function down()
    {
        Schema::dropIfExists('cid_code_opers');
    }
}
