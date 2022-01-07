<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\CidClient;
use App\Models\CidCompte;
use App\Models\CidActivite;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CptBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $compte = new CidCompte();
        return view('pages.createCptbank',compact('compte'));
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
        $validated = $this->validateForm($request);

        $compte =
            [
                'compte'=>$request->input('compte'),
                'codbnq'=>$request->input('codbnq'),
                'codeguichet'=>$request->input('codeguichet'),
                'rib'=>$request->input('rib'),
                'banque'=>$request->input('banque'),
                'loginAdd'=>$request->user()->email,
                'loginUpd'=>$request->user()->email,
                'cid_client_id'=>$request->input('client'),
            ];

        $cpt = CidCompte::where('cid_client_id',$request->input('client'))->first();

       // dd($cpt);

        if ($cpt)
        {
            $compt =
            [
                'compte'=>$request->input('compte'),
                'codbnq'=>$request->input('codbnq'),
                'codeguichet'=>$request->input('codeguichet'),
                'rib'=>$request->input('rib'),
                'banque'=>$request->input('banque'),
                'loginUpd'=>$request->user()->email,

            ];

            if ($cpt->update($compt)){
                session(['update_msg'=>"Modifier compte"]);
                Toastr::success("Modification effectué avec succès");
            }
            else
            {
                session(['update_msg'=>"Erreur ajoout activité"]);
                Toastr::error("Modification non effectuée");
            }
        }
        else{
            if (CidCompte::create($compte)){
                session(['update_msg'=>"Ajout compte"]);
                Toastr::success("Enregistrement effectué avec succès");
            }
            else
            {
                session(['update_msg'=>"Erreur ajoout activité"]);
                Toastr::error("Enregistrement non effectué");
            }
        }


            //$activites = CidActivite::all();
            $clients = CidClient::all();
            return view('/pages.client',compact('clients'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function show($client)
    {

        $compte = CidCompte::where('cid_client_id',$client)->first();

        $compte = $compte == null ? new CidCompte(): $compte ;

       // dd($compte);

        return view('/pages.createCptbank',([
            'compte'=>$compte,
            'client'=>$client,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activite= CidActivite::find($id);

        return view('pages.createActivite',compact('activite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->gestVarSession();
        $validated= $this->validateForm($request);

        $activite= CidActivite::find($id);

        $activites =[
            'libelle'=>$request->input('libelle'),
            'description'=>$request->input('description'),
            'code'=>$request->input('code'),
            'loginUpd'=>$request->user()->email,
        ];

        if ($activite->update($activites)){
            session(['update_msg'=>'Modification']);
            Toastr::success('Modification efectuée avec succès');
        }

        $activites = CidActivite::all();

        /* return redirect('/quartier')->$quartier; */
        return view ('/pages.activite',compact('activites'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compte= CidCompte::where('cid_client_id',$id)->first();
        if ($compte){
            $compte->delete();
        }

        $clients = CidClient::all();
        return view('/pages.client',compact('clients'));
    }

    private function validateForm($request){
       return  $request->validate([
            'compte'=> 'required|min:11|max:12',
            'codbnq' => 'required',
            'codeguichet' => 'required',
            'rib' => 'required',
            'banque' => 'required',
        ]);
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
