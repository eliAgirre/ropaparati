$(document).ready(function() {

	$(".editProduct").click(function(event){
		// Se obtiene el código de barras
		var codigo=$(this).attr("data-codigo");
		// Se obtiene la ventana modal - editarProducto
		var modal=$("#editarProducto");
		// Se escribe en el placehold del input el código
		modal.find('.modal-body #cod').val(codigo);

		event.preventDefault();

		$.ajax({

			type: "POST",
			url: "../../model/admin/editarProduct.php",
			data: {

	        	codBarra: codigo

	    	},

			// función que se ejecutará cuando obtengamos la respuesta
			success:function(data){

				var producto=jQuery.parseJSON(data); // String data se convierte en un objeto JSON
				// Se recorre el objecto y muestra en cada input correspondiente
		  		$.each(producto, function(key, value){
					
					modal.find('.modal-body #nameProduct').val(value.producto);
					modal.find('.modal-body #descrip').val(value.descripcion);
					modal.find('.modal-body #precio').val(value.precio);
					modal.find('.modal-body #colecEdit').val(value.coleccion);
				});
			}
		}); // Cierre del Ajax
			  
	}); // Cierre de click
});