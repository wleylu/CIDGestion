<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidCodeOper extends Model
{
    use HasFactory;

    protected $fillable=['oper','libelle','description','taux','loginAdd','loginUpd',
        'compteOper','compteCom','mntCom','acteur','cid_commission_id'];

    public function cid_comptables(){
        return $this->hasMany(CidComptable::class);
    }

    public function cid_operations(){
        return $this->hasMany(CidOperation::class);
    }

    public function cid_commission(){
        return $this->belongsTo(CidCommission::class);
    }

}
