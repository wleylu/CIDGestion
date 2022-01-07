<?php

use App\Models\CidCodeOper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidComptablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_comptables', function (Blueprint $table) {
            $table->id();
            $table->string('oper',5)->nullable()->default(null);
            $table->string('sens',1)->nullable()->default(null);
            $table->string('variable',20)->nullable()->default(null);
            $table->string('libelle',100)->nullable()->default(null);
            $table->string('varmnt')->nullable()->default(null);
            $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();

            $table->foreignId('cid_code_oper_id')->constrained()->nullable()->default(0);


        });
    }



    public function down()
    {
        Schema::dropIfExists('cid_comptables');
    }
}
