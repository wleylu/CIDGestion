<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     <div class="alert-info justify-content-lg-center text text-danger text-bold text-2xl">
                        Formulaire de saisies quartiers
                    </div>
                    @if(Session::has('add_msg'))
                         {!! Toastr::message() !!}
                    @endif

<div class="row py-2">
    @if($quartier->id)

    <form action="{{ route('quartier.update',['id'=>$quartier->id]) }}" method="POST">

        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="card align-self-end">
                    <div class="text text-dark text-bold card-header alert-dark">
                                    Modifier quartier
                    </div>

                    <div class="card-body">
                                    @csrf
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libellé</label>
                                <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                name="libelle" id="libelle" placeholder="Nom du quartier" value="{{ old('libelle',$quartier->libelle) }}">
                                @error('libelle')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description"  class="form-label">Description</label>
                                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                name="description" id="description" rows="2">{{ old('description',$quartier->description)}}</textarea>
                                @error('description')
                                <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="pays" class="form-label">Pays</label>
                                <select class="form-select form-select-sm" name="pays" aria-label="Default select example">

                                    <option selected>Sélectionnez le pays</option>
                                    <option value="Côte d'Ivoire">Côte d Ivoire</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Burkina-Faso">Burkina-Faso</option>
                                    <option value="{{old('pays',$quartier->pays) }}" {{ ($quartier->pays== $quartier->pays? "selected":"") }}>
                                        {{ old('pays',$quartier->pays) }}</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville</label>
                                <select class="form-select form-select-sm" name="ville" aria-label="Default select example">
                                    <option selected></option>
                                    <option value="Bonoua">Bonoua</option>
                                    <option value="Abidjan">Abidjan</option>
                                    <option value="Bouake">Bouake</option>
                                    <option value="{{old('ville',$quartier->ville) }}" {{ ($quartier->ville== $quartier->ville? "selected":"") }}>
                                        {{ old('ville',$quartier->ville) }}</option>
                                </select>
                            </div>

                    </div>

                    <div class=" card-footer text-right alert-warning">
                        <a href="{{ route('quartier') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                        <button type="submit" class="btn btn-success btn-sm">Valider</button>
                    </div>
                </div>
            </div>

        </div>

    </form>

  @endif
{{--  fin de la modifcation --}}

 @if(!$quartier->id)

    <form action="{{ route('quartier.store') }}" method="POST">

        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                    <div class="card align-self-end">
                        <div class="text text-dark text-bold card-header alert-dark">
                                        Ajouter quartier
                        </div>

                        <div class="card-body">
                                        @csrf
                                            <div class="mb-3">
                                                <label for="libelle" class="form-label">Libellé</label>
                                                <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                                name="libelle" id="libelle" placeholder="Nom du quartier" value="{{ old('libelle') }}">
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
                                            <div class="mb-3">
                                                <label for="pays" class="form-label">Pays</label>
                                                <select class="form-select form-select-sm" name="pays" aria-label="Default select example">

                                                    <option selected>Sélectionnez le pays</option>
                                                    <option value="Côte d'Ivoire">Côte d Ivoire</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Burkina-Faso">Burkina-Faso</option>
                                                    <option value="{{old('pays') }}" {{ (old("pays") == old("pays") ? "selected":"") }}>{{ old("pays") }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ville" class="form-label">Ville</label>
                                                <select class="form-select form-select-sm" name="ville" aria-label="Default select example">
                                                    <option selected>Sélectionnez la ville</option>
                                                    <option value="Bonoua">Bonoua</option>
                                                    <option value="Abidjan">Abidjan</option>
                                                    <option value="Bouake">Bouake</option>
                                                    <option value="{{old('ville') }}" {{ (old("ville") == old("ville") ? "selected":"") }}>{{ old("ville") }}</option>
                                                </select>
                                            </div>

                                    </div>

                                    <div class=" card-footer text-right alert-warning">
                                        <a href="{{ route('quartier') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                                        <a href="{{ route('quartier.create') }}"  class="btn btn-danger btn-sm">Annuler</a>
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
