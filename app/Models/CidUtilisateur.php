<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidUtilisateur extends Model
{
    use HasFactory;

    public function cid_role(){
        return $this->hasOne(CidRole::class);
    }

    public function cid_operations(){
        return $this->hasMany(CidOperation::class);
    }

    public function cid_compte_clis(){
        return $this->hasMany(CidCompteCli::class);
    }
}
