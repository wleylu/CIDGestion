<?php

namespace App\Models;

use App\Models\CidCommission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidComptable extends Model
{
    use HasFactory;

    protected $fillable =[
        'oper','sens','variable','varmnt','libelle','loginAdd','loginUpd','cid_code_oper_id'
    ];

    public function cid_code_oper(){
        return $this->belongsTo(CidCodeOper::class);
    }

    public function cid_commissioin(){
        return $this->belongsTo(CidCommission::class);
    }
}
