<?php

namespace App\Models;

use App\Models\CidOperation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidProduit extends Model
{
    use HasFactory;

    protected $fillable=[
        'codeProd','produit','taux','cid_commission_id','commission','cid_periode_id','loginAdd','loginUpd'
    ];




    public function cid_commission(){
        return $this->belongsTo(CidCommission::class);
    }

     public function cid_periode(){
        return $this->belongsTo(CidPeriode::class);
    } 

    public function cid_clients()
    {
        return $this->belongsToMany(CidClient::class);
    }

    public function cid_operations(){
        return $this->hasMany(CidOperation::class);
    }




}
