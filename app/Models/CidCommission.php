<?php

namespace App\Models;

use App\Models\CidPeriode;
use App\Models\CidComptable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidCommission extends Model
{
    use HasFactory;


    protected $fillable=[
        'codetype','taux','libelle','mnt','periode','loginAdd','loginUpd','cid_periode_id','compte',
    ];


    public function cid_produits(){
        return $this->hasMany(CidProduit::class);
    }

    public function cid_comptables(){
        return $this->hasMany(CidComptable::class);
    }

    public function cid_periode(){
        return $this->belongsTo(CidPeriode::class);
    }
}
