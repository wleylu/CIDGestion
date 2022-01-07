<?php

namespace App\Http\Controllers;

use App\Models\CidClient;
use App\Models\CidProduit;
use App\Models\CidActivite;
use App\Models\CidQuartier;
use Illuminate\Http\Request;
use App\Models\CidProduitClient;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


class ClientProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = CidClient::all();
        return view('/pages.clientProduit',compact('clients'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {

       // $request ->session()->forget('add_msg');

        $client = CidClient::find($id);

        $prods = $this->getProduits($client->id);

        $clientsProd =$this->getProdsClient($client->id);

        return view('pages.createCliProd',[
            'client'=>$client,
            'produits'=>$prods,
            'prodClient'=>$clientsProd,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validated = $this->gestValidation($request);
        $client = CidClient::where('client',$request->input('client1'))->first();

          if ($client){
            $clientProd = new CidProduitClient([
                'cid_client_id'=>CidClient::where('client',$request->input('client1'))->first()->id,
                'cid_produit_id'=>$request->input('produit'),
                'loginAdd'=>$request->user()->email,
                'loginUpd'=>$request->user()->email,

                ]);

                $request->session()->forget('update_msg');

                if ($clientProd->save()){
                    session(['add_prod'=>'Souscription effectuée avec succès']);
                    Toastr::success('Souscription effectuée avec succès');
                }
                else
                {
                    session(['add_prod'=>'Echec de la souscription']);
                    Toastr::error('Echec de la souscription');
                }

          }
          else
          {
              session(['add_prod'=>'Bien']);
              Toastr::warning('Client inexistant dans la base');

          }

          $prods = $this->getProduits($client->id);

         $clientsProd =$this->getProdsClient($client->id);

       //   dd($clientsProd);

          return view('pages.createCliProd',[
            'client'=>$client ,
            'produits'=>$prods,
            'prodClient'=>$clientsProd,
            ]
        );




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function show(CidClient $cidClient)
    {
        //
    }

    private function getCodeClient()
    {
          $maxClient = CidClient::max('client');
          $codClt = CidClient::where('client',$maxClient)->first();

        


          $codeCli=null;
          $trt =false;

        if($codClt == null){

            $codeCli='2100001';
        }
        else
        {

            while(!$trt){
                $maxClient=$maxClient+1;
                $codClt = CidClient::where('client',$maxClient)->first();
                if ($codClt == ""){
                    $codeCli = $maxClient;
                    $trt = true;
                }

            }

        }


        return $codeCli;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = CidClient::findOrfail($id);
       // dd($client->client);

        return view ('pages.createClient',([
            'client'=>$client,
            'quartiers'=>CidQuartier::all(),
            'activites'=>CidActivite::all(),
            'codeClient'=>$client->client
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->gestValidation($request);
        $client = CidClient::findOrfail($id);
        $client->update(
            [
                'nom'=>$request->input('nom'),
                'prenom'=>$request->input('prenom'),
                'tel'=>$request->input('telephone'),
                'adresse'=>$request->input('adresse'),
                'adrgeo'=>$request->input('adrgeo'),
                'cid_quartier_id'=>$request->input('quartier'),
                'cid_activite_id'=>$request->input('secActivite'),
                'loginUpd'=>$request->user()->email,
            ]
            );


            return view ('pages.client',([
                'clients'=>CidClient::all()
            ]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->gestVarSession();

        $prodClt = CidProduitClient::find($request->id);
        $clt = null;



        if($prodClt != null){
            $clt = $prodClt->cid_client_id;

            if($prodClt->delete()){

                session(['add_prod'=>'Suppression effectuée avec succès']);
                Toastr::success('Suppression effectuée avec succès');
            }
            else
            {
                session(['add_prod'=>'Echec de la Suppression']);
                Toastr::error('Echec de la Suppression');
            }
        }
        else{

                session(['add_prod'=>'Client inexistant dans la base']);
                Toastr::warning('Client inexistant dans la base');
        }


        $client = CidClient::find($clt);

        $prods = $this->getProduits($clt);

        $clientsProd =$this->getProdsClient($clt );

        return view('pages.createCliProd', [
            'client'=>$client,
            'id'=>$request->id,
            'produits'=>$prods,
            'prodClient'=>$clientsProd,
            ]);

           
       /*  return view('pages.createCliProd',[
            'client'=>$client,
            'produits'=>$prods,
            'prodClient'=>$clientsProd,
            ]
        ); */
    }

    //validaion des champs
    private function gestValidation(Request $request){
        return  $request->validate(
            [
                'client'=>'required',
                'produit'=>'required',
            ]
        );
    }

    //liste des produits
    public function getProduits($id){
        $prods = DB::select('select * from cid_produits where id not in
         (select cid_produit_id from cid_produit_clients  where cid_client_id = :client)',['client'=>$id]);

         return $prods;
    }

    public function getProdsClient($id){
        $clientsProd = DB::select('select pr.id,c.client,c.nom,c.prenom,p.produit,pr.created_at from cid_clients c,cid_produits p,cid_produit_clients pr
        where p.id=pr.cid_produit_id and c.id=pr.cid_client_id and pr.cid_client_id = :id',
       ['id'=>$id]);

         return $clientsProd;
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }

}
