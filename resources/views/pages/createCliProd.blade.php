<x-app-layout>
    @include('pages.partials.entete')

<div class="py-2">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div lass="align-middle inline-block min-w-full shadow
                 overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">


                 @if(Session::has('add_prod'))
                 {!! Toastr::message() !!}
           @endif

           <div class="alert-info text text-2xl text-bold text-danger">
            Formulaire de saisies des produits
            </div>

            <div class="row py-2">
                @if($client->id)

                <form action="{{ route('cliproduit.store') }}" method="POST">
   
                    @csrf
                    <div class="row">
                        
                        <div class="col">
                            <div class="card align-self-end">
                               {{--   <div class="text card-header alert alert-success">
                                            Vente de produits
                                </div>  --}}
                                <div class="card-body">
                                    <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                        name="client1" id="client1" hidden placeholder="Client " 
                                        value="{{ old('client',$client->client) }}">
                                    
                                    <div class="row g-2">

                                        <div class="col">
                                            <label for="client" class="form-label">Client</label>
                                            <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                            name="client" id="client" readonly placeholder="Client " 
                                            value="{{ old('client',$client->client) }} => {{$client->nom}} {{$client->prenom}}">
                                            @error('client')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="produit" class="form-label">Produit</label>
                                            <select type="text" class="form-select form-select-sm @error('libelle') is-invalid @enderror"
                                            name="produit" id="produit" >
                                                <option selected>Veuillez sélectionner le produit</option>
                                                @foreach ($produits as $produit)
                                                    <option value="{{ old('produit',$produit->id) }}" {{ $produit->id == old('produit') ? "selected":"" }}>
                                                        {{ old('produit',$produit->produit) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('produit')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    
                                    <div class="text-right py-2">
                                        <a href="{{ route('client') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                                        <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                    </div>
   
   
                                </div>
   
                               
   
                            </div>
                        </div>
   
   
                    </div>
   
                    <div class="row py-2">
                        <table class="table table-bordered table-responsive">
                            <thead class="alert alert-dark">
                                <tr>
                                    <th>Client</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Produit</th>
                                    <th>Date</th>
                                    <th width="20">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prodClient as $prod)
                                    <tr>
                                        <td>{{ $prod->client }}</td>
                                        <td>{{ $prod->nom }}</td>
                                        <td>{{ $prod->prenom }}</td>
                                        <td>{{ $prod->produit }}</td>
                                        <td>{{ $prod->created_at }}</td>
                                        <td>
                                            <a type="button" href="{{ route('cliproduit.delete',['id'=>$prod->id]) }}" class="text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
   
                                              </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
