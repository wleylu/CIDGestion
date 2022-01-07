<?php

namespace App\Http\Controllers;

use App\Models\CidPeriode;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        return view('pages.commission',([
            'commissions'=>CidCommission::all(),
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
        return view('pages.createCom',([
            'comm'=>new CidCommission(),
            'comptes'=>$this->getComptes(),
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
        $validated = $this->gestValidCom($request);
       // dd( $request->taux);
        $com= new CidCommission([
            'codetype'=>$request->input('codetype'),
            'libelle'=>$request->input('libelle'),
            'taux'=>$request->input('taux'),
            'compte'=>$request->input('compte'),
            'mnt'=>$request->input('mnt'),
            'cid_periode_id'=>$request->input('periode'),
            'loginAdd'=>$request->user()->email,
            'loginUpd'=>$request->user()->email,

        ]);

        if ($com->save())
        {
            session(['add_msg'=>'Modification']);
            Toastr::success('Enregistrement effectuée avec succès');
        }
        else{
            session(['add_msg'=>'Modification']);
            Toastr::error('Enregistrement non effectuée');
        }

        return view('pages.createCom',([
            'comm'=>new CidCommission(),
            'comptes'=>$this->getComptes(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidCommission  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function show(CidCommission $cidCommission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidCommission  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)    {
        $this->gestVarSession();

        return view('pages.createCom',([
            'comm'=>CidCommission::find($id),
            'comptes'=>$this->getComptes(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidCommission  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->gestVarSession();
        $validated = $this->gestValidCom($request);

        $com=CidCommission::find($id);

        $comm=[
            'codetype'=>$request->input('codetype'),
            'libelle'=>$request->input('libelle'),
            'taux'=>$request->input('taux'),
            'mnt'=>$request->input('mnt'),
            'compte'=>$request->input('compte'),
            'cid_periode_id'=>$request->input('periode'),
            'loginUpd'=>$request->user()->email,

        ];

        if ($com->update($comm)){
            session(['update_msg'=>'Modification']);
            Toastr::success('Modification effectuée avec succès');
        }
        else{
            session(['update_msg'=>'Modification']);
            Toastr::error('Modification non effectuée');
        }


        return view('pages.commission',([
            'commissions'=>CidCommission::all(),
        ]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidCommission  $cidCommission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gestVarSession();
        $com = CidCommission::find($id);
        $com->delete();

        return view('pages.commission',([
            'commissions'=>CidCommission::all(),
            'periodes'=>CidPeriode::all(),
        ]));
    }

    private function gestValidCom(Request $request){
        return  $request->validate(
            [
                'codetype'=>'required',
                'libelle'=>'required',                
                'periode'=>'required',
            ]
        );
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }

    private function getComptes(){
        $comptes = DB::select('select c.id,c.compte from cid_compte_clis c,cid_types t
        where t.id=cid_type_id and t.classe=:id',['id'=>'5']);

        return $comptes;
    }
}
