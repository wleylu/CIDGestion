
<x-app-layout>
@include('pages.partials.entete')

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <div lass="align-middle inline-block min-w-full shadow
                 overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                 <div class="alert-primary text text-2xl text-center text-danger  text-bold">
                    LISTE DES CLIENTS
                </div>



        {{--      <div class="right-10 col-md-1">
                <a href="{{ route('quartier.create') }}"  class="text-white bg-orange-700 hover:bg-indigo-500 focus:ring-4
                focus:ring-blue-300 font-medium text-sm  text-center
                flex items-center justify-center flex-1 h-full  rounded-lg ">
                Nouveau
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                </a>
            </div>  --}}



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
                            <th>Valide</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text text-sm">
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client ->client }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->adrpost }}</td>
                                <td>{{ $client->tel }}</td>
                                <td>{{ $client->cid_quartier->libelle }}</td>
                                <td>{{ $client->cid_activite->libelle }}</td>
                                <td width="20px">{{ $client->valide ==1 ? 'V':'N' }}</td>
                                <td width="100px">
                                    <a type="button" href="{{route('cliproduit.create',['id'=>$client->id])}}" class="text-primary px-1" >
                                        <svg class="small" fill="currentColor" width="16" height="16" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                            clip-rule="evenodd"></path>
                                            </svg>
                                    </a>


                                    <a type="button" href="{{route('client.edit',['id'=>$client->id])}}" class="text-primary px-1" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="small" width="16" height="16" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>

                                    </a>

                                    <a type="button" href="{{route('cptbank.show',['client'=>$client->id])}}" class="text-primary px-" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="small" width="16" height="16" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                                            <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z"/>
                                        </svg>

                                    </a>

                                    <a type="button" href="#" class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="small" width="16" height="20" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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

