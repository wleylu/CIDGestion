<?php

use App\Models\CidClient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid_contrats', function (Blueprint $table) {
            $table->id();
            $table->string('client',10)->nullable()->default(null);
            $table->string('code',20)->nullable()->default(null);
            $table->date('datesign');
            $table->string('signataire',100);
            $table->string('signataire1',100);
            $table->string('signataire2',100);
            $table->string('signataire3',100);
            $table->mediumText('description');
            $table->string('loginAdd');
		    $table->string('loginUpd');            
            $table->timestamps();
            $table->foreignId('cid_client_id')->constrained()->defeult(0);

        });
    }

   
   
    public function down()
    {
        Schema::dropIfExists('cid_contrats');
    }
}
