<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidType extends Model
{
    use HasFactory;

    protected $fillable=['code','libelle','loginAdd','loginUpd','classe'];

    public function cid_compte_clis(){
        return $this->hasMany(CidCompteCli::class);
    }
}
