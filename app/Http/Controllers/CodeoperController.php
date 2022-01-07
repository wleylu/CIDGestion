<?php

namespace App\Http\Controllers;

use App\Models\CidPeriode;
use App\Models\CidCodeOper;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class CodeoperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        return view('pages.codeopers',([
            'codeopers'=>CidCodeOper::all(),
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

        return view('pages.createCodeopers',([
            'codeoper'=>new CidCodeOper(),
            'comptes'=>$this->getComptes(),
            'commissions'=>CidCommission::all(),
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

     //   dd( $request->taux);

        $com= new CidCodeOper([
            'oper'=>$request->input('oper'),
            'libelle'=>$request->input('libelle'),
            'acteur'=>$request->input('acteur'),
            'compteOper'=>$request->input('compteOper'),
            'compteCom'=>$request->input('compteCom'),
            'mntCom'=>$request->input('montant'),
            'taux'=>$request->input('taux'),
            'description'=>$request->input('description'),
            'cid_commission_id'=>$request->input('commission'),
            'loginAdd'=>$request->user()->email,
            'loginUpd'=>$request->user()->email,

        ]);

        if ($com->save())
        {

            session(['add_msg'=>'Enregistré avec succès']);
            Toastr::success('Enregistrement effectué avec succès');
        }
        else
        {
            session(['add_msg'=>'Enregistré avec succès']);
            Toastr::error('Enregistrement non effectué ');
        }
        

        return view('pages.createCodeopers',([
            'codeoper'=>new CidCodeOper(),
            'comptes'=>$this->getComptes(),
            'commissions'=>CidCommission::all(),
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

        return view('pages.createCodeopers',([
            'codeoper'=>CidCodeOper::find($id),
            'comptes'=>$this->getComptes(),
            'commissions'=>CidCommission::all(),
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
        $validated = $this->gestValidComModif($request);      
        $com=CidCodeOper::find($id);
        $comm=[
            'oper'=>$request->input('oper'),
            'libelle'=>$request->input('libelle'),
            'acteur'=>$request->input('acteur'),
            'compteOper'=>$request->input('compteOper'),
            'compteCom'=>$request->input('compteCom'),
            'mntCom'=>$request->input('montant'),
            'taux'=>$request->input('taux'),
            'description'=>$request->input('description'),
            'cid_commission_id'=>$request->input('commission'),
            'loginUpd'=>$request->user()->email,

        ];

        if ($com->update($comm)){
            session(['update_msg'=>'Modification effectuée avec succès']);
            Toastr::success('Modification effectuée avec succès');
        }
        else
        {
            session(['update_msg'=>'Modification effectuée avec succès']);
            Toastr::error('Modification non effectuée');
        }





        return view('pages.codeopers',([
            'codeopers'=>CidCodeOper::all(),
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
        $com = CidCodeOper::find($id);
        $com->delete();

        return view('pages.codeopers',([
            'codeopers'=>CidCodeOper::all(),
        ]));
    }

    private function gestValidCom(Request $request){
        return  $request->validate(
            [
                'oper'=>'required|unique:cid_code_opers',
                'libelle'=>'required|unique:cid_code_opers',
                'description'=>'required',
                'acteur'=>'required',
            ]
        );
    }

    private function gestValidComModif(Request $request){
        return  $request->validate(
            [
                'oper'=>'required',
                'libelle'=>'required',
                'description'=>'required',
               
            ]
        );
    }

    private function getComptes(){
        $comptes = DB::select('select c.id,c.compte from cid_compte_clis c,cid_types t
        where t.id=cid_type_id and t.classe=:id',['id'=>'5']);

        return $comptes;
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
