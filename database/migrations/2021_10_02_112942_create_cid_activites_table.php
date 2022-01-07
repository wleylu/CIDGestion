<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_activites', function (Blueprint $table) {
            $table->id();
            $table->string('libelle',100)->unique();
            $table->string('code',5)->unique()->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->string('loginAdd')->nullable()->default(null);
	    	$table->string('loginUpd')->nullable()->default(null);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('cid_activites');
    }
}
