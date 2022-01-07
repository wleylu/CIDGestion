<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidQuartier extends Model
{
    use HasFactory;

    protected $fillable = ['libelle','pays','ville','description','loginAdd','loginUpd'];

    public function cid_clients()
    {
        return $this->hasMany(CidClient::class);
    }
}
