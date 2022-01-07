<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-3">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     @if (Session::has('add_msg'))
                        {!! Toastr::message() !!}
                     @endif

                 <div class="alert-info text text-2xl text-bold text-danger">
                     Formulaire de saisies des commissions
                 </div>

                 <div class="row py-2">
                                          {{--    Modification du quartier --}}
          @if($comm->id)

          <form action="{{ route('commission.update',['id'=>$comm->id]) }}" method="POST">

              @csrf
              <div class="row">

                  <div class="col">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header alert-dark">
                                          Modiication commission
                          </div>
                          <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="codetype" class="form-label">Code</label>
                                        <input type="text" class="form-control form-control-sm @error('codetype') is-invalid @enderror"
                                        name="codetype" id="codetype" placeholder="Code activite" value="{{ old('codetype',$comm->codetype) }}">
                                        @error('codetype')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="libelle" class="form-label">Libellé</label>
                                        <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                        name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle',$comm->libelle) }}">
                                        @error('libelle')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">                                      

                                        <label for="compte" class="form-label">Compte</label>
                                        <select  class="form-select form-select-sm @error('compte') is-invalid @enderror"
                                        name="compte" id="compte">
                                        <option value=""></option>
                                        @foreach($comptes as $compte)
                                          @if ($compte->compte == $comm->compte)
                                              <option value="{{ $compte->compte}}" {{ $compte->compte == $compte->compte ? "selected":"" }}>
                                                      {{ $compte->compte }}
                                              </option>
                                          @else
                                          <option value="{{ old('compte',$compte->compte)}}"
                                              {{old('compte') == $compte->compte ? "selected":""}}>
                                              {{ $compte->compte }}
                                          </option>
                                          @endif
                                        @endforeach
                                        </select>
                                        @error('compte')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="taux" class="form-label">Taux</label>
                                        <input type="number" class="form-control form-control-sm @error('taux') is-invalid @enderror"
                                        name="taux" id="taux" placeholder="Taux de la commission" value="{{ old('taux',$comm->taux) }}">
                                        @error('taux')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="mnt" class="form-label">Montant</label>
                                        <input type="number" class="form-control form-control-sm @error('mnt') is-invalid @enderror"
                                        name="mnt" id="mnt" placeholder="Montant de la commission" value="{{ old('mnt',$comm->mnt) }}">
                                        @error('mnt')
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
                                                @if ($comm->cid_periode->id == $periode->id)
                                                <option  value="{{old('periode',$comm->cid_periode->id )}}"
                                                    {{ $comm->cid_periode->id==$comm->cid_periode->id ? "selected":"" }}>
                                                    {{$comm->cid_periode->libelle }}
                                                </option>
                                            @else
                                                <option  value="{{old('periode',$periode->id) }}"
                                                    {{ old('periode')==$periode->id ? "selected":"" }}>
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
                              <a href="{{ route('commission') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <button type="submit" class="btn btn-success btn-sm">Valider</button>
                          </div>

                      </div>
                  </div>


              </div>

          </form>

        @endif
 {{--  fin de la modifcation --}}

       @if(!$comm->id)

          <form action="{{ route('commission.store') }}" method="POST">
              @csrf
              <div class="row">
                  <div class="col">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header alert-dark">
                                          Enregistrer commission
                          </div>
                          <div class="card-body">
                              <div class="row">
                                    <div class="col">
                                        <label for="codetype" class="form-label">Code type</label>
                                        <input type="text" class="form-control form-control-sm @error('codetype') is-invalid @enderror"
                                        name="codetype" id="codetype" placeholder="Code activite" value="{{ old('codetype') }}">
                                        @error('codetype')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="libelle" class="form-label">Libellé</label>
                                        <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                        name="libelle" id="code" placeholder="Libellé" value="{{ old('libelle') }}">
                                        @error('libelle')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                              </div>

                              <div class="row">
                                    <div class="col">
                                     
                                        <label for="compte" class="form-label">Compte</label>
                                        <select  class="form-select form-select-sm @error('compte') is-invalid @enderror"
                                        name="compte" id="compte">
                                        <option value=""></option>
                                        @foreach($comptes as $compte)
                                         
                                          <option value="{{ old('compte',$compte->compte)}}"
                                              {{old('compte') == $compte->compte ? "selected":""}}>
                                              {{ $compte->compte }}
                                          </option>
                                    
                                        @endforeach
                                        </select>
                                        @error('compte')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


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
                              </div>

                              <div class="row">
                                    <div class="col">
                                        <label for="mnt" class="form-label">Montant</label>
                                        <input type="number" class="form-control form-control-sm @error('mnt') is-invalid @enderror"
                                        name="mnt" id="mnt" placeholder="Montant de la commission" value="{{ old('mnt') }}">
                                        @error('mnt')
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
                                                <option  value="{{old('periode',$periode->id) }}"
                                                    {{ old('periode') == $periode->id ?"selected":"" }}>
                                                    {{ $periode->libelle}}
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
                              <a href="{{ route('commission') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <a href="{{ route('commission.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
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


    </div>



    </x-app-layout>
