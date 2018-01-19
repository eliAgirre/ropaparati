function eliminar(id){

    $.get("../../model/admin/borrarUser.php?id="+id, function(data) {

        $('#fila_'+id).remove();

    });
}