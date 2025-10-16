$(".selectRol").change(function() {
    var rol = $(this).val();

    if (rol != "Administrador") {
        $(".SelectDisciplina").show();
    }else {
        $(".SelectDisciplina").hide();
    }
} );

$(".table").on("click", ".btnEstadoUser", function(){

var Uid = $(this).attr("Uid");
var estado = $(this).attr("estado");

$.ajax({
    url: 'Cambiar-Estado-Usuario/'+Uid+'/'+estado,
    type: 'GET',
    success: function(){

        if(estado == 0){
            $(this).removeClass("btn-success").addClass("btn-danger").attr("estado", 1).text("Deshabilitado");
        }else{
            $(this).removeClass("btn-danger").addClass("btn-success").attr("estado", 0).text("Habilitado");
        }
    }.bind(this)
}
);

});

$(".table").on("click", ".btnEditarUsuario", function(){
    var Uid = $(this).attr("idUsuario");
    $.ajax({
        url: 'Editar-Usuario/'+Uid,
        type: 'GET',
        success: function(respuesta){
            
                $('#nameEditar').val(respuesta.name);
                $('#emailEditar').val(respuesta.email);
                $('#rolEditar').val(respuesta.roll);
                $('#idEditar').val(respuesta.id);

        }
    })
}
)



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$("#emailEditar").change(function() {
    var emailVerificar = $(this).val();
    var idUser = $("#idEditar").val();
    $(".alert").remove();
    $.ajax({
        url: 'Verificar-Usuario',
        type: 'POST',
        data: {
            email: emailVerificar,
            id: idUser
        },
        success: function(respuesta) {
                console.log(respuesta['emailVerificacion']);
            if(respuesta['emailVerificacion'] == false){
                $("#emailEditar").parent().after('<div class="alert alert-danger">El correo ya está Registrado</div>');
                $("#emailEditar").val("");
            }

        }
    })
})


$(".table").on("click", ".btnEliminarUsuario", function(){
var Uid= $(this).attr("idUsuario");

Swal.fire({
    title: '¿Seguro de qué deseas Eliminar el Usuario?',
    icon: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Eliminar',
    confirmButtonColor: '#3085d6',
}).then((result)=>{
    if(result.isConfirmed){
        window.location = "Eliminar-Usuario/"+Uid;
    }
})
})