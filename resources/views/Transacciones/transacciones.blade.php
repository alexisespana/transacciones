@extends('layouts.base')
@section('title', 'Transacciones')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')

    <div class="row">
        <div class="row text-center">
            <h4 class="col-12  text-center p-3 text-center titulo_central"><b>Mi Historial</b>
            </h4>
        
            <table id="letras" class=" table table-striped table-hover" style="width:100%; font-size: 0.8rem">
                <thead class="thead-light">
                    <tr>
                        <th>n_alumno</th>
                        <th>rut</th>
                        <th>fecha matricula</th>
                        <th>estado</th>
                        <th>ano</th>
                        <th>cohorte_alumno</th>
                        <th>tipo_matricula</th>
                        <th>nombre alumno</th>
                        



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
    <script>
        $(document).ready(function() {
             $('#letras').DataTable();
        });
    </script>
@endsection
