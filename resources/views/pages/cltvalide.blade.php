
<x-app-layout>
@include('pages.partials.entete')

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <div lass="align-middle inline-block min-w-full shadow
                 overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                 <div class="alert-primary text text-2xl text-center text-danger  text-bold">
                    LISTE DES CLIENTS EN ATTENTES DE VALIDATION
                </div>


            {{-- Tableau affichage --}}
          {{--    Session : {{ Session::get('update_msg') }}  --}}
            @if (Session::has('update_msg') )
                 {!! Toastr::message() !!}
             @endif


              <div class="row py-2">
                <table id="example" class="py-1 table table-striped table-bordered table-responsive" style="width:100%">
                    <thead class="alert alert-success">
                        <tr>
                            <th>Client</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Quartier</th>
                            <th>Activite</th>
                            <th>Valider</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client ->client }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->adrpost }}</td>
                                <td>{{ $client->tel }}</td>
                                <td>{{ $client->cid_quartier->libelle }}</td>
                                <td>{{ $client->cid_activite->libelle }}</td>
                                <td>

                                    <a type="button" href="{{route('cltvalide.edit',['id'=>$client->id])}}" class="text-primary px-1" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                                            <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                          </svg>

                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
              </div>


            {{-- -Tableau affichage --}}

           </div>
    </div>
</div>



</x-app-layout>

