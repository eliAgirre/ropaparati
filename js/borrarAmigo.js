function noAmigo(id,user){

	$.get("../model/borrarAmigo.php?id="+id+"&user="+user, function(data) {

	    $('#listaAmigos').load('../include/listaAmigos.php?usuario='+user);

	});
}