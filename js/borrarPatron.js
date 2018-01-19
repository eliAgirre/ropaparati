function borrarPatron(id,user){

    $.get("../model/borrarPatron.php?id="+id, function(data) {

        //$('#fila_'+id).remove();
        $('#misPatrones').load('../include/listaPatrones.php?usuario='+user);

    });
}