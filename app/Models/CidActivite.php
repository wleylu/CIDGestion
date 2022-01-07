<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidActivite extends Model
{
    use HasFactory;

    protected $fillable = ['code','libelle','description','loginAdd','loginUpd'];

    public function cid_clients()
    {
        return $this->hasMany(CidClient::class);
    }
}
