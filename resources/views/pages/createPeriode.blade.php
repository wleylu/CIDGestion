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
                Formulaire de saisies des périodes
            </div>

            <div class="row py-2">
                                   {{--    Modification du quartier --}}
          @if($periode->id)

          <form action="{{ route('periode.update',['id'=>$periode->id]) }}" method="POST">

              @csrf
              <div class="row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-6">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header alert-dark">
                                          Modification commission
                          </div>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="codeCom" class="form-label">Code opération</label>
                                  <input type="text" class="form-control form-control-sm @error('codeCom') is-invalid @enderror"
                                  name="codeCom" id="codeCom" placeholder="Code opération" value="{{ old('codeCom',$periode->codeCom) }}">
                                  @error('codeCom')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="libelle" class="form-label">Libellé</label>
                                  <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                  name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle',$periode->libelle) }}">
                                  @error('libelle')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>


                          </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('periode') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <button type="button" class="btn btn-primary btn-sm ">Annuler</button>
                              <button type="submit" class="btn btn-success btn-sm">Valider</button>
                          </div>

                      </div>
                  </div>


              </div>

          </form>

        @endif
 {{--  fin de la modifcation --}}

       @if(!$periode->id)

          <form action="{{ route('periode.store') }}" method="POST">
              @csrf
              <div class="row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-6">
                      <div class="card align-self-end">
                          <div class="text text-bold card-header alert-dark">
                                          Enregistrer période
                          </div>
                          <div class="card-body">
                              <div class="mb-3">
                                  <label for="codeCom" class="form-label">Code </label>
                                  <input type="text" class="form-control form-control-sm @error('codeCom') is-invalid @enderror"
                                  name="codeCom" id="codeCom" placeholder="Code opération" value="{{ old('codeCom') }}">
                                  @error('codeCom')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="libelle" class="form-label">Libellé</label>
                                  <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                  name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle') }}">
                                  @error('libelle')
                                      <div class="text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>

                          </div>

                          <div class=" card-footer text-right alert-warning">
                              <a href="{{ route('periode') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                              <a href="{{ route('periode.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
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
