function borrarColec(id){

    $.get("../../model/admin/borrarColec.php?id="+id, function(data) {

        $('#fila_'+id).remove();

    });
}