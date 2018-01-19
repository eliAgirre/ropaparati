<!-- Top HTML admin -->                    
<?php include_once("../../include/topHtmlAdmin.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Añadir producto </title>
        <?php include("../../include/elementsHeadAdmin.html"); ?>
        <!--<script type="text/javascript" src="../../js/imagenProducto.js"></script>   JS Canvas-->
        <script>
        var cont=0;
        function obtainColection() {
            var coleccion=$("#nameColec option:selected").val();
            if(cont>0){
                $('#categoria').empty().append('#selectCategoria');
                cont=0;
            }
            else{
                cont=cont+1;
                if(coleccion=="Fendi-Pre-Fall"){
                    var mujer = [
                      {val : 'Tops', text: 'Tops'},
                      {val : 'PantalonesM', text: 'PantalonesM'},
                      {val : 'Vestidos', text: 'Vestidos'},
                      {val : 'Faldas', text: 'Faldas'},
                    ];
                    var select = $('#categoria').appendTo('#selectCategoria');
                    $(mujer).each(function() {
                        select.append($("<option>").attr('value',this.val).text(this.text));
                    });
                }
                else{
                    var hombre = [
                      {val : 'Sudaderas', text: 'Sudaderas'},
                      {val : 'Camisetas', text: 'Camisetas'},
                      {val : 'PantalonesH', text: 'PantalonesH'},
                      {val : 'Chalecos', text: 'Chalecos'},
                    ];
                    var select = $('#categoria').appendTo('#selectCategoria');
                    $(hombre).each(function() {
                        select.append($("<option>").attr('value',this.val).text(this.text));
                    });
                }
            }
        }
        function obtainCategoria() {
            var categoria=$("#categoria option:selected").val();
            $("#categoria option[value='" + categoria + "']").attr("selected","selected");
            //alert(categoria);
        }
        </script>
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../../include/headerAdmin.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../../include/menuAdmin.html"); ?>

            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 
                
                <div id="mostrarMsg"> </div> <!-- Muestra los mensajes flash desde el ajax -->
                <?php echo $msg->display(); ?> <!-- Muestra el mensaje flash -->
                <h2> Añadir producto </h2>
                <div id="formProducto"><!-- Añadir producto -->
                    <form method="post" role="form" action="../../../model/admin/anadirProducto.php">
                        <!--Input Nombre producto -->
                        <div class="form-group">
                            <label for="product">Nombre del producto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nombreProducto" placeholder="Nombre producto" required>
                            </div>
                        </div><br />
                        <!--Input descripción -->
                        <div class="form-group">
                            <label for="product">Descripción</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción" required></textarea>
                            </div>
                        </div><br />
                        <!--select colección -->
                        <div class="form-group">
                            <label for="product">Colección</label>
                            <div id="selectColec" class="input-group">
                            <?php 
                                // Se importa la conexión con la base de datos
                                require_once '../../config/database.php';
                                $db = new Database();
                                $db->connect();
                                // Sentencia SELECT
                                $sql="SELECT * FROM colecciones";
                                $select=$db->select($sql);?>
                                <select name="nameColec" id='nameColec' onfocusout='obtainColection()' required><?php
                                // Si la tabla tiene resultados
                                if($select){
                                    // Se muestran los datos de cada usuario
                                    foreach ($select as $key => $valor) {
                                        foreach ($valor as $campo => $value) {
                                            if($campo==="nombreColeccion"){
                                                echo "<option value=".$value." selected='selected;'>".$value."</option>";
                                            }
                                        }
                                    }

                                }// Cierre de if si tiene resultados
                            ?></select>
                            </div>
                        </div><br />
                        <!--select categoria -->
                        <div class="form-group">
                            <label for="product">Categoría</label>
                            <div id="selectCategoria" class="input-group">
                                <select name="categoria" id='categoria' onfocusout='obtainCategoria()' required>
                                </select>
                            </div>
                        </div><br />
                        <!--Input precio -->
                        <div class="form-group">
                            <label for="product">Precio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="precio" placeholder="Precio" required>
                            </div>
                        </div><br />
                        <button id="anadir" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Añadir</button>
                        <br/>
                    </form>
                </div><!-- Cierre del formulario añadir producto -->
                              
            </section> 
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../../include/darAlta.html"); ?>            
         </div> <!-- Cierre div del container -->
	</body>	
</html>