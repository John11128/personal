//Editar Protagonista
$(".table").on("click", ".btnEditarProtagonista", function() {
    var idProtagonista = $(this).attr("idProtagonista");

    $.ajax({
        url: 'Editar-Protagonista/' + idProtagonista,
        type: 'GET',
        success: function(response) {
            var protagonista = response.protagonista;
            $("#idProtagonista").val(protagonista.id_p);
            $("#cedulaProtagonista").val(protagonista.cedula_p);
            $("#nombreProtagonista").val(protagonista.nombres_p);
            $("#apellidoProtagonista").val(protagonista.apellidos_p);
            $("#sexoProtagonista").val(protagonista.sexo_p);
            $("#direccionProtagonista").val(protagonista.direccion_p);
            $("#fechaNacimientoProtagonista").val(protagonista.fecha_nacimiento_p);
            $("#estadocivilProtagonista").val(protagonista.estado_civil_p);
            $("#profesionProtagonista").val(protagonista.profesion_p);
            $("#centrolaboralProtagonista").val(protagonista.centro_laboral_p);
            $("#ingresoeconomicoProtagonista").val(protagonista.ingreso_economico_p);
            $("#nivelacademicoProtagonista").val(protagonista.nivel_academico_p);
            $("#numerodehijosProtagonista").val(protagonista.numero_de_hijos_p);
            $("#fechadenacimientoProtagonista").val(protagonista.fecha_nacimiento_p);
            $("#telefonoProtagonista").val(protagonista.telefono_p);
            $("#correorotagonista").val(protagonista.correo_p);

            // Limpiar listas actuales
            $("#contactos-list-editar").empty();
            $("#emails-list-editar").empty();

            // Agregar teléfonos existentes
            response.telefonos.forEach(function(telefono) {
                var tag = $('<span class="label label-info" style="margin-right:5px;">'+telefono+'<input type="hidden" name="contactos[]" value="'+telefono+'"><span style="cursor:pointer;" onclick="$(this).parent().remove()"> ×</span></span>');
                $("#contactos-list-editar").append(tag);
            });

            // Agregar correos existentes
            response.correos.forEach(function(correo) {
                var tag = $('<span class="label label-primary" style="margin-right:5px;">'+correo+'<input type="hidden" name="emails[]" value="'+correo+'"><span style="cursor:pointer;" onclick="$(this).parent().remove()"> ×</span></span>');
                $("#emails-list-editar").append(tag);
            });

            $("#modalEditarProtagonista").modal('show');
        }
    });
});

// Eliminar contacto
$(document).on('click', '.btn-remove-contacto', function() {
    $(this).closest('.contacto-item').remove();
});

// Eliminar correo
$(document).on('click', '.btn-remove-email', function() {
    $(this).closest('.email-item').remove();
});

// Agregar contacto
$("#add-contacto-editar").on("click", function() {
    var val = $("#contacto-input-editar").val().trim();
    if(val && /^[0-9]+$/.test(val)) {
        var html = '<div class="input-group mb-2 contacto-item">'+
            '<input type="text" name="contactos[]" value="'+val+'" class="form-control">'+
            '<span class="input-group-btn">'+
            '<button type="button" class="btn btn-danger btn-remove-contacto">&times;</button>'+
            '</span></div>';
        $("#contactos-list-editar").append(html);
        $("#contacto-input-editar").val('');
    } else {
        alert('Solo se permiten números en el teléfono');
    }
});

// Agregar correo
$("#add-email-editar").on("click", function() {
    var val = $("#email-input-editar").val().trim();
    if(val) {
        var html = '<div class="input-group mb-2 email-item">'+
            '<input type="email" name="emails[]" value="'+val+'" class="form-control">'+
            '<span class="input-group-btn">'+
            '<button type="button" class="btn btn-danger btn-remove-email">&times;</button>'+
            '</span></div>';
        $("#emails-list-editar").append(html);
        $("#email-input-editar").val('');
    }
});

// Solo permite números en el input de teléfono
$(document).on('input', '#contacto-input-editar', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// También para los inputs dinámicos ya agregados
$(document).on('input', 'input[name="contactos[]"]', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Solo permite números en el input de teléfono al agregar
$(document).on('input', '#contacto-input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Validación al agregar contacto
$("#add-contacto").on("click", function() {
    var val = $("#contacto-input").val().trim();
    if(val && /^[0-9]+$/.test(val)) {
        var tag = $('<span class="label label-info" style="margin-right:5px;">'+val+'<input type="hidden" name="contactos[]" value="'+val+'"><span style="cursor:pointer;" onclick="$(this).parent().remove()"> ×</span></span>');
        $("#contactos-list").append(tag);
        $("#contacto-input").val('');
    } else {
        alert('Solo se permiten números en el contacto');
    }
});

