<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-2">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     <div class="alert-info text text-2xl text-bold text-danger">
                         Formulaire de saisies des comptes bancaires
                    </div>

                    <div class="row py-2">
                                      {{--    Modification du quartier --}}
 
 {{--  fin de la modifcation --}}

       @if($client)

       <form action="{{ route('cptbank.store') }}" method="POST">
           @csrf
                   <div class="card">
                       <div class="text text-bold card-header alert-dark">
                                       Enregistrer compte
                       </div>
                       <div class="card-body flex-auto">
                         <input type="text" class="form-control form-control-sm"
                         name="client" id="client" value="{{ old('client',$client) }}" hidden>
                    
    
             <div class="row">
                 <div class="col">
                     <label for="compte" class="form-label">Compte</label>
                     <input type="text" class="form-control form-control-sm @error('compte') is-invalid @enderror"
                     name="compte" id="compte" placeholder="Compte bancaire du client" 
                     value="{{ old('compte', $compte->compte) }}">
                     @error('compte')
                         <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
             </div>
             <div class="row">
                 <div class="col">
                     <label for="codbnq" class="form-label">Code banque</label>
                     <input type="text" class="form-control form-control-sm @error('codbnq') is-invalid @enderror"
                     name="codbnq" id="codebank" placeholder="Code banque du client" value="{{ old('codbnq',$compte->codbnq) }}">
                     @error('codbnq')
                         <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
             </div>
         <div class="row">
             <div class="col">
                 <label for="codeguichet" class="form-label">Code guichet</label>
                 <input type="text" class="form-control form-control-sm @error('codeguichet') is-invalid @enderror"
                 name="codeguichet" id="codeguichet" placeholder="Code guichet" 
                 value="{{ old('codeguichet',$compte->codeguichet) }}">
                 @error('codeguichet')
                     <div class="text-danger">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>
         <div class="row">
             <div class="col">
                 <label for="rib" class="form-label">Clé RIB</label>
                 <input type="text" class="form-control form-control-sm @error('rib') is-invalid @enderror"
                 name="rib" id="rib" placeholder="Clé RIB du client" value="{{ old('rib',$compte->rib) }}">
                 @error('rib')
                     <div class="text-danger">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>

         <div class="row">
             <div class="col">
                 <label for="banque" class="form-label">Banque</label>
                 <input type="text" class="form-control form-control-sm @error('banque') is-invalid @enderror"
                 name="banque" id="banque" placeholder="Banque du client" value="{{ old('banque',$compte->banque) }}">
                 @error('banque')
                     <div class="text-danger">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>

                         
                     </div>

                       <div class=" card-footer text-right alert-warning">
                           <a href="{{ route('client') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                           <a href="{{ route('cptbank.delete',['id'=>$client]) }}"  class="btn btn-danger btn-sm ">Supprimer</a>
                           <button type="submit" class="btn btn-success btn-sm">Valider</button>
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
