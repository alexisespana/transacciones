@extends('layouts.base')
@section('title', 'Transacciones')
@section('css')
@endsection
@section('content')

    <div class="row">
        Seleccione Contacto:
        <div class="col-md-6">

            <select class="form-select mb-3 contacto">
                <option disabled selected>Open this select menu</option>
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
                Saldo disponible para Transferir: <h4>{{ $saldo }}</h4>
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



        $(document).on('click', '.enviar', function(event) {

            $(".enviar").attr("disabled", true);

            let monto = $('#monto').val()
            let contacto = $(".contacto option:selected").val();

            axios.post("{{ route('enviar-transferencia') }}", {
                    monto: monto,
                    contacto: contacto
                })
                .then(response => {
                    $(".enviar").removeAttr("disabled");

                    let data = response.data;
                    // console.log(data);
                    toastr.options.positionClass = "toast-top-center";
                    toastr.options.showMethod = 'slideDown';

                    toastr.success(data.message, 'Exito', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000, // Duración en milisegundos
                        onHidden: function() {
                            // Redirigir cuando el toastr se cierra
                            window.location.href = response.data.redirect;;
                        }
                    });

                })
                .catch(e => {
                    $(".enviar").removeAttr("disabled");
                    if (e.request.status == 422) {

                        var error = e.response.data;

                        let errores = '<ul class="text-left">';
                        error.data.forEach(function(v, i) {
                            // console.log(v);
                            errores += '<li>' + v + '</li>';
                        });
                        errores += '</ul>';
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.showMethod = 'slideDown';
                        toastr.error(errores, 'error!');
                    }

                });

        });
    </script>
@endsection
