<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidCompte extends Model
{
    use HasFactory;

    protected $fillable = [
             'compte',
            'codbnq',
            'codeguichet',
            'rib',
            'loginAdd',
            'loginUpd',
            'banque',
            'cid_client_id',
    ];

    public function cid_client()
    {
        return $this->belongsTo(CidClient::class);
    }
}
