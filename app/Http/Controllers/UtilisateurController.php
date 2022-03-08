<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CidType;
use App\Models\CidClient;
use App\Models\CidActivite;
use App\Models\CidQuartier;
use Illuminate\Support\Str;
use App\Models\CidSituation;
use Illuminate\Http\Request;
use App\Models\CidNaturePiece;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;


class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        $users = User::all();

        return view('/pages.utilisateurs',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {
        $this->gestVarSession();

       $client = new CidClient();
       $request->session()->forget('update_msg');
       $request->session()->forget('add_msg');

        return view('pages.createClient',[
            'client'=>$client,
            'quartiers'=>CidQuartier::all(),
            'activites'=>CidActivite::all(),
            'situations'=>CidSituation::all(),
            'natures'=>CidNaturePiece::all(),
            'codeClient'=>null,
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
       // dd($request->input('typeClient'));
          $this->gestVarSession();

          $validated = $this->gestValidation($request,0);
          $clt = CidClient::where('client',$request->input('codeClient'))->first();

           $code = $this->getCodeClient($request->input('typeClient'));
          // dd($code);
          if($clt != null){
            session(['add_msg'=>'Client enregistré avec succès']);
            Toastr::warning('Client existe dans la base');

            return view('/pages.createClient',[
            'client'=>new CidClient,
            'quartiers'=>CidQuartier::all(),
            'activites'=>CidActivite::all(),
            'situations'=>CidSituation::all(),
            'natures'=>CidNaturePiece::all(),
            'codeClient'=>$code,

            ]);
          }


               //$filename=Storage::disk('public')->put('Images',$request->file('photo'));
               if($request->file('photo') != null){
                    $name=$code.'.'.$request->file('photo')->extension();
                    $filename=$request->file('photo')->storeAs(
                        'Images',
                        $name,
                        'public'
                    );
               }

               else{
                $filename =null;
               }

               if ($request->file('psignature') != null){
                    $sign='sign'.$code.'.'.$request->file('psignature')->extension();
                    $filesign=$request->file('psignature')->storeAs(
                        'Images',
                        $sign,
                        'public'
                    );
               } else {$filesign=null;}



       $clientAdd = new CidClient([
           'client'=>$code,
           'nom'=>Str::upper($request->input('nom')),
           'typeClient'=>$request->typeClient,
           'prenom'=>Str::upper($request->input('prenom')),
           'email'=>Str::lower($request->input('email')),
           'dateouv'=>$request->input('datouv'),
           'datesign'=>$request->input('signature'),
           'datenaiss'=>$request->input('naiss'),
           'pere'=>Str::upper($request->input('pere')),
           'adrpost'=>Str::upper($request->input('adrpost')),
           'mere'=>Str::upper($request->input('mere')),
           'numpiece'=>Str::upper($request->input('numpiece')),
           'tel'=>$request->input('telephone'),
           'adrgeo'=>Str::upper($request->input('adrgeo')),
           'cid_quartier_id'=>$request->input('quartier'),
           'cid_activite_id'=>$request->input('secActivite'),
           'cid_situation_id'=>$request->input('situ'),
           'cid_nature_piece_id'=>$request->input('nature'),
           'loginAdd'=>$request->user()->email,
           'loginUpd'=>$request->user()->email,
           'photo'=>$filename,
           'sign'=>$filesign,
           'user_id'=>$request->user()->id,

        ]);

      //  dd($clientAdd);

        if (!$clientAdd->save())
        {
            Storage::disk('public')->delete($filename);
            Storage::disk('public')->delete($filesign);
            Toastr::error('Enregistrelent non effectué');
        }
        else{
            session(['add_msg'=>'Client enregistré avec succès']);
            Toastr::success('Client '.$code.' Enregistré avec succès');
        }

        return view('/pages.createClient',[
        'client'=>new CidClient,
        'quartiers'=>CidQuartier::all(),
        'activites'=>CidActivite::all(),
        'situations'=>CidSituation::all(),
        'natures'=>CidNaturePiece::all(),
        'codeClient'=>$code,

        ]);
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

    private function getCodeClient($typecpt)
    {

          $prifix = null;
          $validClient= null;
          $class = 0;
          switch($typecpt)
          {
                case 'Client':
                    $class = 4;
                    break;
                case 'Interne':
                    $class = 57;
                    break;
                case 'Banque':
                    $class = 5;
                    break;
                default:
                $class = 4;
          }
           //$class='40';

        // $class=CidType::find($typecpt)->value('classe');

          if(Str::length($class) <2){
            $prifix =$class.'0';
          }
          else{$prifix =$class;}

          $varclient = (Carbon::now()->format('d')*(Carbon::now()->format('h')+1)*(Carbon::now()->format('i')+2)*
                       (Carbon::now()->format('s')+1))/0.5;



         $client = $prifix.substr(intval($varclient),0,4);

         $client= $this->validClient($client);

         $test = false;
        while(!$test){
           // dd($test);
            $codClt = CidClient::where('client',$client)->first();
            if ($codClt == null){
                $test= true;
                $validClient=$client;
               // dd('ici 1 '.$client);
            }
            else
            {

                $client= $this->getIncrClient($client);
                $test= false;

            }
        }

        return Str::length($validClient)>6 ? substr(Str::length($validClient),0,5) : $validClient;
    }

    private function validClient($client){
        $cptvalide=null;
        $tail = 0;
        $test = false;
        if (Str::length($client)>6){
            $cptvalide = substr($client,0,5);
        }
        else{
            while(!$test){
                $cptvalide=$client.'0';
                $tailles= Str::length($cptvalide);
                 if ($tailles<6)
                 {
                    $test = false;
                 }
                 else{
                    $cptvalide=$client;
                    $test = true;
                 }

            }
        }

        return Str::length($cptvalide)>6 ? substr($cptvalide,0,5) : $cptvalide;

    }

    private function getIncrClient($client){
        $codeI = substr($client,4,5)+5;
        $retour=0;
        if (Str::length($codeI)>1){
            $retour = substr($client,0,4).substr($codeI,0,1);
        }
        else{
            $retour = substr($client,0,4).$codeI;
        }

        return $retour;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->gestVarSession();

        $client = CidClient::findOrfail($id);
       // dd($client->client);

        return view ('pages.createClient',([
            'client'=>$client,
            'quartiers'=>CidQuartier::all(),
            'activites'=>CidActivite::all(),
            'codeClient'=>$client->client,
            'situations'=>CidSituation::all(),
            'natures'=>CidNaturePiece::all(),
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

        $this->gestVarSession();

        $validated = $this->gestValidation($request,1);

        $client = CidClient::find($id);

       // dd( $client);

        if($client)
        {
                 if($request->file('photo')){
                            $name=$request->input('codeClient').'.'.$request->file('photo')->extension();
                            $filename=$request->file('photo')->storeAs(
                                'Images',
                                $name,
                                'public'
                            );
                         }

                    else{
                        $filename =$client->photo;
                    }

                    if ($request->file('psignature')){
                            $sign='sign'.$request->input('codeClient').'.'.$request->file('psignature')->extension();
                            $filesign=$request->file('psignature')->storeAs(
                                'Images',
                                $sign,
                                'public'
                            );
                    } else {$filesign=$client->sign;}



            $clientAdd = [
                'client'=>$request->input('codeClient'),
                'nom'=>Str::upper($request->input('nom')),
                'prenom'=>Str::upper($request->input('prenom')),
                'email'=>Str::lower($request->input('email')),
                'dateouv'=>$request->input('datouv'),
                'datesign'=>$request->input('signature'),
                'datenaiss'=>$request->input('naiss'),
                'pere'=>Str::upper($request->input('pere')),
                'adrpost'=>Str::upper($request->input('adrpost')),
                'mere'=>Str::upper($request->input('mere')),
                'numpiece'=>Str::upper($request->input('numpiece')),
                'tel'=>$request->input('telephone'),
                'adrgeo'=>Str::upper($request->input('adrgeo')),
                'cid_quartier_id'=>$request->input('quartier'),
                'cid_activite_id'=>$request->input('secActivite'),
                'cid_situation_id'=>$request->input('situ'),
                'cid_nature_piece_id'=>$request->input('nature'),
                'loginAdd'=>$request->user()->email,
                'loginUpd'=>$request->user()->email,
                'photo'=>$filename,
                'sign'=>$filesign,
                'typeClient'=>$request->input('typeClient'),
                ];



                if (!$client->update($clientAdd))
                {
                    Storage::disk('public')->delete($filename);
                    Storage::disk('public')->delete($filesign);
                    Toastr::error('Echec de l\'enregistrement');
                }
                else{

                    session(['update_msg'=>'OUI']);
                    Toastr::success('Modification effectuée avec succès');
                 //   dd('ici');
                }


        }

        else
        {

            session(['update_msg'=>'Erreur de traitement client inexistant']);
            Toastr::warning('Client inexistant dans la base');

        }


        return redirect()->route('client',([
            'clients'=>CidClient::all()
        ]));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(CidClient $cidClient)
    {
        //
    }

    private function gestValidation(Request $request,$type){

        if ($type == 0){
            return  $request->validate(
                [
                    'nom'=>'required|min:2|max:150',
                    'prenom'=>'required|min:5|max:150',
                    'pere'=>'required',
                     'mere'=>'required',
                    'situ'=>'required',
                    'nature'=>'required',
                   'numpiece'=>'required',
                    'telephone'=>'required',
                    'quartier'=>'required',
                    'secActivite'=>'required',
                    'datouv'=>'required',
                    'naiss'=>'required',
                    'email'=>'email',
                    'adrgeo'=>'required',
                    'typeClient'=>'required',
                ]
            );
        }

        if ($type == 1){
            return  $request->validate(
                [
                    'nom'=>'required|min:2|max:150',
                    'prenom'=>'required|min:5|max:150',
                    'pere'=>'required',
                     'mere'=>'required',
                    'situ'=>'required',
                    'nature'=>'required',
                   'numpiece'=>'required',
                    'telephone'=>'required',
                    'quartier'=>'required',
                    'secActivite'=>'required',
                    'datouv'=>'required',
                    'naiss'=>'required',
                    'email'=>'email',
                     'adrgeo'=>'required',

                ]
            );
        }


    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
