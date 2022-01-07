<x-app-layout>
    @include('pages.partials.entete')

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">

                     <div class="alert-info text text-2xl text-bold text-danger">
                         Formulaire de traitement code opération
                    </div>

                     @if (Session::has('add_msg'))
                         {!! Toastr::message()  !!}
                     @endif

                    <div class="row py-2">
                                              {{--    Modification du quartier --}}
 @if($codeoper->id)

 <form action="{{ route('codeoper.update',['id'=>$codeoper->id]) }}" method="POST">

     @csrf

             <div class="card row">
                 <div class="text text-bold card-header alert-dark">
                                 Modification code opération
                 </div>
                 <div class="card-body row">
                   <div class="row">
                         <div class="col">
                             <label for="oper" class="form-label">Code opération</label>
                             <input type="text" class="form-control form-control-sm @error('oper') is-invalid @enderror"
                             name="oper" id="oper" placeholder="Code opération" value="{{ old('oper',$codeoper->oper) }}">
                             @error('oper')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="col">
                             <label for="libelle" class="form-label">Libellé</label>
                             <input type="text" class="form-control form-control-sm @error('libelle') is-invalid @enderror"
                             name="libelle" id="libelle" placeholder="Libellé" value="{{ old('libelle',$codeoper->libelle) }}">
                             @error('libelle')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                   </div>


                     <div class="row">
                         <div class="col">
                             <div class="row">
                                 <div class="col-sm-4">
                                   <label for="taux" class="form-label">Taux commission</label>
                                   <input type="number" class="form-control form-control-sm @error('taux') is-invalid @enderror"
                                   name="taux" id="taux" placeholder="Taux de commission" value="{{ old('taux',$codeoper->taux) }}">
                                   @error('taux')
                                       <div class="text-danger">
                                           {{ $message }}
                                       </div>
                                   @enderror
                                 </div>
                                   <div class="col-sm-8">
                                       <label for="commission" class="form-label">Commission</label>
                                       <select  class="form-select form-select-sm @error('commission') is-invalid @enderror"
                                           name="commission" id="commission">
                                           <option value=""></option>
                                           @foreach($commissions as $com)
                                               @if ($com->id == $codeoper->cid_commission_id)
                                                   <option value="{{ $com->id}}" {{ $com->id == $com->id ? "selected":"" }}>
                                                       {{ $com->libelle }}
                                                   </option>
                                               @else
                                                   <option value="{{ old('commission',$com->id)}}"
                                                       {{old('commission')== $com->id ? "selected":""}}>
                                                       {{ $com->libelle }}
                                                   </option>
                                               @endif
                                           @endforeach
                                       </select>
                                   </div>
                             </div>

                         </div>

                         <div class="col">
                             <label for="montant" class="form-label">Montant com fixe</label>
                             <input type="number" class="form-control form-control-sm @error('montant') is-invalid @enderror"
                             name="montant" id="montant" placeholder="Montant fixe commission" value="{{ old('montant',$codeoper->mntCom) }}">
                             @error('montant')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                     </div>

                   <div class="row">
                         <div class="col">
                             <label for="compteOper" class="form-label">Compte opération</label>
                             <select  class="form-select form-select-sm @error('compteoper') is-invalid @enderror"
                             name="compteOper" id="compteOper">
                             <option value=""></option>
                             @foreach($comptes as $compte)
                               @if ($compte->compte == $codeoper->compteOper)
                                   <option value="{{ $compte->compte}}" {{ $compte->compte == $compte->compte ? "selected":"" }}>
                                           {{ $compte->compte }}
                                   </option>
                               @else
                               <option value="{{ old('compteOper',$compte->compte)}}"
                                   {{old('compteOper') == $compte->compte ? "selected":""}}>
                                   {{ $compte->compte }}
                               </option>
                               @endif
                             @endforeach
                             </select>
                             @error('compteoper')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="col">
                             <label for="compteCom" class="form-label">Compte commission</label>
                             <select  class="form-select form-select-sm @error('compteCom') is-invalid @enderror"
                             name="compteCom" id="compteCom">
                             <option value=""></option>
                             @foreach($comptes as $compte)
                               @if ($compte->compte == $codeoper->compteCom)
                                   <option value="{{ $compte->compte}}" {{ $compte->compte == $compte->compte ? "selected":"" }}>
                                           {{ $compte->compte }}
                                   </option>
                               @else
                               <option value="{{ old('compteCom',$compte->compte)}}"
                                   {{old('compteCom')== $compte->compte ? "selected":""}}>
                                   {{ $compte->compte }}
                               </option>
                               @endif
                             @endforeach
                             </select>
                             @error('compteCom')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                 </div>

                   <div class="row">
                         <div class="col mb-3">
                             <label for="acteur" class="form-label">Acteur</label>
                             <select class="form-select form-select-sm" name="acteur" id="acteur">
                            @if ($codeoper->acteur =='I')
                                 <option value="{{ old('I') }}" {{ old('acteur')==old('acteur') ? "selected":"" }} >Compte interne</option>
                                 <option value="C">Compte client</option>
                             @elseif ($codeoper->acteur =='C')
                                 <option value="{{ old('C') }}" {{ old('acteur')==old('acteur') ? "selected":"" }} >Compte client</option>
                                 <option value="I">Compte interne</option>
                             @else
                                <option value="I">Compte interne</option>
                                <option value="C">Compte client</option>
                             @endif

                             </select>
                         </div>
                         <div class="col mb-3">
                             <label for="description" class="form-label">Description</label>
                             <textarea put type="text" class="form-control form-control-sm @error('description') is-invalid @enderror"
                             name="description" id="description" rows="2" placeholder="Description du code opération">{{ old('description',$codeoper->description) }}</textarea>
                             @error('description')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                   </div>



               </div>

                 <div class=" card-footer text-right alert-warning">
                     <a href="{{ route('codeoper') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                     <button type="submit" class="btn btn-success btn-sm">Valider</button>
                 </div>

             </div>





 </form>

@endif
{{--  fin de la modifcation --}}

@if(!$codeoper->id)

 <form action="{{ route('codeoper.store') }}" method="POST">
     @csrf
             <div class="card align-self-end">
                 <div class="text text-bold card-header alert-dark">
                                 Enregistrer code opération
                 </div>
                 <div class="card-body row">
                     <div class="row">
                           <div class="col">
                               <label for="oper" class="form-label">Code opération</label>
                               <input type="text" class="form-control form-control-sm @error('oper') is-invalid @enderror"
                               name="oper" id="oper" placeholder="Code opération" value="{{ old('oper') }}">
                               @error('oper')
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
                     </div>


                       <div class="row">
                           <div class="col">
                               <div class="row">
                                   <div class="col-sm-4">
                                       <label for="taux" class="form-label">Taux commission</label>
                                       <input type="text" class="form-control form-control-sm @error('taux') is-invalid @enderror"
                                       name="taux" id="taux" placeholder="Taux de commission" value="{{ old('taux') }}">
                                       @error('taux')
                                           <div class="text-danger">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                                   <div class="col-sm-8">
                                       <label for="commission" class="form-label">Commission</label>
                                       <select  class="form-select form-select-sm @error('commission') is-invalid @enderror"
                                           name="commission" id="commission">
                                           <option value=""></option>
                                           @foreach($commissions as $com)
                                               <option value="{{ old('commission',$com->id)}}"
                                                   {{old('commission') == $com->id ? "selected":""}}>
                                                   {{ $com->libelle }}
                                               </option>
                                           @endforeach
                                       </select>
                                       @error('commission')
                                           <div class="text-danger">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                               </div>
                           </div>

                           <div class="col">
                               <label for="montant" class="form-label">Montant com fixe</label>
                               <input type="text" class="form-control form-control-sm @error('montant') is-invalid @enderror"
                               name="montant" id="montant" placeholder="Montant fixe commission" value="{{ old('montant') }}">
                               @error('montant')
                                   <div class="text-danger">
                                       {{ $message }}
                                   </div>
                               @enderror
                           </div>
                       </div>

                     <div class="row">
                           <div class="col">
                               <label for="compteOper" class="form-label">Compte opération</label>
                               <select  class="form-select form-select-sm @error('compteOper') is-invalid @enderror"
                               name="compteOper" id="compteOper">
                               <option value=""></option>
                               @foreach($comptes as $compte)
                                   <option value="{{ old('compteOper',$compte->compte)}}"
                                        {{old('compteOper') == $compte->compte ? "selected":""}}>
                                       {{ $compte->compte }}
                                   </option>
                               @endforeach
                               </select>
                               @error('compteOper')
                                   <div class="text-danger">
                                       {{ $message }}
                                   </div>
                               @enderror
                           </div>

                           <div class="col">
                               <label for="compteCom" class="form-label">Compte commission</label>
                               <select  class="form-select form-select-sm @error('compteCom') is-invalid @enderror"
                               name="compteCom" id="compteCom">
                               <option value=""></option>
                               @foreach($comptes as $compte)
                                   <option value="{{ old('compteCom',$compte->compte)}}"
                                        {{old('compteCom')== $compte->compte ? "selected":""}}>
                                       {{ $compte->compte }}
                                   </option>
                               @endforeach
                               </select>
                               @error('compteCom')
                                   <div class="text-danger">
                                       {{ $message }}
                                   </div>
                               @enderror
                           </div>
                   </div>

                     <div class="row">
                           <div class="col mb-3">
                               <label for="acteur" class="form-label">Acteur</label>
                               <select class="form-select form-select-sm" name="acteur" id="acteur">
                                   <option value=""></option>
                               @if (old('acteur')=='I')
                                   <option value="{{ old('I') }}" {{ old('acteur')==old('acteur') ? "selected":"" }} >Compte interne</option>
                                   <option value="C">Compte client</option>
                               @elseif (old('acteur')=='C')
                                   <option value="{{ old('C') }}" {{ old('acteur')==old('acteur') ? "selected":"" }} >Compte client</option>
                                   <option value="I">Compte interne</option>
                               @else
                                  <option value="I">Compte interne</option>
                                  <option value="C">Compte client</option>
                               @endif



                               </select>
                               @error('acteur')
                                   <div class="text text-danger">
                                       {{ $message }}
                                   </div>
                               @enderror
                           </div>
                           <div class="col mb-3">
                               <label for="description" class="form-label">Description</label>
                               <textarea put type="text" class="form-control form-control-sm @error('description') is-invalid @enderror"
                               name="description" id="description" rows="2" placeholder="Description du code opération" >{{ old('description') }}</textarea>
                               @error('description')
                                   <div class="text-danger">
                                       {{ $message }}
                                   </div>
                               @enderror
                           </div>
                     </div>



                 </div>

                 <div class=" card-footer text-right alert-warning">
                     <a href="{{ route('codeoper') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                     <a href="{{ route('codeoper.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
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
