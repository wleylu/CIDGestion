<?php

namespace App\Http\Controllers;

use App\Models\CidPeriode;
use App\Models\CidProduit;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Brian2694\Toastr\Facades\Toastr;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        return view('pages.produit',([
            'produits'=>CidProduit::all(),
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->gestVarSession();

        return view('pages.createProduit',([
            'produit'=>new CidProduit(),
            'commissions'=>CidCommission::all(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->gestVarSession();
        $validated = $this->getValidProduit($request);

      
        $prod=new CidProduit([
            'codeProd'=>$request->input('code'),
            'taux'=>$request->input('taux'),
            'produit'=>$request->input('produit'),
            'commission'=>$request->input('montant'),
            'cid_commission_id'=>$request->input('commission'),
            'cid_periode_id'=>$request->input('periode'),
            'loginAdd'=>$request->user()->email,
            'loginUpd'=>$request->user()->email,

        ]);

       
        if ($prod->save()){
            session(['add_msg'=>'Ajout produit']);
            Toastr::success('Enregistrement effectué avec succès');
        }
        else {
            session(['add_msg'=>'Ajout produit']);
            Toastr::error('Enregistrement non effectué');
        }

        return view('pages.createProduit',([
            'produit'=>new CidProduit(),
            'produits'=>CidProduit::all(),
            'commissions'=>CidCommission::all(),
            'periodes'=>CidPeriode::all(),
        ]));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidProduit  $cidProduit
     * @return \Illuminate\Http\Response
     */
    public function show(CidProduit $cidProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidProduit  $cidProduit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->gestVarSession();

        return view('pages.createProduit',([
            'produit'=>CidProduit::find($id),
            'commissions'=>CidCommission::all(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidProduit  $cidProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->gestVarSession();

        $valideated = $this->getValidProduit($request);
        $produit = CidProduit::find($id);

        $prod=[
            'codeProd'=>$request->input('code'),
            'taux'=>$request->input('taux'),
            'produit'=>$request->input('produit'),
            'montant'=>$request->input('montant'),
            'commission'=>$request->input('montant'),
            'cid_commission_id'=>$request->input('commission'),
            'cid_periode_id'=>$request->input('periode'),
            'periode'=>$request->input('periode'),

        ];

        if ($produit->update($prod))
        {
            session(['update_msg'=>'Modification produit']);
            Toastr::success('Modification effectuée avec succès');
        }
        else
        {
            session(['update_msg'=>'Modification produit']);
            Toastr::error('Modification non effectuée');
        }

        return view('pages.produit',([
            'commissions'=>CidCommission::all(),
            'produits'=>CidProduit::all(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidProduit  $cidProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gestVarSession();

        $produit = CidProduit::find($id);
        $produit->delete();
        return view('pages.produit',([
            'produits'=>CidProduit::all(),
        ]));
    }

    public function getValidProduit(Request $request){
        return $request->validate([
            'code'=>'required',
            'produit'=>'required',
            'commission'=>'required',
            'periode'=>'required',
        ]);
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
