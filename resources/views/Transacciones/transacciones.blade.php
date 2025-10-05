@extends('layouts.base')
@section('title', 'Transacciones')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="row text-center">
            <h4 class="col-12  text-center p-3 text-center titulo_central"><b>Transacciones Realizadas</b>
            </h4>

            <table id="historial" class=" table table-striped table-hover" style="width:100%; font-size: 0.8rem">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Usuario emisor</th>
                        <th>Usuario receptor</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/dataTables/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        $(document).ready(function() {
            historial(false);
        });

        const exportar = () => {
               window.location.href = "{{ route('exportar-csv') }}";
        };

        const historial = (pagina) => {
            let url = '{{ route('listar-transacciones') }}';
            let token = $('meta[name="csrf-token"]').attr('content');
            $('#historial').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                order: [],
                paging: true,
                dom: "<'form-group row'>" +
                    "<'row justify-content-around'<'col-4'l><'col-2'B><'col-2'f>>" +
                    "<'row'tr>" +
                    "<'row justify-content-around pt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-5'p>>",
                buttons: [{
                        extend: 'csv',
                        text: 'Exportar CSV',
                        className: 'btn btn-outline-primary',
                        action: function() {
                            exportar();
                        }
                    },


                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                ajax: {
                    "url": url,
                    "type": "POST",
                    "data": {
                        "_token": token,
                        // "_method": "POST",
                        // "tipo_grado": tipo_grado,
                        // "anio_seleccionado": anio_seleccionado,

                    },
                },


                columns: [{
                        data: 'INDEX',
                        name: 'INDEX',
                        className: 'text-justify',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'user_emisor',
                        name: 'user_emisor',
                    },
                    {
                        data: 'user_receptor',
                        name: 'user_receptor',
                    },
                    {
                        data: 'monto',
                        name: 'monto',
                    },
                    {
                        data: 'fecha',
                        name: 'fecha',
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                    },


                ],
                initComplete: function(row, data, start, end, display) {

                },

            });
        }
    </script>
@endsection
