<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidContrat extends Model
{
    use HasFactory;

    public function cid_client()
    {
        return $this->belongsTo(CidClient::class);
    }
}
