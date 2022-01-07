<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidProduitClient extends Model
{
    use HasFactory;

    protected $fillable=[
        'cid_client_id','cid_produit_id','loginAdd','loginUpd',
    ];

    public function cid_clients(){
        return $this->hasMany(CidClient::class);
    }
}
