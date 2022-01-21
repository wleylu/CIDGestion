<?php

namespace App\Http\Controllers;


use PDF;
use App\Models\CidClient;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;

class FicheClientContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // dd('ICI');
      // PDF::setOptions(['dpi'=>'150','defaultFont'=>'sans-serif']);
       $pdf = PDF::loadView('pages.fichclient');

       return $pdf->download('client.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // dd('ICI');
       //PDF::setOptions(['dpi'=>'150','defaultFont'=>'sans-serif']);
       //$pdf = PDF::loadView('pages.fichclient');

       //return $pdf->download('client.pdf');
       return view('pages.fichclient');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function edit(CidClient $cidClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CidClient  $cidClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CidClient $cidClient)
    {
        //
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
}
