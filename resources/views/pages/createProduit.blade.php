<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     @if (Session::has('add_msg'))
                     {!! Toastr::message() !!}
                 @endif
     
                 <div class="alert-info justify-content-lg-center text text-danger text-bold text-2xl">
                     Formulaire de saisies des produits
                 </div>

                 <div class="row py-2">
                                     {{--    Modification du quartier --}}
          @if($produit->id)

          <form action="{{ route('produit.update',['id'=>$produit->id]) }}" method="POST">

              @csrf
              <div class="row">
                
                  <div class="col">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header  alert-dark">
                                          Modification commission
                          </div>
                          <div class="card-body">
                              <div class="card-body">
                                  <div class="row g-2">
                                    <div class="col">
                                        <label for="code" class="form-label">Code type</label>
                                        <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                        name="code" id="code" placeholder="Code activite" value="{{ old('code',$produit->codeProd) }}">
                                        @error('code')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
  
                                    <div class="col">
                                        <label for="produit" class="form-label">Produit</label>
                                        <input type="text" class="form-control form-control-sm @error('produit') is-invalid @enderror"
                                        name="produit" id="produit" placeholder="Libellé du produit" value="{{ old('produit',$produit->produit) }}">
                                        @error('produit')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                  </div>
                                
                                  <div class="row g-2">
                                    <div class="col">
                                        <label for="taux" class="form-label">Taux</label>
                                        <input type="number" class="form-control form-control-sm @error('taux') is-invalid @enderror"
                                        name="taux" id="taux" placeholder="Taux de la commission" value="{{ old('taux',$produit->taux) }}">
                                        @error('taux')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
  
                                    <div class="col">
                                        <label for="montant" class="form-label">Montant</label>
                                        <input type="number" class="form-control form-control-sm @error('montant') is-invalid @enderror"
                                        name="montant" id="taux" placeholder="Montant de la commission" value="{{ old('montant',$produit->commission) }}">
                                        @error('montant')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
  
                                  </div>
                                  
                                  <div class="row g-2">

                                    <div class="col">
                                        <label for="commission" class="form-label">Commission</label>
                                        <select class="form-select form-select-sm" aria-label="Selectionner la comission" name="commission">
                                            @foreach ( $commissions as $com )
                                                @if($com->id == $produit->cid_commission->id)
                                                    <option value="{{ old('commission',$produit->cid_commission->id) }}"
                                                        {{ $produit->cid_commission->id == $produit->cid_commission->id ? "selected":"" }}>
                                                        {{ $produit->cid_commission->libelle }}
                                                    </option>
                                                @else
                                                <option value="{{old('commission',$com->id) }}">
                                                    {{old('commission',$com->libelle) }}
                                                </option>
                                                @endif
                                            @endforeach
                                          </select>
                                        @error('commission')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
  
                                    <div class="col">
                                        <label for="periode" class="form-label">Période</label>
                                        <select class="form-select form-select-sm" aria-label="Selectionner la période" name="periode">
                                            <option selected></option>
                                            @foreach ($periodes as $periode)
                                                @if($periode->id == $produit->cid_periode->id)
                                                    <option value="{{ old('periode',$produit->cid_periode->id) }}"
                                                        {{ $produit->cid_periode->id == $produit->cid_periode->id ? "selected":""}}>
                                                        {{ $produit->cid_periode->libelle }}
                                                    </option>
                                                @else
                                                    <option value="{{ old('periode', $periode->id) }}">
                                                        {{ old('periode',$periode->libelle) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                          </select>
                                        @error('periode')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                  </div>

                                 

                              </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('produit') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <button type="button" class="btn btn-primary btn-sm ">Annuler</button>
                              <button type="submit" class="btn btn-success btn-sm">Valider</button>
                          </div>

                      </div>
                  </div>


              </div>

          </form>

        @endif
 {{--  fin de la modifcation --}}

       @if(!$produit->id)

          <form action="{{ route('produit.store') }}" method="POST">
              @csrf
              <div class="row">
                  
                  <div class="col">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header alert-dark">
                                          Enregistrer produit
                          </div>
                          <div class="card-body">
                              <div class="row">
                                <div class="col">
                                    <label for="code" class="form-label">Code type</label>
                                    <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                    name="code" id="code" placeholder="Code activite" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
  
                                <div class="col">
                                    <label for="produit" class="form-label">Produit</label>
                                    <input type="text" class="form-control form-control-sm @error('produit') is-invalid @enderror"
                                    name="produit" id="produit" placeholder="Libellé du produit" value="{{ old('produit') }}">
                                    @error('produit')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              </div>
                             
                              <div class="row">
                                <div class="col">
                                    <label for="taux" class="form-label">Taux</label>
                                    <input type="number" class="form-control form-control-sm @error('taux') is-invalid @enderror"
                                    name="taux" id="taux" placeholder="Taux de la commission" value="{{ old('taux') }}">
                                    @error('taux')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
  
                                <div class="col">
                                    <label for="montant" class="form-label">Montant</label>
                                    <input type="number" class="form-control form-control-sm @error('montant') is-invalid @enderror"
                                    name="montant" id="taux" placeholder="Montant de la commission" value="{{ old('montant') }}">
                                    @error('montant')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              </div>
                             
                              <div class="row">
                                <div class="col">
                                    <label for="commission" class="form-label">Commission</label>
                                    <select class="form-select form-select-sm" aria-label="Selectionner la comission" 
                                    name="commission" id="commission">
                                    <option selected></option>  
                                        @foreach ( $commissions as $com )
                                            <option value="{{old('commission',$com->id) }}" 
                                                {{ old('commission') == $com->id ? "selected":""}}>
                                                {{ $com->libelle }}
                                            </option>
                                        @endforeach                                      
                                      </select>
                                    @error('commission')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
  
                                <div class="col">
                                    <label for="periode" class="form-label">Période</label>
                                    <select class="form-select form-select-sm" aria-label="Selectionner la période" name="periode">
                                        <option value=""></option>
                                        @foreach ($periodes as $periode)
                                            <option value="{{ old('periode', $periode->id) }}" 
                                                {{ old('periode') == $periode->id  ? "selected":""}}>
                                                {{$periode->libelle }}
                                            </option>
                                        @endforeach
                                      </select>
                                    @error('periode')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              </div>
                              
                          </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('produit') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <a href="{{ route('produit.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
                              <button type="submit" class="btn btn-success btn-sm">Valider</button>
                          </div>

                      </div>
                  </div>


              </div>

          </form>
      @endif

                 </div>
         

                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('add_msg'))
            {!! Toastr::message() !!}
        @endif

    </div>



    </x-app-layout>
