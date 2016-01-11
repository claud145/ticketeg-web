(function($) {
    $(function() {
        $("#logotiposcroll").parent().hide();
        $('.button-collapse').sideNav();
         

    }); // end of document ready
})(jQuery); // end of jQuery name space



$(window).scroll( function() {

    if( $(this).scrollTop() >150) { 
        //$( "#logoscroll" ).hide();
        $("#logoscroll").parent().fadeOut( "slow" );
        $("#logotiposcroll").parent().show();
    }
    else {
         $("#logoscroll").parent().fadeIn( 2000 );
         $("#logotiposcroll").parent().fadeOut( "slow" );
    }
});

 
        



$(document).ready(function() {
    $('select').material_select();
});

$('.button-collapse').sideNav({
    menuWidth: 240, // Default is 240
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
});

$(document).ready(function() {

   var options = [
    {selector: '.content-cartelera', offset: 250, callback: 'Materialize.fadeInImage(".content-cartelera")' }
  ];
  Materialize.scrollFire(options);


    $('#codigo_venta').focus();

    $('#cliente-samsung').click(function() {
        if ($('#cliente-samsung').is(':checked')) {
            $('#email-samsung').removeAttr('disabled');
            $('#email-samsung').focus();
        } else {
            $('#email-samsung').val('').attr('disabled', 'disabled');
        }
    });
    
    $('.collapsible').collapsible({
        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd',
  });

    $('#codigo_venta', '#entrada_fisica').keypress(function(e) {
        var keyCode = e.keyCode;

        if (keyCode == 13) {
            e.preventDefault();

            var $this = $(this);
            var $mensaje = $('#mensaje', '#entrada_fisica');
            var $validacion = $('#validacion', '#entrada_fisica');
            var codigos = '';

            $('tr[codigos]', '#entrada_fisica').each(function(){
                if (codigos !== '')
                    codigos += '|';

                codigos += $(this).attr('codigos');
            });

            $mensaje.text('');
            $validacion.text('');

            $.ajax({
                data: {
                    codigo_venta: $this.val(),
                    codigos: codigos
                },
                url: 'ventaEntradaFisica',
                type: 'post',
                async: false,
                success:  function (data) {
                    if(data.exito) {
                        var $tbody = $('#lista_sector tbody', '#entrada_fisica');
                        var $trSector = $('#codigos_' + data.datos.id_sector, $tbody);

                        data.datos.precio_sector = parseFloat(data.datos.precio_sector);

                        if ($trSector.length === 0) {
                            var trSector = '<tr id="codigos_' + data.datos.id_sector + '" codigos="' + data.datos.id + '">';
                            trSector += '<td>' + data.datos.nombre_sector + '</td>';
                            trSector += '<td>' + data.datos.precio_sector.toFixed(2) + '</td>';
                            trSector += '<td id="cantidad_' + data.datos.id_sector + '">1</td>';
                            trSector += '<td id="subtotal_' + data.datos.id_sector + '"class="right-align">' + data.datos.precio_sector.toFixed(2) + '</td>';
                            trSector += '</tr>';

                            $tbody.append(trSector);
                        } else {
                            var $cantidad = $('#cantidad_' + data.datos.id_sector, $trSector);
                            var $subtotal = $('#subtotal_' + data.datos.id_sector, $trSector);

                            codigos = $trSector.attr('codigos') + '|' + data.datos.id;
                            cantidad = parseInt($cantidad.text()) + 1;
                            subtotal = data.datos.precio_sector * cantidad;

                            $trSector.attr('codigos', codigos);
                            $cantidad.text(cantidad);
                            $subtotal.text(subtotal.toFixed(2));
                        }

                        var $total = $('#total', '#entrada_fisica');
                        var total = data.datos.precio_sector + parseFloat($total.text());

                        $total.text(total.toFixed(2));
                    } else {
                        $mensaje.text(data.mensaje);
                    }
                }
            });
            
            $this.val('').focus();
        }
    });

    $('#boton-vender', '#entrada_fisica').click(function() {
        var $total = $('#total', '#entrada_fisica');

        $('#modal4-mensaje', '#entrada_fisica').html('Confirma que se realizará la compra por un total de <b>' + $total.text() + ' Bs.-</b>');
    });

    $('#rSi', '#entrada_fisica').click(function() {
        var $mensaje = $('#mensaje', '#entrada_fisica');
        var $validacion = $('#validacion', '#entrada_fisica');
        var $total = $('#total', '#entrada_fisica');
        var total = parseFloat($total.text());

        $mensaje.text('');
        $validacion.text('');

        if (total > 0) {
            var $clienteSamsung = $('#cliente-samsung', '#entrada_fisica');

            if ($clienteSamsung.is(':checked')) {
                var $emailSamsung = $('#email-samsung', '#entrada_fisica');
                var emailSamsung = $.trim($emailSamsung.val());

                if (emailSamsung != '') {
                    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if (expr.test(emailSamsung))
                        ventaEntregar();
                    else
                        $validacion.text('La dirección de correo es incorrecta');
                }
                else
                    $validacion.text('La dirección de correo es requerida para los clientes samsung plus');
            }
            else
                ventaEntregar();
        }
        else
            $validacion.text('El monto a cobrar debe ser mayor a 0');
    });
});

function ventaEntregar() {
    var $mensaje = $('#mensaje', '#entrada_fisica');
    var $validacion = $('#validacion', '#entrada_fisica');
    var $botonVender = $('#boton-vender', '#entrada_fisica');
    var codigos = '';

    $('tr[codigos]', '#entrada_fisica').each(function(){
        if (codigos !== '')
            codigos += '|';

        codigos += $(this).attr('codigos');
    });

    $mensaje.text('');
    $validacion.text('');
    $botonVender.css('display', 'none');

    $.ajax({
        data: {
            codigos: codigos,
            cliente_samsung: ($('#cliente-samsung', '#entrada_fisica').is(':checked') ? 1 : 0),
            email_samsung: $('#email-samsung', '#entrada_fisica').val()
        },
        url: 'ventaEntregar',
        type: 'post',
        async: false,
        success:  function (data) {
            if(data.exito)
                location.reload(true);
            else {
                $validacion.text(data.mensaje);
                $botonVender.removeAttr('style');
            }
        }
    });
}

$(document).ready(function() {
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});

$("#addsectores").click(function() {
    var nombreSector = $("#nombre_sector").val();
    var precioSector = $("#precio_sector").val();

    $(".collection").append("<li class='collection-item'>" + nombreSector + "-" + precioSector + "Bs <a id='removelist' href='#!' class='removelist secondary-content'><i class='material-icons'>delete</i></a> </li>");
});


$(document).ready(function() {
    $('.materialboxed').materialbox();

    $(document).ready(function() {//debugger;
        $('#rYes').click(function() {
            $("form[role='form']").submit();
            // add loading image to div
            if ($('#terminos').is(':checked')) {
                $('#button').css("display", "none");
                $('#checkbox').css("display", "none");
                $('#preloader').css("display", "");
            }
        });
    });
});

$("user_telefono").keyup(function() {
    $("#user_telefono").val(this.value.match(/[0-9]*/));
});