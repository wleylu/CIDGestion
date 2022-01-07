<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{--  {{ __('Dashboard CID') }} --}}
            <ul class="flex text-base" >
                <li class="mr-6 ">
                  <a class=" text-blue-500 hover:text-blue-800 " href="{{ route("register") }}">Utilisateur</a>
                </li>
                <li class="mr-6 dropdown">
                    <div class="dropdown">
                        <a href="#" class="text-blue-500 hover:text-blue-800 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="true">
                            Paramétrages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="{{ route('quartier') }}">Quartier</a></li>
                          <li><a class="dropdown-item" href="{{ route('activite') }}">Activités</a></li>
                          <li><a class="dropdown-item" href="{{ route('periode') }}">Période</a></li>
                          <li><a class="dropdown-item" href="{{ route('commission') }}">Commission</a></li>
                          <li><a class="dropdown-item" href="{{ route('produit') }}">Produit</a></li>
                          <li><a class="dropdown-item" href="{{ route('typecpt') }}">Type compte</a></li>
                          <li><a class="dropdown-item" href="{{ route('codeoper') }}">Code opérations</a></li>
                          <li><a class="dropdown-item" href="{{ route('comptable') }}">Schéma comptable</a></li>
                        </ul>
                      </div>
                </li>

                <li class="mr-6 dropdown">
                    <div class="dropdown">
                        <a href="#" class="text-blue-500 hover:text-blue-800 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="true">
                            Client
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="{{ route('client.create') }}">Nouveau</a></li>
                          <li><a class="dropdown-item" href="{{ route('client') }}">Clients</a></li>
                          <li><a class="dropdown-item" href="{{ route('comptecli.create') }}">Compte</a></li>
                        </ul>
                      </div>
                </li>

                <li class="mr-6 dropdown">
                    <div class="dropdown">
                        <a href="#" class="text-blue-500 hover:text-blue-800 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="true">
                            Gestion
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('cltvalide') }}">Validation client</a></li>
                          <li><a class="dropdown-item" href="{{ route('operation') }}">Opérations</a></li>

                        </ul>
                      </div>
                </li>
               {{--   <li class="mr-6">
                  <a class="text-gray-400 cursor-not-allowed" href="#">Disabled</a>
                </li>  --}}
              </ul>

        </h2>


    </x-slot>
