
<x-app-layout>
@include('pages.partials.entete')

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <div lass="align-middle inline-block min-w-full shadow
                 overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">


            <div class="right-10 col-md-1">
                <a href="{{ route('quartier.create') }}"  class="text-white bg-orange-700 hover:bg-indigo-500 focus:ring-4
                focus:ring-blue-300 font-medium text-sm  text-center
                flex items-center justify-center flex-1 h-full  rounded-lg ">
                Nouveau
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                </a>
            </div>



            {{-- Tableau affichage --}}

            <table id="example" class=" py-1 table table-striped table-bordered table-responsive" style="width:100%">
                <thead class="alert alert-success">
                    <tr>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quartiers as $quartier)
                        <tr>
                            <td>{{ $quartier ->libelle }}</td>
                            <td>{{ $quartier->description }}</td>
                            <td>{{ $quartier->pays }}</td>
                          <td>{{ $quartier->ville }}</td>
                            <td>


                                <a type="button" href="{{ route('quartier.edit',['id'=>$quartier->id]) }}" class="text-primary px-2" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                  </svg>

                                </a>

                                  <a type="button" href="{{ route('quartier.delete',['id'=>$quartier->id]) }}" class="text-danger">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                  </svg>

                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{-- -Tableau affichage --}}

           </div>
    </div>
</div>



</x-app-layout>

