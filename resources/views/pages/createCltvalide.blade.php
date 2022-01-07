


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
        Formulaire de validation clients
        </div>

        <div class="row py-2">
            {{--    Modification du quartier --}}
 @if($client->id)

 <form action="{{ route('cltvalide.update',['id'=>$client->id]) }}" method="POST" enctype="multipart/form-data">
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
                                     name="nom" id="nom" readonly  value="{{ old('nom',$client->nom) }}">
                                     @error('nom')
                                         <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror
                                 </div>

                                 <div class="col">
                                     <label for="prenom"  class="form-label">Prénoms</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('prenom') is-invalid @enderror"
                                     name="prenom" id="prenom" rows="2" readonly value="{{ old('prenom',$client->prenom)}}">
                                     @error('prenom')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>

                                 <div class="col">
                                     <label for="email"  class="form-label">Email</label>
                                     <input type="email" class="form-control form-control-sm text-lowercase @error('email') is-invalid @enderror"
                                     name="email" id="email" readonly value="{{ old('email',$client->email)}}">
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
                                     name="telephone" id="telephone" readonly value="{{ old('telephone',$client->tel)}}">
                                     @error('telephone')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>
                                 <div class="col">
                                     <label for="pere"  class="form-label" rows="2">Nom père</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('pere') is-invalid @enderror"
                                     name="pere" id="pere" readonly value="{{ old('pere',$client->pere)}}">
                                     @error('pere')
                                     <div class="text-danger">
                                             {{ $message }}
                                         </div>
                                     @enderror

                                 </div>

                                 <div class="col">
                                     <label for="mere"  class="form-label">Nom mère</label>
                                     <input type="text" class="form-control form-control-sm text-uppercase @error('mere') is-invalid @enderror"
                                     name="mere" id="mere" readonly value="{{ old('mere',$client->mere)}}">
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
                                 <select class="form-select form-select-sm" name="situ" disabled>
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
                                 <select class="form-select  form-select-sm-sm @error('nature') is-invalid @enderror" name="nature" id="nature" disabled >
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
                                 name="numpiece" readonly id="numpiece" value="{{ old('numpiece',$client->numpiece)}}">
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
                                 name="adrpost" readonly id="adrpost" value="{{ old('adrpost',$client->adrpost)}}">
                                 @error('adrpost')
                                 <div class="text-danger">
                                         {{ $message }}
                                     </div>
                                 @enderror

                             </div>

                             <div class="col">
                                 <label for="quartier" class="form-label">Quartier</label>
                                 <select class="form-select form-select-sm" name="quartier" aria-label="Default select example" disabled>
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
                                 <select class="form-select form-select-sm" name="secActivite" aria-label="Default select example" disabled>
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
                                             name="datouv" readonly value="{{old('datouv',$client->dateouv) }}" id="datouv" data-date-format="D-M-Y">

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
                                             name="signature" readonly id="signature" value="{{old('signature',$client->datesign) }}" >
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
                                        id="naiss" readonly value="{{ old('naiss',$client->datenaiss)}}" name="naiss" >
                                    </div>

                                    @error('naiss')
                                    <div class="text-danger">
                                            {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="typeClient">Type client</label>
                                    <input type="text" class="form-control form-control-sm text-uppercase" readonly  name="typeClient" id="typeClient"
                                            value="{{ $client->typeClient }}">
                                </div>


                            </div>

                        </div>


                         <div class="col-sm-4">
                             <label for="adrgeo"  class="form-label">Adresse géographique</label>
                             <textarea class="form-control text-uppercase @error('telephone') is-invalid @enderror"
                             name="adrgeo" id="adrgeo" readonly rows="2">{{ old('adrgeo',$client->adrgeo)}}</textarea>
                             @error('adrgeo')
                             <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror

                         </div>


                 </div>



                     </div>

                     <div class="card-footer text-left alert-secondary">
                        <a href="{{ route('cltvalide') }}"  class="btn btn-secondary btn-sm ">Retour</a>
                         <button type="submit" class="btn btn-danger btn-sm float-right">Valider</button>
                     </div>
                 </div>
             {{-- </div> --}}

         </div>

         <div class="col-2">
             <div class="row">
                 <div class="col">
                     <label for="photo"  class="form-label">Photo</label>
                     {{--  <input type="file" class="form-control form-control-sm @error('photo') is-invalid @enderror"
                     name="photo" id="photo" value="{{ old('photo')}}" onchange="readURL(this);">  --}}
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
                     {{--  <input type="file" class="form-control form-control-sm @error('psignature') is-invalid @enderror"
                     name="psignature" id="psignature" value="{{ old('psignature',$client->sign)}}" onchange="readSignURL(this)">  --}}
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
