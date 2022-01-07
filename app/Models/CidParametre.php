<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidParametre extends Model
{
    use HasFactory;

    protected $fillable = [
        'encours',
        'datoper',
        'refer1',
        'refer',
        'prefixe',
        'oper',
        'tailles',
    ];
}
