<?php

namespace App\Http\Controllers;

use App\Models\CidClient;
use App\Models\CidCompte;
use App\Models\CidProduit;
use App\Models\CidCodeOper;
use Illuminate\Support\Str;
use App\Models\CidComptable;
use App\Models\CidCompteCli;
use App\Models\CidOperation;
use App\Models\CidParametre;
use Illuminate\Http\Request;
use App\Models\CidCommission;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()   {
        $this-> gestVarSession();

        return view('pages.createOperations',([
            'client'=>new CidClient(),
            'curentClient'=>null,
            'typeopers'=>CidCodeOper::all(),
            'comptes'=>Cidcompte::all(),
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $validated = $this->validForm($request);
        $schema = null;
        $lignes= [];
        $commission = [];
        $opers=null;
        $cpt=null;
        $soldeold=0;
        $soldenew=0;
        $compte1=null;
        $compte2=null;
        $solde1=0;
        $solde2=0;
        $soldeControl = 0;
        $dateoper = Carbon::now()->format('Y-m-d');

        $mt = $this->montantComCompta($request->input('oper'),$request->input('montant'));

        $client = CidClient::where('client',$request->input('client'))->first();

        //$valiClt = $this->controleValidClt($request->input('client'));

       // dd($valiClt);


          /*   $vc_solde=$this->getSoldeClient($request->input('client'));
            foreach($vc_solde as $vcssolde){
                $soldeControl = $vcssolde->solde;
            } */

            /* if ($soldeControl < $request->input('montant')){

            }
            else
            { */

                    if($request->input('oper')){
                        $opers = CidCodeOper::where('oper',$request->input('oper'))->first();
                        $refer= $this->setNumRefer($request->input('oper'));
                        $schema =  CidComptable::where('oper',$request->input('oper'))->get();

                    }


                    foreach( $schema as $item){
                        $montant=0;
                        $cpt=null;

                        if ($item->variable =='CPT'){
                            $compt=$opers->compteOper;
                            $compte1=$opers->compteOper;
                            $soleavt= $this->getSoldeCompte($opers->compteOper);
                            $montant= $item->sens=='D' ? -$request->input('montant') : $request->input('montant');

                            foreach ($soleavt as $avt)
                            {
                                $soldeold= $avt->solde;
                                $soldenew= $avt->solde+ $montant;
                                $solde1 =  $avt->solde+ $montant;
                            }
                        }

                        if ($item->variable =='CLIENT'){
                            $vsolde= $this->getSoldeClient($request->input('client'));

                            $montant= $item->sens=='D' ? -$request->input('montant') : $request->input('montant');

                            foreach ($vsolde as $sold)
                            {
                                $soldeold= $sold->solde;
                                $compt= $sold->compte;
                                $compte2= $sold->compte;
                                $soldenew= $sold->solde+$montant;
                                $solde2 = $sold->solde+$montant;
                            }

                            if ($item->sens=='D'){
                                if ($soldeold + $mt < $request->input('montant')){
                                    $soldeControl=1;
                                }
                            }



                        }

                        $lignes[] = [
                            'sens'=>$item->sens,
                            'oper'=>$item->oper,
                            'compte'=>$compt,
                            'refer'=>$refer,
                            'solde'=>$soldenew,
                            'soldeavt'=>$soldeold,
                            'montant'=>$montant,
                            'dateTransact'=>$dateoper,
                            'dateValeur'=>$dateoper,
                            'libelle'=>CidCodeOper::where('oper',$request->input('oper'))->first()->libelle,
                            'description'=>$request->input('description'),
                            'loginAdd'=>$request->user()->email,
                            'loginUpd'=>$request->user()->email,
                            'cid_compte_cli_id'=>CidCompteCli::where('compte',$compt)->first()->id,
                            'cid_code_oper_id'=>CidCodeOper::where('oper',$request->input('oper'))->first()->id,
                            'user_id'=>$request->user()->id,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),

                            ];

                    }



                    if ($soldeControl < 1)
                    {
                        //$this->comptaCom($request->input('oper'),$mt,$compte2,$refer,$request->user()->email,$request->user()->id);
                        $oper = DB::table('cid_operations')->insert($lignes);

                        if ($oper){
                            $this->soldeCptUpdate($compte2,$solde2,$request->user()->id,$request->user()->email);
                            $this->soldeClientUpdate($compte2,$request->user()->id,$request->user()->email);

                            $this->soldeCptUpdate($compte1,$solde1,$request->user()->id,$request->user()->email);
                            $this->soldeClientUpdate($compte1,$request->user()->id,$request->user()->email);


                          //  dd($mt);
                            $this->comptaCom($request->input('oper'),$mt,$compte2,$refer,$request->user()->email,$request->user()->id);

                            session(['add_msg'=>'Opération validée']);
                            Toastr::success('Transaction effectuée avec succès');
                        }
                    }
                    else
                    {
                        session(['add_msg'=>'Provision insufisanate']);
                        Toastr::info('Provision insufisanate');
                    }
          //  }
            //dd($oper);

        //fin sinon

        return view('pages.createOperations',([
            'client'=>$client,
            'comptes'=>CidCompte::all(),
            'typeopers'=> CidCodeOper::all(),
            'curentClient'=>$request->input('client'),
        ]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidOperation  $cidOperation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->gestVarSession();

        $client = CidClient::where('client',$request->input('client'))
                ->where('valide',1)
                ->where('action','<>','F')
                ->first();


        if ($client == null){
            session(['add_msg'=>'Client inexistant dans la base']);
            Toastr::warning('Client '.$request->input('client').' inexistant dans la base');
            $client = new CidClient();
        }
        else
        {
            $nbcpt = CidCompteCli:: where('client',$client->client)->count();

            //dd(Str::length($compte));
                if($nbcpt < 1)
                {
                    session(['add_msg'=>'Client inexistant dans la base']);
                    Toastr::warning('Client '.$request->input('client').' ne dispose pas de comptes');
                    $client = new CidClient();
                }

        }


        return view('pages.createOperations',([
            'client'=>$client,
            'comptes'=>CidCompte::all(),
            'typeopers'=> CidCodeOper::all(),
            'curentClient'=>$request->input('client'),
        ]));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidOperation  $cidOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(CidOperation $cidOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidOperation  $cidOperation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CidOperation $cidOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidOperation  $cidOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CidOperation $cidOperation)
    {
        //
    }

    private function validForm(Request $request){
        return $request->validate([
            'oper'=>'required',
            'montant'=>'required',
            'description'=>'required',
        ]);
    }

    //fonction de comptabilisation des opérations
    private function setComOperations($oper,$montant,$refer){
        $commission = [];
        $idcom = CidCodeOper::where('oper',$oper)->first()->cid_commission_id;

        if ($idcom){
            $com = CidCommission::find($idcom);
            if($com->mnt > 0) {
                $commission[] = [
                  'sens'=>'D',
                   'oper'=>$oper,
                   'refer'=>'45',
                   'solde'=>'0',
                   'soldeavt'=>'0',
                   'montant'=>'0',
                   'dateTransact'=>'0',
                   'dateValeur'=>'0',
                   'libelle'=>'libelle',
                   'description'=>$request->input('description'),
                   'loginAdd'=>$request->user()->email,
                   'loginUpd'=>$request->user()->email,
                ];
            }
        }

        return $commission;
    }


//fonction de génération des rérférences opérations
    private function setNumRefer($oper){

        $date1= Carbon::now()->format('Y').'-01-01';
         $date2= Carbon::now()->format('Y-m-d');
         $jour= Carbon::parse($date1)->floatDiffInDays($date2);
         $jour= Str::length($jour) ==1 ? '00'.$jour : $jour;
         $jour= Str::length($jour) ==2 ? '0'.$jour : $jour;
         $prefix = $oper.intval($jour);
         $reference = null;


        $param= CidParametre::where('oper',$oper)->first();
        $taille=0;
        $tOper = 0;
        $refer  = null;
        $t2 = 0;
        $jk = 0;
        $incerment=0;

        if ($param)
        {
            // $taille = $param->tailles;
            $taille = 8;
            $tOper= Str::length($param->refer1+1);
            $refer = $param->refer1+1;
            $incerment =  $param->refer1+1;
            $t2 = $taille - $tOper;
        }
        else
        {
            $taille = 8;
            $tOper= 1;
            $refer = 1;
            $incerment= $refer;
            $t2 = $taille - $tOper;
        }


        if ($t2 > 0){

            while ($t2 >  $jk)
            {
                $refer ='0'.$refer;
                $jk++;
            }
        }

        $reference= $prefix.$refer;


        $testReft = false;

        while(!$testReft){
            $refop = CidParametre::where('refer',$reference)->first();
            if($refop){
                $jk=0;
                while ($t2 >  $jk)
                {
                    $refer ='0'.$refer;
                    $jk++;
                }
                $reference= $prefix.$refer;
                $testReft = false;
            }
            else
            {
                $testReft = true;
            }
        }

      //  dd($reference);

            if ($param){
                $param2 = null;
                 if(Carbon::now()->format('Y').'-01-01' != $param->encours){

                    $param2 = [
                        'encours'=>Carbon::now()->format('Y').'-01-01',
                        'datoper'=>Carbon::now()->format('Y-m-d'),
                        'refer1'=>$incerment,
                        'refer'=>$reference,
                     ] ;

                     $param->update($param2);
                 }
                 else
                 {
                        if ($param->datoper != Carbon::now()->format('Y-m-d')){
                            $param2 = [
                                'refer1'=>$incerment,
                                'refer'=>$reference,
                                'datoper'=>Carbon::now()->format('Y-m-d'),
                            ] ;
                        }
                        else
                        {
                            $param2 = [
                                'refer1'=>$incerment,
                                'refer'=>$reference,

                            ] ;
                        }

                     $param->update($param2);
                  }

             }
             else
             {

                $param1 = new CidParametre([
                    'encours'=>Carbon::now()->format('Y').'-01-01',
                    'datoper'=>Carbon::now()->format('Y-m-d'),
                    'refer1'=>1,
                    'refer'=>$reference,
                    'prefixe'=>'0',
                    'oper'=>$oper,
                    'tailles'=>8,
                 ] );

                $param1->save();
             }



        return $reference;
    }

    //fonction solde de client
    private function getSoldeClient($client){
        $solde =DB::select('select solde,compte from cid_compte_clis where client=:client and rubrique=:ncg',['client'=>$client,'ncg'=>'251']);

        return $solde;
    }

      //fonction solde de compte
    private function getSoldeCompte($compte){
        $solde =DB::select('select solde,compte from cid_compte_clis where compte=:compte',['compte'=>$compte]);
        return $solde;
    }

      //mise à jour de solde compte
    private function soldeCptUpdate($compte,$montant,$iduser,$login){
        $affected = DB::table('cid_compte_clis')
             ->where('compte', $compte)
              ->update(['solde' => $montant,'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
              'loginUpd'=>$login,'user_id'=>$iduser,]);

    }

    //mise à jour de solde client
    private function soldeClientUpdate($compte,$iduser,$login){
        $client= CidCompteCli::where('compte',$compte)->first()->client;
        $solde = DB::table('cid_compte_clis')->where('client',$client)->sum('solde');
        $affected = DB::table('cid_clients')
             ->where('client', $client)
              ->update(['solde' => $solde,'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
              'loginUpd'=>$login]);

    }

    //comptabiisation de la commission
    private function comptaCom($codeoper,$mnt,$compted,$refoper,$login,$userid){

        if ($montant = 0){

        }
        else
        {
            $comptec =null;
            $operId = CidCodeOper::where ('oper',$codeoper)->first()->cid_commission_id;

            if ($operId){
                $comptec = CidCommission::find($operId)->compte;
            }
            else
            {
                $comptec = CidCodeOper::where('oper',$codeoper)->first()->compteCom;
            }

            $soldold_d = CidCompteCli::where('compte',$compted)->first()->solde;
            $soldold_c = CidCompteCli::where('compte',$comptec)->first()->solde;

            $lignes = [
                [
                'sens'=>'D',
                'oper'=>$codeoper,
                'compte'=>$compted,
                'refer'=>$refoper,
                'solde'=>$soldold_d-$mnt,
                'soldeavt'=>$soldold_d,
                'montant'=>-$mnt,
                'dateTransact'=>Carbon::now()->format('Y-m-d'),
                'dateValeur'=>Carbon::now()->format('Y-m-d'),
                'libelle'=>CidCodeOper::where('oper',$codeoper)->first()->libelle,
                'description'=>'Commission pour opération '.$codeoper.'=>'.CidCodeOper::where('oper',$codeoper)->first()->libelle ,
                'loginAdd'=>$login,
                'loginUpd'=>$login,
                'cid_compte_cli_id'=>CidCompteCli::where('compte',$compted)->first()->id,
                'cid_code_oper_id'=>CidCodeOper::where('oper',$codeoper)->first()->id,
                'user_id'=>$userid,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),

                ],
                [
                'sens'=>'C',
                'oper'=>$codeoper,
                'compte'=>$comptec,
                'refer'=>$refoper,
                'solde'=>$soldold_d+$mnt,
                'soldeavt'=>$soldold_d,
                'montant'=>$mnt,
                'dateTransact'=>Carbon::now()->format('Y-m-d'),
                'dateValeur'=>Carbon::now()->format('Y-m-d'),
                'libelle'=>CidCodeOper::where('oper',$codeoper)->first()->libelle,
                'description'=>'Commission pour opération '.$codeoper.'=>'.CidCodeOper::where('oper',$codeoper)->first()->libelle ,
                'loginAdd'=>$login,
                'loginUpd'=>$login,
                'cid_compte_cli_id'=>CidCompteCli::where('compte',$compted)->first()->id,
                'cid_code_oper_id'=>CidCodeOper::where('oper',$codeoper)->first()->id,
                'user_id'=>$userid,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),

                    ]
        ];
         //  dd($lignes );

                    $oper = DB::table('cid_operations')->insert($lignes);

                        if ($oper){
                            $this->soldeCptUpdate($compted,$soldold_d-$mnt,$userid,$login);
                            $this->soldeClientUpdate($compted,$userid,$login);

                            $this->soldeCptUpdate($comptec,$soldold_d+$mnt,$userid,$login);
                            $this->soldeClientUpdate($comptec,$userid,$login);

                        }
        }

    }

    //recherche du montant de la commission
    private function montantComCompta($codeoper,$montant){
        $oper = CidCodeOper::where ('oper',$codeoper)->first();
        $mnt = 0;
        if ($oper->mntCom > 0){
            $mnt= $oper->mntCom;
            return $mnt;
        }

        if ($oper->taux > 0){
            $mnt = intval($montant*$oper->taux/100);
            return $mnt;
        }

        $com = CidCommission::find ($oper->cid_commission_id);

        if ($com->mnt > 0){
            $mnt= $com->mnt;
            return $mnt;
        }

        if ($com->taux > 0){
            $mnt = intval($montant*$com->taux/100);
            return $mnt;
        }

        return 0;
    }

    private function controleValidClt($client){
        return DB::table('cid_clients')->where('client',$client)->first()->valide;
    }

    //fonction de validation du formulaire des variables de sessions
    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }

}
