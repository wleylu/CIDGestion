<?php

namespace App\Http\Controllers;

use App\Models\CidQuartier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class QuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        $this->gestVarSession();
        $quartiers = CidQuartier::all();

     return view('/pages.quartier',compact('quartiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->gestVarSession();
        $quartier = new CidQuartier();
        return view('pages.createQuartier',compact('quartier'));
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

         $validated = $request->validate([
            'libelle' => 'required|unique:cid_quartiers|max:255',
            'description' => 'required',
        ]);

        $quartier =
            [
                'libelle'=>$request->input('libelle'),
                'description'=>$request->input('description'),
                'pays'=>$request->input('pays'),
                'ville'=>$request->input('ville'),
                'loginAdd'=>$request->user()->email,
                'loginUpd'=>$request->user()->email,
            ];

          if (CidQuartier::create($quartier))
          {
              session(['add_msg'=>'Ajout quartier']);
              Toastr::success('Enregistrement effectué avec succès');
          }
          else{
            session(['add_msg'=>'Ajout quartier']);
            Toastr::error('Echec, enregistrement non effectué');
          }

            $quartier = new CidQuartier();
            return view('/pages.createQuartier',compact('quartier'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->gestVarSession();
        $quartier= CidQuartier::find($id);

        return view('pages.createQuartier',compact('quartier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->gestVarSession();
        $quartier= CidQuartier::find($id);
        $quartiers=[
            'libelle'=>$request->input('libelle'),
            'description'=>$request->input('description'),
            'pays'=>$request->input('pays'),
            'ville'=>$request->input('ville'),
            'loginUpd'=>$request->user()->email,
        ];

        if ($quartier->update($quartiers))
        {
            session(['update_msg'=>'Modifier quartier']);
            Toastr::success('Modification effectué avec succès');

        }



        $quartiers = CidQuartier::all();

        /* return redirect('/quartier')->$quartier; */
        return view ('/pages.quartier',compact('quartiers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gestVarSession();
        $quartier= CidQuartier::findOrfail($id);
        $quartier->delete();
        $quartiers = CidQuartier::all();

        return view ('/pages.quartier',compact('quartiers'));
    }

    private  function gestVarSession(){
        session()->forget('add_msg');
        session()->forget('update_msg');
    }
}
