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
                  Formulaire de saisies des types de comptes
              </div>

              <div class="row py-2">

                
                     {{--    Modification du quartier --}}
          @if($typecpt->id)

          <form action="{{ route('typecpt.update',['id'=>$typecpt->id]) }}" method="POST">

              @csrf
              <div class="row">

                  <div class="col">
                      <div class="card align-self-end">
                          <div class="card-header text text-bold alert-dark">
                                          Modification type comptes
                          </div>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="code" class="form-label">Code opération</label>
                                  <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                  name="code" id="code" placeholder="Code opération" value="{{ old('code',$typecpt->code) }}">
                                  @error('code')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="libelle" class="form-label">Libellé</label>
                                  <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                  name="libelle" id="code" placeholder="Libellé" value="{{ old('libelle',$typecpt->libelle) }}">
                                  @error('libelle')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                <label for="classe" class="form-label">Classe</label>
                                <input type="text" class="form-control form-control-sm @error('classe') is-invalid @enderror"
                                name="classe" id="code" placeholder="classe de compte" value="{{ old('classe',$typecpt->classe) }}">
                                @error('classe')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>





                          </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('typecpt') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <button type="submit" class="btn btn-success btn-sm">Valider</button>
                          </div>

                      </div>
                  </div>


              </div>

          </form>

        @endif
 {{--  fin de la modifcation --}}

       @if(!$typecpt->id)

          <form action="{{ route('typecpt.store') }}" method="POST">
              @csrf
              <div class="row">

                  <div class="col">
                      <div class="card align-self-end">
                          <div class="card-header text text-bold alert-dark">
                                          Enregistrer type compte
                          </div>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="code" class="form-label">Code type compte</label>
                                  <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                  name="code" id="code" placeholder="Code opération" value="{{ old('code') }}">
                                  @error('code')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="libelle" class="form-label">Libellé</label>
                                  <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                  name="libelle" id="code" placeholder="Libellé" value="{{ old('libelle') }}">
                                  @error('libelle')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="mb-3">
                                <label for="classe" class="form-label">Classe</label>
                                <input type="text" class="form-control form-control-sm @error('classe') is-invalid @enderror"
                                name="classe" id="code" placeholder="classe de compte" value="{{ old('classe') }}">
                                @error('classe')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                          </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('typecpt') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <a href="{{ route('typecpt.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
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
