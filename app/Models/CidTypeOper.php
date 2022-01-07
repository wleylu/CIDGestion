<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidTypeOper extends Model
{
    use HasFactory;

    protected $fillable = [
            'oper',
            'libelle',
            'acteur',
            'compteOper',
            'compteCom',
            'mntCom',
            'taux',
            'description',
            'loginAdd',
            'loginUpd',
            'cid_commission_id',
    ];
}
