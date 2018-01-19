function borrarProduct(id){

    $.get("../../model/admin/borrarProduct.php?id="+id, function(data) {

        $('#fila_'+id).remove();

    });
}