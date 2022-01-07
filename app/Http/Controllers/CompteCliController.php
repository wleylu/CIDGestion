<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CidType;
use App\Models\CidClient;
use App\Models\CidCompte;
use Illuminate\Support\Str;
use App\Models\CidCompteCli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class CompteCliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $this->gestVarSession();
        return view ('pages.createCompteCli',([
            'clt'=>new CidClient(),
            'codeClient'=>null,
            'typeCpt'=>CidType::all(),
            'comptes'=> [],
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
        $validated = $this->gestValidation($request);

        //dd($this->getGenerateCompte($request->input('cli')));

        $clis= CidClient::where('client',$request->input('cli'))->first();

        $compte= new CidCompteCli([
            'compte'=>$this->getGenerateCompte($request->input('cli')),
            'agence'=>$request->input('agence'),
            'client'=>$clis->client,
            'nom'=>$clis->nom.' '.$clis->prenom,
            'rubrique'=>CidType::find($request->input('typeCpt'))->code,
            'cid_client_id'=>$clis->id,
            'user_id'=>$request->user()->id,
            'loginAdd'=>$request->user()->email,
            'loginUpd'=>$request->user()->email,
            'cid_type_id'=>$request->input('typeCpt'),

        ]);

       // dd($clis->client);

        if ($compte->save()){
            session(['add_prod'=>'Ajout effectuée avec succès']);
            Toastr::success('Compte créé avec succès');
        }
        else{
            session(['add_prod'=>'Ajout effectuée avec succès']);
            Toastr::error('Compte non créé avec succès');
        }

        $cpts= CidCompteCli::where('client',$clis->client)->get();
        return view ('pages.createCompteCli',([
            'clt'=>$clis,
            'typeCpt'=>CidType::all(),
            'codeClient'=>$request->input('cli'),
            'comptes'=> $cpts,
        ]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidCompteCli  $cidCompteCli
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


        $this->gestVarSession();
        $comptCli = new CidCompteCli();
       // $client = CidClient::where('client',$request->client)->first();
       $client = DB::table('cid_clients')
                ->where('client',$request->client)
                ->where('valide',1)
                ->where('action','<>','F')
                ->first();
        if ($client){
            $comptCli = CidCompteCli::where('client',$request->client)->get();
        }

        $codeClient = $request->client;

        if (!$client){
            $client = new CidClient();
            session(['add_prod'=>'Afficher message']);
            Toastr::warning('Client inexistant ou en attente de validation dans la base');
        }
             return view ('pages.createCompteCli',([
            'clt'=>$client,
            'typeCpt'=>CidType::all(),
            'clients'=>CidClient::all(),
            'codeClient'=>$codeClient,
            'comptes'=> $comptCli,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidCompteCli  $cidCompteCli
     * @return \Illuminate\Http\Response
     */
    public function edit(CidCompteCli $cidCompteCli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidCompteCli  $cidCompteCli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CidCompteCli $cidCompteCli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidCompteCli  $cidCompteCli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $this->gestVarSession();
        $compte = CidCompteCli::find($request->id);
        if($compte){
            if ($compte->delete()){
                session(['add_prod'=>'Suppression effectuée avec succès']);
                Toastr::success('Suppression effectuée avec succès');
            }
            else
            {
                session(['add_prod'=>'Suppression effectuée avec succès']);
                Toastr::error('Suppression non effectuée');
            }

            $clis= CidClient::where('client',$compte->client)->first();
            $cpts= CidCompteCli::where('client',$compte->client)->get();
        }
        else
        {
            $clis=new CidClient();
            $cpts= new CidCompteCli();
            session(['add_prod'=>'Suppression effectuée avec succès']);
            Toastr::warning('Client inexistant dans la base');
        }




        return view ('pages.createCompteCli',([
            'clt'=>$clis,
            'typeCpt'=>CidType::all(),
            'codeClient'=>$clis->client,
            'comptes'=> $cpts,
        ]));
    }

    private function getGenerateCompte($client){
      /* $idcompte = Carbon::now()->format('h')*Carbon::now()->format('i')*Carbon::now()->format('s')*
                  substr($client,4,5)-4;
                  */

        $idcompte = Carbon::now()->format('h')*Carbon::now()->format('i')*Carbon::now()->format('s')*
        substr($client,0,2)-4;
        $compte = $client.substr($idcompte,0,4);

        $compte = $this->validCompte($compte);

        $cptvalide=null;
        $test = false;
        $cpt=null;

        while(!$test){
            // dd($test);
            $cpt = CidCompteCli::where('compte',$compte)->first();
             if ($cpt == null){
                 $test= true;
                 $cptvalide=$compte;
                // dd('ici 1 '.$client);
             }
             else
             {

                $compte= $this->getIncrCompte($compte);
                 $test= false;
               //  dd('ici 1 '.$validClient);
             }
         }


        return $cptvalide;
    }

    private function getIncrCompte($compte){
        $retour=substr($compte,0,8).substr($compte,4,5);

        return Str::length($retour)>10 ? substr($retour,0,9) : $retour;
    }

    private function validCompte($compte){
        $cptvalide=null;
        $tail = 0;
        $test = false;
        if (Str::length($compte)>10){
            $cptvalide = substr($compte,0,9);
        }
        else{
            while(!$test){
                $cptvalide=$compte.'0';
                $tailles= Str::length($cptvalide);
                 if ($tailles<10)
                 {
                    $test = false;
                 }
                 else{
                    $cptvalide=$compte;
                    $test = true;
                 }

            }
        }

        return Str::length($cptvalide)>10 ? substr($cptvalide,0,9) : $cptvalide;

    }

    private function gestValidation(Request $request){
        return  $request->validate(
            [
                'agence'=>'required',
                'typeCpt'=>'required',
            ]
        );
    }

    private function gestVarSession(){

        session()->forget('add_prod');
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
