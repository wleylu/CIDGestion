<?php

namespace App\Models;

use App\Models\CidSituation;
use App\Models\CidNaturePiece;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CidClient extends Model
{
    use HasFactory;

    protected $fillable =
     [
         'client',
         'nom',
         'prenom',
         'tel',
         'adrpost',
         'nature',
         'pere',
         'numpiece',
         'mere',
         'dateouv',
         'photo',
         'sign',
         'datesign',
         'datenaiss',
         'email',
         'adrgeo',
         'loginAdd',
         'loginUpd',
         'cid_quartier_id',
         'cid_activite_id',
         'cid_situation_id',
         'cid_nature_piece_id',
         'valide',
         'user_id',
         'typeClient',

     ];


    public function cid_contrats()
    {
        return $this->hasMany(CidContrat::class);
    }

    public function cid_compte_clis(){
        return $this->hasMany(CidCompteCli::class);
    }

    public function cid_quartier()
    {
        return $this->belongsTo(CidQuartier::class);
    }

    public function cid_activite()
    {
        return $this->belongsTo(CidActivite::class);
    }

    public function cid_comptes()
    {
        return $this->hasMany(CidCompte::class);
    }

   /*  public function cid_produits()
    {
        return $this->belongsToMany(CidProduit::class);
    }
 */
    public function cid_situation()
    {
        return $this->belongsTo(CidSituation::class);
    }

    public function cid_nature_piece()
    {
        return $this->belongsTo(CidNaturePiece::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
