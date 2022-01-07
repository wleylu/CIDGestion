<?php

namespace App\Http\Controllers;

use App\Models\CidPeriode;
use App\Models\CidCodeOper;
use App\Models\CidComptable;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;


class ComptableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this-> gestVarSession();
        return view('pages.comptable',([
            'comptables'=>CidComptable::all(),
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this-> gestVarSession();
        $comptes = DB::select('select c.id,c.compte from cid_compte_clis c,cid_types t
                    where t.id=cid_type_id and t.classe=:id',['id'=>'5']);
        return view('pages.createComptable',([
            'comptable'=>new CidComptable(),
            'codeOpers'=>CidCodeOper::all(),
            'comptas'=> [],

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
        $this-> gestVarSession();

        $comptable= new CidComptable([
            'oper'=>CidCodeOper::find($request->input('oper'))->oper,
            'sens'=>$request->input('sens'),
            'variable'=>$request->input('variable'),
            'libelle'=>$request->input('libelle'),
            'varmnt'=>$request->input('varMontant'),
            'loginAdd'=>$request->user()->email,
            'loginUpd'=>$request->user()->email,
            'cid_code_oper_id'=>$request->input('oper'),
        ]);

        if ($comptable->save())
            {
                session(['add_msg'=>'Enregistré avec succès']);
                Toastr::success('Enregistrement effectué avec succès');
            }
            else
            {
                session(['add_msg'=>'Enregistré avec succès']);
                Toastr::error('Echec de l\'enregistrement');
            }

        $comptas = CidComptable::where('oper', $comptable->oper)->get();


        return view('pages.createComptable',([
            'comptable'=>new CidComptable(),
            'codeOpers'=>CidCodeOper::all(),
            'comptas'=> $comptas ,

        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidCodeOper  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function show(CidComptable $cidCommission)
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

        $this-> gestVarSession();
        $comptas = CidComptable::where('oper', CidComptable::find($id)->oper)->get();

        return view('pages.createComptable',([
            'comptable'=>CidComptable::find($id),
            'codeOpers'=>CidCodeOper::all(),
            'comptas'=>$comptas,
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
        $this-> gestVarSession();
        $validated = $this->gestValidCom($request);
        $comptable=CidComptable::find($id);

        $compta=[
            'oper'=>CidCodeOper::find($request->input('oper'))->oper,
            'sens'=>$request->input('sens'),
            'variable'=>$request->input('variable'),
            'libelle'=>$request->input('libelle'),
            'varmnt'=>$request->input('varMontant'),
            'loginUpd'=>$request->user()->email,
            'cid_code_oper_id'=>$request->input('oper'),
        ];

        if($comptable->update($compta)){
            session(['update_msg'=>'Enregistré avec succès']);
            Toastr::success('Mofication effectuée avec succès');
        }
        else 
        {
            session(['update_msg'=>'Enregistré avec succès']);
            Toastr::error("Echec de l'enregistrement");
        }
        
        $comptas = CidComptable::where('oper', $comptable->oper)->get();

        return view('pages.comptable',([
            'comptables'=>CidComptable::all(),
            'codeOpers'=>CidCodeOper::all(),
            'comptas'=> $comptas ,
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
        $this-> gestVarSession();

        $com = CidComptable::find($id);
        $com->delete();

        return view('pages.typecpt',([
            'comptables'=>CidComptable::all(),
        ]));
    }

    private function gestValidCom(Request $request){
        return  $request->validate(
            [
                'oper'=>'required',
                'sens'=>'required',
                'libelle'=>'required',
                
            ]
        );
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
