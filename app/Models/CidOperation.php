<?php

namespace App\Models;

use App\Models\CidProduit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidOperation extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'sens','montant','dateTransact','dateValeur','solde','refer','oper',
        'libelle','description','pieceId','dateEtabl','dateExpire','compte',
        'loginAdd','loginUpd','compte','cid_utilisateur_id','cid_compte_cli_id','cid_code_oper_id'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function cid_compte_cli(){
        return $this->belongsTo(CidCompteCli::class);
    }

    public function cid_code_oper(){
        return $this->belongsTo(CidCodeOper::class);
    }


}
