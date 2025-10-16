$(".table").DataTable({
    ordering: false,
    pageLength: 10, // 👈 Puedes ajustar este valor
    lengthMenu: [ [10, 25, 50], [10, 25, 50] ],
    language: {
        search: "Buscar:",
        emptyTable: "No hay datos disponibles en la tabla",
        zeroRecords: "No se encontraron resultados",
        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        infoEmpty: "Mostrando 0 a 0 de 0 entradas",
        infoFiltered: "(filtrado de _MAX_ entradas totales)",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        },
        loadingRecords: "Cargando...",
        lengthMenu: "Mostrar _MENU_ entradas"
    }
});

//Editar Etapa
$(".table").on('click', '.btnEditarEtapa', function() {
 var idEtapa = $(this).attr('idEtapa');
 $.ajax({
     url: 'Editar-Etapa/' + idEtapa,
     type: 'GET',
     success: function(Etapa) {
            $("#id_etapa").val(Etapa.id_e);
            $("#nombre_etapa").val(Etapa.nombre_e);
            $("#fecha_inicio_etapa").val(Etapa.fecha_inicio_e);
            $("#fecha_fin_etapa").val(Etapa.fecha_fin_e);
     },
     error: function(xhr, status, error) {
         console.error("Error al cargar el formulario de edición:", error);
     }
 });
});