<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://unpkg.com/tailwindcss@1.5.2/dist/tailwind.min.css" rel="stylesheet">

        <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
	  <!--Replace with your tailwind.css once created-->


	 <!--Regular Datatables CSS-->

     <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
     <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">

     <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">



        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>



        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

		<!-- les nouveaux packages pour les scripts additionels -->

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

           <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

           <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            {{--  fin Toastr --}}


        <style>

            /*Overrides for Tailwind CSS */

            /*Form fields*/
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568; 			/*text-gray-700*/
                padding-left: 1rem; 		/*pl-4*/
                padding-right: 1rem; 		/*pl-4*/
                padding-top: .5rem; 		/*pl-2*/
                padding-bottom: .5rem; 		/*pl-2*/
                line-height: 1.25; 			/*leading-tight*/
                border-width: 2px; 			/*border-2*/
                border-radius: .25rem;
                border-color: #edf2f7; 		/*border-gray-200*/
                background-color: #edf2f7; 	/*bg-gray-200*/
            }

            /*Row Hover*/
            table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
                background-color: #ebf4ff;	/*bg-indigo-100*/
            }

            /*Pagination Buttons*/
            .dataTables_wrapper .dataTables_paginate .paginate_button		{
                font-weight: 700;				/*font-bold*/
                border-radius: .25rem;			/*rounded*/
                border: 1px solid transparent;	/*border border-transparent*/
            }

            /*Pagination Buttons - Current selected */
            .dataTables_wrapper .dataTables_paginate .paginate_button.current	{
                color: #fff !important;				/*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
                font-weight: 700;					/*font-bold*/
                border-radius: .25rem;				/*rounded*/
                background: #667eea !important;		/*bg-indigo-500*/
                border: 1px solid transparent;		/*border border-transparent*/
            }

            /*Pagination Buttons - Hover */
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
                color: #fff !important;				/*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
                font-weight: 700;					/*font-bold*/
                border-radius: .25rem;				/*rounded*/
                background: #667eea !important;		/*bg-indigo-500*/
                border: 1px solid transparent;		/*border border-transparent*/
            }

            /*Add padding to bottom border */
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }

            /*Change colour of responsive icon*/
           table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #667eea !important; /*bg-indigo-500*/
            }

          </style>


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-green-200 shadow">
                {{--  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">  --}}
                <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
                    {{ $header }}

                </div>
            </header>

            <!-- Page Content -->
            <main>

                {{ $slot }}

            </main>
        </div>
        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

        <!--nouveaux scripts -->
		<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js"
		 integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

		 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		 integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



        <!-- fin nouveaux scripts -->

        <script>
            $(document).ready(function() {

                //var table = $('#example').DataTable();

                $('#example tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');
                    }
                    else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                } );

                $('#button').click( function () {
                    table.row('.selected').remove().draw( false );
                } );


                var table = $('#example').DataTable( {
                        responsive: true,
                        "paging":true,
                        "ordering": true,
                        "info":     false,
                        "searching": true,
                         "pageLength": 5,
                         "lengthMenu":[5,10,15],
                         "lengthChange":false,
                         //"pagingType": "full_numbers",
                         //"scrollY":        "200px",
                        // "scrollCollapse": true,
                         "language": {
                        "decimal": ",",
                        "thousands": "."
                        },
                        "language": {
                            "lengthMenu": "Nombre _MENU_ records per page",
                            "zeroRecords": "Nothing found - sorry",
                            "info": "Affichage page _PAGE_ of _PAGES_",
                            "infoEmpty": "No records available",
                            "infoFiltered": "(filtered from _MAX_ total records)"
                        },


                    //rendre des colonnes invisibles
                      /*   "columnDefs": [
                            {
                                "targets": [ 2 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 5 ],
                                "visible": false
                            }
                        ]
                            */
                        /* fussion des colonnes
                        "columnDefs": [
                            {
                                // The `data` parameter refers to the data for the cell (defined by the
                                // `data` option, which defaults to the column being worked with, in
                                // this case `data: 0`.
                                "render": function ( data, type, row ) {
                                    return data +' ('+ row[3]+')';
                                },
                                "targets": 0
                            },
                            { "visible": false,  "targets": [ 3 ] }
                        ]
                        */

                    } )
                    .columns.adjust()
                    .responsive.recalc();


            } );



        </script>

    </body>
</html>
