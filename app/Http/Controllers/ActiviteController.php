<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\CidActivite;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gestVarSession();
        $activites = CidActivite::all();
        return view('/pages.activite',compact('activites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->gestVarSession();
         $activite = new CidActivite();
        return view('pages.createActivite',compact('activite'));
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
        $this->gestVarSession();
        $validated = $this->validateForm($request);

        $quartier =
            [
                'code'=>$request->input('code'),
                'libelle'=>$request->input('libelle'),
                'description'=>$request->input('description'),
                'loginAdd'=>$request->user()->email,
                'loginUpd'=>$request->user()->email
            ];
        if (CidActivite::create($quartier)){
            session(['add_msg'=>"Ajout activité"]);
            Toastr::success("Enregistrement effectué avec succès");
        }
        else
        {
            session(['add_msg'=>"Erreur ajoout activité"]);
            Toastr::error("Enregistrement non effectué");
        }

            //$activites = CidActivite::all();
            $activite = new CidActivite();
            return view('/pages.createActivite',compact('activite'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function show(Activite $activite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->gestVarSession();
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
        $this->gestVarSession();
        $activite= CidActivite::findOrfail($id);
        $activite->delete();
        $activites = CidActivite::all();

        return view ('/pages.activite',compact('activites'));
    }

    private function validateForm($request){
       return  $request->validate([
            'code'=> 'required',
            'libelle' => 'required',
            'description' => 'required',
        ]);
    }

    private function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
