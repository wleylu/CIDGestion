<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     <div class="alert-info justify-content-lg-center text text-danger text-bold text-2xl">
                        Formulaire de saisies des activités
                    </div>

                    @if(Session::has('add_msg'))
                       {!! Toastr::message() !!}
                    @endif
                      {{--    Modification du quartier --}}
     <div class="row py-2">

        @if($activite->id)

        <form action="{{ route('activite.update',['id'=>$activite->id]) }}" method="POST">

            <div class="row">

                <div class="col">
                    <div class="card align-self-end">
                        <div class="text text-bold card-header alert-dark">
                                       Modifier activité
                        </div>

                        <div class="card-body">
                                        @csrf
                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                    name="code" id="code" placeholder="Code activite" value="{{ old('code',$activite->code) }}">
                                    @error('code')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="libelle" class="form-label">Libellé</label>
                                    <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                    name="libelle" id="libelle" placeholder="Libellé activite" value="{{ old('libelle',$activite->libelle) }}">
                                    @error('libelle')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description"  class="form-label">Description</label>
                                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                    name="description" id="description" rows="2">{{ old('description',$activite->description)}}</textarea>
                                    @error('description')
                                    <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                        </div>

                        <div class=" card-footer text-right alert-warning">
                            <a href="{{ route('activite') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                            <button type="submit" class="btn btn-success btn-sm">Valider</button>
                        </div>
                    </div>
                </div>

            </div>

        </form>

      @endif
{{--  fin de la modifcation --}}

     @if(!$activite->id)

        <form action="{{ route('activite.store') }}" method="POST">

            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                        <div class="card align-self-end">
                            <div class="text text-bold text-dark card-header alert-dark">
                                            Ajouter activité
                            </div>

                            <div class="card-body">
                                @csrf

                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                    name="code" id="code" placeholder="Code activite" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="libelle" class="form-label">Libellé</label>
                                    <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                    name="libelle" id="libelle" placeholder="Libellé activite" value="{{ old('libelle') }}">
                                    @error('libelle')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description"  class="form-label">Description</label>
                                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                    name="description" id="description" rows="2">{{ old('description')}}</textarea>
                                    @error('description')
                                    <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                            </div>

                            <div class=" card-footer text-right alert-warning">
                                <a href="{{ route('activite') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                                <a href="{{ route('activite.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
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
