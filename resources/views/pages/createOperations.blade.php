<x-app-layout>
    @include('pages.partials.entete')

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div lass="align-middle inline-block min-w-full shadow
                 overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
              {{--    contenu de la pages  --}}
                {{--  afficher les information du client  --}}
                @if (Session::has('add_msg'))
                    {!! Toastr::message() !!}
                @endif

                <div class="alert alert-info justify-content-lg-center text text-danger text-bold text-2xl">
                    Formulaire de saisies des opérations
                </div>

                 <div class="row">

                        <div class="col-sm-4">
                                <form action="{{ route('operation.show') }}" method="GET">
                                    @csrf
                                    <div class="card">
                                        <div class="card-header text text-danger text-bold">Informations client</div>

                                        <div class="row g-3 card-title py-4">
                                                <label for="client" class="col-sm-2 col-form-label">Client</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                    value="{{ old('client',$curentClient) }}" id="client" name="client">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button type="submit" class="btn btn-info btn-sm">Recherceher</button>
                                                </div>
                                                <span class="text text-danger"><hr></span>
                                        </div>

                                        @if ($client->client)
                                        <div class="card-body py-0">
                                                <table>
                                                    <tr>
                                                        <td>Client</td><td class="text text-bold text-primary">
                                                            <span class="text text-bold text-danger">:  </span>{{ $client->client }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nom</td><td class="text text-bold text-primary">:  {{ $client->nom }}</td>
                                                        <tr>
                                                            <td>Prénoms</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->prenom }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date Ouv.</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->dateouv }}</td>
                                                        </tr>
                                                      {{--    <tr>
                                                            <td>Solde</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->solde }}</td>
                                                        </tr>  --}}
                                                        <tr>
                                                            <td>Téléphone</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->tel }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Type pièce</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->cid_nature_piece->nature }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>N° Pièce</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->numpiece }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Père</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->pere }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mère</td><td class="text text-bold text-primary">
                                                                <span class="text text-bold text-danger">:  </span>{{ $client->mere }}</td>
                                                        </tr>
                                                </table>


                                        </div>
                                    </div>
                                    @endif
                                    {{--   <div class="card-footer">
                                        pied de card
                                    </div>  --}}
                            </form>
                        </div>

                    {{--  fi nafficher les information du client  --}}
                    {{--   les operations des clients  --}}
                    @if ($client->client)

                        <div class="col-sm-8">
                            <form action="{{route('operation.store')}}" method="POST" id="formOper">
                                @csrf
                                <input type="text" class="form-control form-control-sm"
                                value="{{ old('client',$client->client) }}" id="client" name="client" hidden>
                                <div class="card row">
                                    <div class="card-header text text-danger text-bold">
                                        Saisie opérations
                                    </div>
                                    <div class="card-body">
                                        <div class="row flex">
                                            <div class="col px-1">
                                                <label for="oper" class="form-label">Code opération</label>
                                                <select class="form-select form-select-sm @error('oper') is-invalid @enderror"
                                                name="oper" id="oper" onChange="afficherAutre()">
                                                     <option value=""></option>
                                                        @foreach ($typeopers as $oper)
                                                            <option value="{{ old('oper',$oper->oper) }}"
                                                                {{ old('oper') == $oper->oper ? "selected":"" }}>
                                                                {{ $oper->libelle }}
                                                            </option>
                                                        @endforeach
                                                </select>
                                                @error('oper')
                                                    <div class="text text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col px-1" id="cptvire"  style="display: none;">
                                                <label for="compte" class="form-label">Virement bancaire</label>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                name="compte" id="compte">
                                                <option selected></option>
                                                @foreach ($comptes as $cpt)
                                                    <option value="{{ old('compte',$cpt->id) }}"
                                                        {{ old('compte') == $cpt->id ? "selected":"" }}>
                                                        {{ $cpt->compte }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col px-1">
                                                <label for="montant" class="form-label">Montant</label>
                                                <input type="number" name="montant" id="montant" class="form-control form-control-sm
                                                @error('montant') is-invalid @enderror"
                                                value="{{ old('montant') }}">
                                                @error('montant')
                                                <div class="text text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                                name="description" id="description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="text text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                                <div class="col justify-content-md-end">
                                                    <div class="row" style="height: 30px;"></div>
                                                    <button type="submit" class="btn btn-success btn-sm float-end ">Valider</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                               <div class="row py-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                     <img src="{{ Storage::url($client->photo) }}" style="width: 150px; height: 80px;"
                                                     class="img-thumbnail" />
                                                </div>
                                                <div class="col">
                                                      <img src="{{ Storage::url($client->sign) }}" style="width: 150px; height: 80px;"
                                                      class="img-thumbnail"  />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                               </div>




                            </form>

                        </div>
                    @endif

                </div>

              {{--    contenu de la pages  --}}
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    function afficherAutre() {
       var a = document.getElementById("cptvire");
        var m = document.getElementById("oper");
        if (m.value == 'VI')
        {
            if (a.style.display == "none")
            {
                a.style.display = "block";
            }
        }
        else
        {
          a.style.display = "none";

        }

      }
</script>



</x-app-layout>
