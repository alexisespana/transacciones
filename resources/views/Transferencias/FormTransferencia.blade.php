@extends('layouts.base')
@section('title', 'Transacciones')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')

    <div class="row">
        Seleccione Contacto:
        <div class="col-md-6">

            <select class="form-select mb-3 contacto">
                <option disabled selected >Open this select menu</option>
                @foreach ($usuarios as $user)
                    @foreach ($user->contactos as $conts)
                        <option value="  {!! $conts->usuarios->id !!}"> {!! $conts->usuarios->nombres !!}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>

    <div class=" d-none pt-5 saldo">
        <div class="card text-center">
            <div class="card-header">
                Saldo disponible para Transferir
            </div>
            <div class="card-body text-center">
                <form class="row center">
                    <div class="col-auto">
                        <label for="monto" class="">Ingrese Monto:</label>
                        <input type="text" class="form-control" id="monto" name="monto">
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted pt-3">
                <button type="button" class="btn btn-primary m-3 enviar">enviar</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.contacto').change(function() {
            $('.saldo').removeClass('d-none')
        });


           // ---------------ACCION PARA EDITAR UN CENTRO DE COSTO ---------------------

        $(document).on('click', '.enviar', function(event) {

            let monto = $('#monto').val()
            let contacto = $(".contacto option:selected").val();
            console.log(event);
            axios.post("{{ route('enviar-transferencia') }}", {
                    monto: monto,
                    contacto: contacto
                })
                .then(response => {

                    $('#modalCentroCosto').modal('show');
                    $('#modalCentroCosto').find('.modal-body').empty().append(response.data);
                    $('#modalCentroCosto').find('.modal-footer').find('button.CrearCC').addClass(
                        'd-none');
                    $('#modalCentroCosto').find('.modal-footer > button.enviar').removeClass(
                        'enviar').addClass(
                        'modificarCC');

                    $('.selectpicker').selectpicker();

                })
                .catch(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio mal!',
                    });

                });

        });
    </script>
@endsection
