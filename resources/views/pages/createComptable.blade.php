<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     <div class="text text-bold text-2xl text-danger alert-info">
                         Formulaire de pamétrage schéma comptable
                     </div>
                    @if(Session::has('add_msg'))
                         {!! Toastr::message() !!}
                    @endif

<div class="row py-2">
    <div class="col-sm-5">
                                 {{--    Modification du quartier --}}
        @if($comptable->id)

        <form action="{{ route('comptable.update',['id'=>$comptable->id]) }}" method="POST">

        @csrf
        <div class="row">

            <div class="col-sm-12">
                <div class="card align-self-end">
                    <div class="text text-bold card-header alert-dark">
                                    Modifier Schéma comptable
                    </div>
                    <div class="card-body">

                            <div class="col">
                                <label for="oper" class="form-label">Code opération</label>
                                <select name="oper" id="oper" class="form-select">
                                    @foreach ($codeOpers as  $cod)
                                        @if ($cod->id == $comptable->cid_code_oper->id)
                                            <option value="{{ old('oper',$comptable->cid_code_oper->id) }}"
                                                {{ $comptable->cid_code_oper->id == $comptable->cid_code_oper->id ? "selected":"" }}>
                                                {{ $comptable->cid_code_oper->libelle }}
                                            </option>
                                        @else
                                            <option value="{{ old('oper',$cod->id) }}" {{ old('oper') == old('oper')? "selectted":""}}>
                                                {{ old('oper',$cod->libelle )}}
                                            </option>
                                        @endif

                                    @endforeach
                                </select>
                                @error('oper')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="sens" class="form-label">Sens opération</label>
                                <select name="sens" id="sens" class="form-select">
                                       @if ($comptable->sens == 'D')
                                       <option value="{{ old('sens',$comptable->sens) }}"
                                        {{ $comptable->sens == $comptable->sens ? "selected":""}}>
                                            Débit
                                       </option>
                                       <option value="C">
                                        Crédit
                                         </option>
                                       @endif

                                       @if ($comptable->sens == 'C')
                                       <option value="{{ old('sens',$comptable->sens) }}"
                                        {{ $comptable->sens == $comptable->sens ? "selected":""}}>
                                        Crédit
                                       </option>
                                       <option value="D">
                                            Débit
                                        </option>
                                       @endif
                                </select>
                                @error('sens')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="libelle" class="form-label">Libellé</label>
                                <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle',$comptable->libelle) }}">
                                @error('libelle')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col">
                                <div class="row g-2">
                                    <div class="col">
                                      <label for="varMontant" class="form-label">Variable montant</label>
                                      <input type="text" class="form-control form-control-sm @error('varMontant') is-invalid @enderror"
                                      name="varMontant" id="varMontant" placeholder="Nom variable montant" value="{{ old('varMontant',$comptable->varmnt) }}">
                                      @error('varMontant')
                                          <div class="text-danger">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                    </div>

                                    <div class="col">
                                        <label for="variable" class="form-label">Nom variable</label>
                                        <input type="text" class="form-control form-control-sm @error('variable') is-invalid @enderror"
                                        name="variable" id="variable" placeholder="Nom de la varible de recherche" value="{{ old('variable',$comptable->variable) }}">
                                        @error('variable')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                              </div>


                            </div>
                    </div>

                    <div class=" card-footer text-right alert-warning">
                        <a href="{{ route('comptable') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                        <button type="submit" class="btn btn-success btn-sm">Valider</button>
                    </div>

                </div>
            </div>


        </div>



        </form>
    </div>
        @endif
    {{--  fin de la modifcation --}}

        @if(!$comptable->id)

            <form action="{{ route('comptable.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card align-self-end">
                            <div class="text text-bold card-header alert-dark">
                                            Enregistrer Schéma comptable
                            </div>
                            <div class="card-body">

                                    <div class="col">
                                        <label for="oper" class="form-label">Code opération</label>
                                        <select name="oper" id="oper" class="form-select">
                                            @foreach ($codeOpers as  $cod)
                                                <option value="{{ old('oper',$cod->id) }}" {{ old('oper') == old('oper')? "selectted":""}}>
                                                    {{ old('oper',$cod->libelle )}}
                                                </option>

                                            @endforeach
                                        </select>
                                        @error('oper')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="sens" class="form-label">Sens opération</label>
                                        <select name="sens" id="sens" class="form-select">
                                                <option value="D">
                                                    Débit
                                                </option>
                                                <option value="C">
                                                    Crédit
                                            </option>

                                        </select>
                                        @error('sens')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="libelle" class="form-label">Libellé</label>
                                        <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                                        name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle') }}">
                                        @error('libelle')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <div class="row g-2">
                                            <div class="col">
                                            <label for="varMontant" class="form-label">Variable montant</label>
                                            <input type="text" class="form-control form-control-sm @error('varMontant') is-invalid @enderror"
                                            name="varMontant" id="varMontant" placeholder="Nom variable montant" value="{{ old('varMontant') }}">
                                            @error('varMontant')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>

                                            <div class="col">
                                            <label for="variable" class="form-label">Nom variable compte</label>
                                            <input type="text" class="form-control form-control-sm @error('variable') is-invalid @enderror"
                                            name="variable" id="variable" placeholder="Nom de la varible de recherche" value="{{ old('variable') }}">
                                            @error('variable')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>

                                    </div>

                            </div>

                            <div class=" card-footer text-right alert-warning">
                                <a href="{{ route('comptable') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                                <a href="{{ route('comptable.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
                @endif

                {{-- kone --}}


            <div class="col">

                <div class="row">
                    <div class="col">
                        <table  class=" py-1 table table-striped table-bordered table-responsive" style="width:100%">
                            <thead class="alert alert-secondary">
                                <tr>
                                    <th>Oper</th>
                                    <th>Sens</th>
                                    <th>Libellé Oper</th>
                                    <th>Cpt Variable</th>
                                    <th>MNT variable</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comptas as $compta)
                                    <tr>
                                        <td>{{ $compta->oper }}</td>
                                        <td>{{ $compta->sens }}</td>
                                        <td>{{ $compta->libelle }}</td>
                                        <td>{{ $compta->variable }}</td>
                                        <td>{{ $compta->varmnt}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>

</div>


                    </div>
                </div>
            </div>
        </div>


    </div>



    </x-app-layout>
