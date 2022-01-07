<?php

namespace App\Http\Controllers;

use App\Models\CidType;
use App\Models\CidPeriode;
use App\Models\CidCodeOper;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Brian2694\Toastr\Facades\Toastr;

class TypecptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        return view('pages.typecpt',([
            'typecpts'=>CidType::all(),
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
        return view('pages.createTypecpt',([
            'typecpt'=>new CidType(),
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
        $com= new CidType([
            'code'=>$request->input('code'),
            'libelle'=>$request->input('libelle'),
            'classe'=>$request->input('classe'),

        ]);

        if ($com->save())
        {
            session('');
            session(['add_msg'=>'Ajout']);
            Toastr::success('Enregistrement effectué avec succès');
        }
        else
        {
            ssession(['add_msg'=>'Ajout']);
            Toastr::error('Enregistrement non effectué');
        }

        return view('pages.createTypecpt',([
            'typecpt'=>new CidType(),
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


        return view('pages.createTypecpt',([
            'typecpt'=>CidType::find($id),
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

        $typecpt=CidType::find($id);

        $typcpt=[
            'code'=>$request->input('code'),
            'libelle'=>$request->input('libelle'),
            'classe'=>$request->input('classe'),
        ];

        if ( $typecpt->update($typcpt)){
            session(['update_msg'=>'Mofication']);
            Toastr::success('Modification effectuée avec succès');
        }
        else
        {
            session(['update_msg'=>'Mofication']);
            Toastr::error('Modification non effectuée');
        }



        return view('pages.typecpt',([
            'typecpts'=>CidType::all(),
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
        $com = CidType::find($id);
        $com->delete();

        return view('pages.typecpt',([
            'typecpts'=>CidType::all(),
        ]));
    }

    private function gestValidCom(Request $request){
        return  $request->validate(
            [
                'code'=>'required',
                'libelle'=>'required',
                'classe'=>'required',

            ]
        );
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
