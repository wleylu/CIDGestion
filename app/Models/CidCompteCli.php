<?php

namespace App\Models;

use App\Models\User;
use App\Models\CidType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidCompteCli extends Model
{
    use HasFactory;

    protected $fillable=[
        'compte','agence','client','nom','rubrique','cid_client_id','user_id','cid_type_id','solde'
    ];

    public function cid_client(){
        return $this->belongsTo(CidClient::class);
    }

    public function cid_operations(){
        return $this->hasMany(CidOperation::class);
    }

    public function cid_utilisateur(){
      return $this->belongsTo(CidUtilisateur::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cid_type(){
        return $this->belongsTo(CidType::class);
    }


}
