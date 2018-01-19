function noGustaProducto(id,user){

	$.get("../model/borrarDeseos.php?id="+id+"&user="+user, function(data) {

	    $('#listaDeseos').load('../include/listaDeseos.php?usuario='+user);

	});
}