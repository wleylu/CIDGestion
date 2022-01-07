<x-app-layout>
    @include('pages.partials.entete')


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                        overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                        @if (Session::has('add_prod'))
                             {!! Toastr::message() !!}
                        @endif


                        <div class="alert-info text text-2xl text-bold text-danger">
                            Formulaire de creation des comptes clients
                        </div>

                         <div class="align-self-center col-12 py-2">
                            <form action="{{ route('comptecli.show') }}" method="GET" id="fp">
                                {{--  <input type="text" value="{{ $codeClient }}" name="codeClient" hidden>  --}}
                                <div class="row">
                                    <div class="col-sm-4">
                                            <div class="card align-self-start">
                                                <div class="card-body">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="client" class="form-label">Veillez entrer le client</label>
                                                            <input type="text" class="form-control form-control-sm" name="client"
                                                            value="{{ old('client',$codeClient) }}">
                                                                @if ($clt->id)
                                                                    <table>
                                                                        <tr>
                                                                            <td> Client</td><td>: {{ $clt->client }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nom</td><td>: {{ $clt->nom }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Prénoms</td><td>: {{ $clt->prenom }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Téléphone</td><td>: {{ $clt->tel }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Adresse</td><td>: {{ $clt->adresse }} </td>
                                                                        </tr>
                                                                    </table>
                                                                @endif

                                                        </div>

                                                    </div>
                                               </div>
                                            </div>
                                     </div>
                            </form>

                                <div class="col-sm-8">
                                    <form action="{{ route('comptecli.store') }}" method="POST">
                                        @csrf
                                     @if ($clt->id)


                                            <input type="text" class="form-control form-control-sm" name="cli" id="cli"  hidden value="{{ old('cli',$clt->client) }}">
                                            <div class="card">
                                                <div class="card-header alert-dark">
                                                    Création de comptes client
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="agence" class="form-label">Agence</label>
                                                            <select class="form-select form-select-sm @error('agence') is-invalid @enderror" name="agence" id="agence" >
                                                                <option value="Bonoua">Bonoua</option>
                                                                <option value="{{ old('agence') }}" {{ (old('agence')== old('agence') ? "selected":"")}}>
                                                                    {{ old('agence') }}
                                                                </option>
                                                            </select>
                                                            @error('agence')
                                                            <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="col">
                                                            <label for="typeCpt" class="form-label">Type compte</label>
                                                            <select class="form-select form-select-sm @error('typeCpt') is-invalid @enderror" name="typeCpt">
                                                            @foreach ($typeCpt as $type)
                                                                <option value="{{ old('typeCpt',$type->id) }}">
                                                                    {{ $type->libelle }}
                                                                </option>
                                                            @endforeach

                                                            </select>

                                                            @error('typeCpt')
                                                            <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                        </div>

                                                    </div>

                                                    <div class="row justify-content-start">
                                                        <div class="col py-2">
                                                            <button type="submit" class="btn btn-sm btn- btn-success">Ajouter</button>
                                                        </div>


                                                </div>
                                                </div>
                                            </div>
                                            <div style="height: 10px"></div>
                                            <div class="card">
                                                <div class="card-header alert-dark">
                                                    Liste des comptes
                                                </div>
                                                    <div class="card-body">

                                                            <table class="table table-bordered table-responsive-lg">
                                                                    <thead class="alert alert-warning">
                                                                        <tr>
                                                                        <th>Compte</th><th>Nom</th><th>Rub</th><th>Libelle</th><th>Agence</th>
                                                                        <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>


                                                                                @forelse ($comptes as $compte)
                                                                                        <tr>
                                                                                            <td>
                                                                                                {{$compte->compte }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$compte->nom}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$compte->rubrique }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$compte->cid_type->libelle }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$compte->agence }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <a type="button" href="{{ route('comptecli.delete',['id'=>$compte->id]) }}" class="text-danger">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                                                    </svg>

                                                                                                  </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @empty
                                                                                        <tr>

                                                                                        </tr>
                                                                                    @endforelse
                                                                    </tbody>
                                                            </table>

                                                    </div>
                                            </div>

                                    @endif
                                </form>
                                </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
