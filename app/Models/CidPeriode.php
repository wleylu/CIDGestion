<?php

namespace App\Models;

use App\Models\CidCommission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidPeriode extends Model
{
    use HasFactory;

    protected $fillable =['codeCom','libelle'];

    public function cid_commissions(){
        return $this->hasMany(CidCommission::class);
    }
    public function cid_produits(){
        return $this->hasMany(CidProduit::class);
    }




}
