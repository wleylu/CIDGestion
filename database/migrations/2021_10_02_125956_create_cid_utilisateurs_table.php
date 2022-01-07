<?php

use App\Models\CidCompteCli;
use App\Models\CidOperation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nomPrenoms',150)->nullable()->default(null);
            $table->string('tel',40)->nullable()->default(null);
            $table->string('adresse',150)->nullable()->default(null);
            $table->string('email',100)->nullable()->default(null);
            $table->string('password1',255)->nullable()->default(null);
            $table->string('password2',255)->nullable()->default(null);
            $table->string('password3',255)->nullable()->default(null);
            $table->timestamps();
            $table->string('loginAdd')->nullable()->default(null);
		    $table->string('loginUpd')->nullable()->default(null);
            $table->foreignId('cid_role_id')->constrained();
        });
    }

   

    public function down()
    {
        Schema::dropIfExists('cid_utilisateurs');
    }
}
