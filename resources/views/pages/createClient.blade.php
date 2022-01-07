


<x-app-layout>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    @include('pages.partials.entete')
<div class="py-2 flex">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div lass="align-middle inline-block min-w-full shadow
                     overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">


           @if (Session::has('add_msg'))
                {!! Toastr::message() !!}
           @endif


 <div class="row">
    <div class="alert-info text text-2xl text-bold text-danger">
        Formulaire de saisies des clients
        </div>

        <div class="row py-2">
            {{--    Modification du quartier --}}
 @if($client->id)

 <form action="{{ route('client.update',['id'=>$client->id]) }}" method="POST" enctype="multipart/form-data">
         <input type="text" value="{{ $codeClient }}" name="codeClient" hidden>
     <div class="row">

         <div class="col-10">
             {{--    <div class="col-sm-2">
             </div>  --}}
             {{-- <div class="container-fluid"> --}}
                 <div class="card">
                     <div class="text text-bold card-header alert-dark">
                         Modifcation client : <span class="text text-danger">{{ $codeClient }}</span>
                     </div>

                     <div class="card-body">
                         @csrf
                         <div class="row">

                                 <div class="col">
                                     <label for="nom" class="form-label">Nom</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase  @error('nom') is-invalid @enderror"
                                     name="nom" id="nom"  value="{{ old('nom',$client->nom) }}">
                                     @error('nom')
                                         <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror
                                 </div>

                                 <div class="col">
                                     <label for="prenom"  class="form-label">Prénoms</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('prenom') is-invalid @enderror"
                                     name="prenom" id="prenom" rows="2" value="{{ old('prenom',$client->prenom)}}">
                                     @error('prenom')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>

                                 <div class="col">
                                     <label for="email"  class="form-label">Email</label>
                                     <input type="email" class="form-control form-control-sm text-lowercase @error('email') is-invalid @enderror"
                                     name="email" id="email" value="{{ old('email',$client->email)}}">
                                     @error('email')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>
                         </div>
                         <div class="row">
                                 <div class="col">
                                     <label for="telephone"  class="form-label">Téléphone</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('telephone') is-invalid @enderror"
                                     name="telephone" id="telephone" value="{{ old('telephone',$client->tel)}}">
                                     @error('telephone')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>
                                 <div class="col">
                                     <label for="pere"  class="form-label" rows="2">Nom père</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('pere') is-invalid @enderror"
                                     name="pere" id="pere" value="{{ old('pere',$client->pere)}}">
                                     @error('pere')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>

                                 <div class="col">
                                     <label for="mere"  class="form-label">Nom mère</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('mere') is-invalid @enderror"
                                     name="mere" id="mere" value="{{ old('mere',$client->mere)}}">
                                     @error('mere')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>

                         </div>


                         <div class="row">
                             <div class="col">
                                 <label for="situ"  class="form-label" rows="2">Situation matrimoniale</label>
                                 <select class="form-select form-select-sm" name="situ" >
                                     <option value=""></option>
                                     @foreach ($situations as $situation)
                                         @if ($situation->id == $client->cid_situation->id)
                                             <option value="{{old('situ',$client->cid_situation->id)}}"
                                                 {{ $client->cid_situation->id == $client->cid_situation->id ? "selected":"" }}>
                                                 {{ $client->cid_situation->libelle }}
                                             </option>
                                         @else
                                         <option value="{{$situation->id }}"
                                             {{ old('situ') == $situation->id  ? "selected":"" }}>
                                             {{ $situation->libelle }}
                                         </option>
                                         @endif

                                     @endforeach
                                 </select>
                                 @error('situ')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                             <div class="col">
                                 <label for="nature"  class="form-label">Nature pièce</label>
                                 <select class="form-select  form-select-sm-sm @error('nature') is-invalid @enderror" name="nature" id="nature" >
                                     <option value=""></option>
                                     @foreach ($natures as $nature)
                                         @if ($nature->id == $client->cid_nature_piece->id)
                                         <option value="{{old('nature', $client->cid_nature_piece->id) }}"
                                             {{ $client->cid_nature_piece->id == $client->cid_nature_piece->id ? "selected":"" }}>
                                             {{ $client->cid_nature_piece->nature }}
                                     </option>
                                         @else
                                         <option value="{{ $nature->id }}" {{ old('nature') == $nature->id ? "selected":"" }}>
                                             {{ $nature->nature }}
                                         </option>
                                         @endif

                                     @endforeach
                                 </select>
                                 @error('nature')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                             <div class="col">
                                 <label for="numpiece"  class="form-label">Numéro pièce</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('numpiece') is-invalid @enderror"
                                 name="numpiece" id="numpiece" value="{{ old('numpiece',$client->numpiece)}}">
                                 @error('numpiece')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                         </div>

                         <div class="row">
                             <div class="col">
                                 <label for="adrpost"  class="form-label">Adresse postale</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('adrpost') is-invalid @enderror"
                                 name="adrpost" id="adrpost" value="{{ old('adrpost',$client->adrpost)}}">
                                 @error('adrpost')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                             <div class="col">
                                 <label for="quartier" class="form-label">Quartier</label>
                                 <select class="form-select form-select-sm" name="quartier" aria-label="Default select example">
                                     <option value=""></option>
                                     @foreach ($quartiers as $quartier)
                                         @if ($quartier->id == $client->cid_quartier->id)
                                             <option value="{{ old('quartier',$client->cid_quartier->id) }}"
                                                 {{ $client->cid_quartier->id == $client->cid_quartier->id ? "selected":"" }}>
                                             {{ $client->cid_quartier->libelle }}</option>
                                         @else
                                             <option value="{{ $quartier->id }}" {{ old('quartier') == $quartier->id ? "selected":"" }}>
                                             {{ $quartier->libelle }}</option>
                                         @endif

                                     @endforeach

                                 </select>
                                 @error('quartier')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>


                             <div class="col">
                                 <label for="secActivite" class="form-label">Secteur activité</label>
                                 <select class="form-select form-select-sm" name="secActivite" aria-label="Default select example">
                                     <option></option>
                                     @foreach ($activites as $activite)
                                         @if ($activite->id == $client->cid_activite->id)
                                             <option value="{{old('secActivite',$client->cid_activite->id)}}"
                                                 {{ $client->cid_activite->id == $client->cid_activite->id ? "selected":"" }}>
                                             {{ $client->cid_activite->libelle}}</option>
                                         @else
                                         <option value="{{ $activite->id }}" {{ old('secActivite') == $activite->id ? "selected":"" }}>
                                             {{ $activite->libelle }}</option>
                                         @endif

                                     @endforeach
                                 </select>
                                 @error('secActivite')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror
                                 </div>
                         </div>


                     <div class="row">

                         <div class="col-4">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <label for="datouv"  class="form-label" rows="2">Date ouverture</label>
                                         <div class="form-group">
                                             <input class="input-group date form-control form-control-sm" type="text"
                                             name="datouv" value="{{old('datouv',$client->dateouv) }}" id="datouv" data-date-format="D-M-Y">

                                         </div>

                                     @error('datouv')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>


                                 <div class="col-sm-6">
                                     <label for="signature"  class="form-label">Date signature</label>

                                         <div class="input-group">
                                             <input type='text' class="form-control form-control-sm date input-group" data-date-format="D-M-Y"
                                             name="signature" id="signature" value="{{old('signature',$client->datesign) }}" >
                                         </div>
                                     @error('signature')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>
                             </div>

                         </div>


                         <div class="col-sm-4">
                            <div class="row">
                                <div class="col">
                                    <label for="naiss"  class="form-label">Date naissance</label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" class="form-control form-control-sm date input-group" data-date-format="D-M-Y"
                                        id="naiss" value="{{ old('naiss',$client->datenaiss)}}" name="naiss" >
                                    </div>

                                    @error('naiss')
                                    <div class="text-danger">
                                            {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    {{--  <label class="form-label" for="typeClient">Type client</label>
                                    <input type="text" class="form-control form-control-sm text-uppercase"  disabled name="typeClient" id="typeClient"
                                            value="{{ $client->typeClient }}">  --}}

                                            <label class="form-label" for="typeClient">Type client</label>
                                            <input list="types" class="form-control form-control-sm" value="{{ $client->typeClient }}"  name="typeClient" id="typeClient">
                                            <datalist id="types">
                                                <option value="Client" >
                                                <option value="Interne">
                                                <option value="Banque">
                                            </datalist>
                                </div>


                            </div>

                        </div>


                         <div class="col-sm-4">
                             <label for="adrgeo"  class="form-label">Adresse géographique</label>
                             <textarea class="form-control text-uppercase @error('telephone') is-invalid @enderror"
                             name="adrgeo" id="adrgeo" rows="2">{{ old('adrgeo',$client->adrgeo)}}</textarea>
                             @error('adrgeo')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>


                 </div>



                     </div>

                     <div class=" card-footer text-right alert-warning">
                         <a href="{{ route('client') }}"  class="btn btn-secondary btn-sm ">Retour liste</a>
                         {{--  <button type="button" class="btn btn-primary btn-sm ">Annuler</button>  --}}
                         <button type="submit" class="btn btn-success btn-sm">Valider</button>
                     </div>
                 </div>
             {{-- </div> --}}

         </div>

         <div class="col-2">
             <div class="row">
                 <div class="col">
                     <label for="photo"  class="form-label">Photo</label>
                     <input type="file" class="form-control form-control-sm @error('photo') is-invalid @enderror"
                     name="photo" id="photo" value="{{ old('photo')}}" onchange="readURL(this);">
                     <img name="previewPhoto" id="previewPhoto"  src="{{ Storage::url($client->photo) }}"
                     style="width:186px;height:150px;" class="img-thumbnail" />
                     @error('photo')
                     <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror

                 </div>

             </div>

             <div class="row py-4">
                 <div class="col">
                     <label for="psignature"  class="form-label">Signature</label>
                     <input type="file" class="form-control form-control-sm @error('psignature') is-invalid @enderror"
                     name="psignature" id="psignature" value="{{ old('psignature',$client->sign)}}" onchange="readSignURL(this)">
                     <img src="{{Storage::url($client->sign)}}" name="previewSign" id="previewSign"
                     style="width:186px;height:150px;" class="img-thumbnail" />
                     @error('psignature')
                     <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror

                 </div>
             </div>
         </div>
     </div>
 </form>

@endif
{{--  fin de la modifcation --}}

@if(!$client->id)
<form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
 <input type="text" value="{{ $codeClient }}" name="codeClient" hidden>
 <div class="row">

 <div class="col-10">

     {{-- <div class="container-fluid"> --}}
             <div class="card">
                 <div class="text text-bold card-header alert-dark">
                             Enregistrer nouveau client
                 </div>

                 <div class="card-body">
                     @csrf
                     <div class="row">

                             <div class="col">
                                 <label for="nom" class="form-label">Nom</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase  @error('nom') is-invalid @enderror"
                                 name="nom" id="nom"  value="{{ old('nom') }}">
                                 @error('nom')
                                     <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="col">
                                 <label for="prenom"  class="form-label">Prénoms</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('prenom') is-invalid @enderror"
                                 name="prenom" id="prenom" rows="2" value="{{ old('prenom')}}">
                                 @error('prenom')
                                 <div class="text-danger">
                                         {{ $message }}
                                 </div>
                                 @enderror
                             </div>

                             <div class="col">
                                 <label for="email"  class="form-label">Email</label>
                                 <input type="email" class="form-control form-control-sm text-lowercase @error('email') is-invalid @enderror"
                                 name="email" id="email" value="{{ old('email')}}">
                                 @error('email')
                                 <div class="text-danger">
                                         {{ $message }}
                                 </div>
                                 @enderror

                             </div>



                     </div>
                     <div class="row">

                             <div class="col">
                                 <label for="telephone"  class="form-label" rows="2">Téléphone</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('telephone') is-invalid @enderror"
                                 name="telephone" id="telephone" value="{{ old('telephone')}}">
                                 @error('telephone')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>
                             <div class="col">
                                 <label for="pere"  class="form-label" rows="2">Nom père</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('pere') is-invalid @enderror"
                                 name="pere" id="pere" value="{{ old('pere')}}">
                                 @error('pere')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                             <div class="col">
                                 <label for="mere"  class="form-label">Nom mère</label>
                                 <input type="text" class="form-control form-control-sm text-uppercase @error('mere') is-invalid @enderror"
                                 name="mere" id="mere" value="{{ old('mere')}}">
                                 @error('mere')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>


                     </div>


                     <div class="row">


                         <div class="col">
                             <label for="situ"  class="form-label" rows="2">Situation matrimoniale</label>
                             <select class="form-select form-select-sm" name="situ" >
                                 <option value=""></option>
                                 @foreach ($situations as $situation)
                                         <option value="{{$situation->id }}"
                                             {{ old('situ') == $situation->id  ? "selected":"" }}>
                                             {{ $situation->libelle }}
                                         </option>
                                 @endforeach
                             </select>
                             @error('situ')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>

                         <div class="col">
                             <label for="nature"  class="form-label" rows="2">Nature pièce</label>
                             <select class="form-select form-select-sm" name="nature" >
                                 <option value=""></option>
                                     @foreach ($natures as $nature)
                                         <option value="{{ $nature->id }}" {{ old('nature') == $nature->id ? "selected":"" }}>
                                             {{ $nature->nature }}
                                         </option>
                                     @endforeach
                             </select>
                             @error('nature')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>

                         <div class="col">
                             <label for="numpiece"  class="form-label">Numéro pièce</label>
                             <input type="text" class="form-control form-control-sm text-uppercase @error('numpiece') is-invalid @enderror"
                             name="numpiece" id="numpiece" value="{{ old('numpiece')}}">
                             @error('numpiece')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>

                     </div>

                     <div class="row">


                         <div class="col">
                             <label for="adrpost"  class="form-label">Adresse postale</label>
                             <input type="text" class="form-control text-uppercase @error('adrpost') is-invalid @enderror"
                             name="adrpost" id="adrpost" value="{{ old('adrpost')}}">
                             @error('adrpost')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>

                         <div class="col">
                             <label for="quartier" class="form-label">Quartier</label>
                             <select class="form-select form-select-sm @error('quartier') is-invalid @enderror"
                             name="quartier" aria-label="Default select example">
                                 <option value=""></option>
                                 @foreach ($quartiers as $quartier)
                                 <option value="{{ $quartier->id }}" {{ old('quartier') == $quartier->id ? "selected":"" }}>
                                     {{ $quartier->libelle }}</option>
                                 @endforeach

                             </select>
                             @error('quartier')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>


                         <div class="col">
                             <label for="secActivite" class="form-label">Secteur activité</label>
                             <select class="form-select form-select-sm @error('secActivite') is-invalid @enderror"
                             name="secActivite" aria-label="Default select example">
                                 <option></option>
                                 @foreach ($activites as $activite)
                                 <option value="{{ $activite->id }}" {{ old('secActivite') == $activite->id ? "selected":"" }}>
                                     {{ $activite->libelle }}</option>
                                 @endforeach
                             </select>
                             @error('secActivite')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                             </div>
                         </div>


                     <div class="row">

                         <div class="col-4">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <label for="datouv"  class="form-label" rows="2">Date ouverture</label>
                                         <div class="form-group">
                                             <input class="input-group date form-control form-control-sm" type="text" name="datouv" id="datouv" data-date-format="D-M-Y">

                                         </div>

                                     @error('datouv')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>


                                 <div class="col-sm-6">
                                     <label for="signature"  class="form-label">Date signature</label>

                                         <div class="input-group">
                                             <input type='text' class="form-control form-control-sm date input-group" data-date-format="D-M-Y"
                                             name="signature" id="signature" value="{{ old('signature')}}" >
                                         </div>
                                     @error('signature')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>
                             </div>

                         </div>


                             <div class="col-sm-4">
                                <div class="row">
                                    <div class="col">
                                        <label for="naiss"  class="form-label">Date naissance</label>
                                        <div class="input-group col-sm-6">
                                            <input type="text" class="form-control form-control-sm date input-group" data-date-format="D-M-Y"
                                            id="naiss" value="{{ old('naiss')}}" name="naiss" >
                                        </div>

                                        @error('naiss')
                                        <div class="text-danger">
                                                {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="typeClient">Type client</label>
                                        <input list="types" class="form-control form-control-sm"  name="typeClient" id="typeClient">
                                        <datalist id="types">
                                            <option value="Client" >
                                            <option value="Interne">
                                            <option value="Banque">
                                        </datalist>
                                    </div>


                                </div>

                             </div>


                         <div class="col-sm-4">
                             <label for="adrgeo"  class="form-label">Adresse géographique</label>
                             <textarea class="form-control text-uppercase @error('telephone') is-invalid @enderror"
                             name="adrgeo" id="adrgeo" rows="2" value="{{ old('telephone')}}">{{ old('adrgeo')}}</textarea>
                             @error('adrgeo')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>


                     </div>

                 </div>

                 <div class=" card-footer text-right alert-warning">
                     <a href="{{ route('client') }}"  class="btn btn-secondary btn-sm">Retour liste</a>
                     <a href="{{ route('client.create') }}"  class="btn btn-danger btn-sm ">Annuler</a>
                     {{--  <button type="button" class="btn btn-primary btn-sm ">Annuler</button>  --}}
                     <button type="submit" class="btn btn-success btn-sm">Valider</button>
                 </div>

             </div>
     {{-- </div> --}}

 </div>

 <div class="col-2 form-group">

             <div class="row">
                 <div class="col">
                     <label for="photo"  class="form-label">Photo</label>
                     <input type="file" class="form-control form-control-sm @error('photo') is-invalid @enderror"
                     name="photo" id="photo"  onchange="readURL(this);">
                     <img name="previewPhoto" id="previewPhoto"  src="#" class="img-thumbnail"  />
                     @error('photo')
                     <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror

                 </div>
             </div>

             <div class="row py-4">
                 <div class="col">
                     <label for="psignature"  class="form-label">Signature</label>
                     <input type="file" class="form-control form-control-sm @error('psignature') is-invalid @enderror"
                     name="psignature" id="psignature" value="{{ old('psignature')}}" onchange="readSignURL(this);">
                     <img src="#" id="previewSign" name="previewSign" class="img-thumbnail"  />
                     @error('psignature')
                     <div class="text-danger">
                             {{ $message }}
                         </div>
                     @enderror

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
            {{--  </div>  --}}
       {{--   </div>  --}}
 </div>




 {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 --}}

    <script type="text/javascript">
        $('.date').datepicker({
           format: 'yyyy-mm-dd'
         });

         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previewPhoto')
                        .attr('src', e.target.result)
                        .width(186)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        function readSignURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previewSign')
                        .attr('src', e.target.result)
                        .width(186)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

 {{--     <script>
        toastr["success"]("Are you the six fingered man?")
    </script>  --}}

    </x-app-layout>
