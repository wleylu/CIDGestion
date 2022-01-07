<?php

namespace App\Http\Controllers;

use App\Models\CidType;
use App\Models\CidPeriode;
use App\Models\CidCodeOper;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Brian2694\Toastr\Facades\Toastr;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        return view('pages.periode',([
            'periodes'=>CidPeriode::all(),
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
        return view('pages.createPeriode',([
            'periode'=>new CidPeriode(),
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
        $validated = $this->gestValidCom($request);

        $com= new CidPeriode([
            'codeCom'=>$request->input('codeCom'),
            'libelle'=>$request->input('libelle'),
        ]);

        if ($com->save()){
            session(['add_msg'=>'Ajout de période']);
            Toastr::success('Enregistrement effectué avec succès');
        }
        else
        {
            session(['add_msg'=>'Echec Ajout de période']);
            Toastr::error('Enregistrement non effectué');
        }        

        return view('pages.createPeriode',([
            'periode'=>new CidPeriode(),           
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidCodeOper  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function show(CidCommission $cidCommission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidCodeOper  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)    {

        $this->gestVarSession();
        return view('pages.createPeriode',([
            'periode'=>CidPeriode::find($id),
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidCodeOper  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->gestVarSession();
        $validated = $this->gestValidCom($request);

        $typecpt=CidPeriode::find($id);

        $periode=[
            'codeCom'=>$request->input('codeCom'),
            'libelle'=>$request->input('libelle'),
        ];

        if ($typecpt->update($periode)){
            session(['update_msg'=>'Modification']);
            Toastr::success('Modification effectuée avec succès');
        }
        else
        {
            session(['update_msg'=>'Modification']);
            Toastr::error('Modification non effectuée');
        }


        return view('pages.periode',([
            'periodes'=>CidPeriode::all(),
        ]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidCodeOper  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gestVarSession();
        $com = CidPeriode::find($id);
        $com->delete();

        return view('pages.periode',([
            'periodes'=>CidPeriode::all(),
        ]));
    }

    private function gestValidCom(Request $request){
        return  $request->validate(
            [
                'codeCom'=>'required',
                'libelle'=>'required',               
            ]
        );
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
