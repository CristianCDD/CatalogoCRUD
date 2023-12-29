<?php
include("../conexion.php");

if(isset($_POST["id_usuario"])){
    $salida = array();
    
    // Utiliza la conexión MySQLi ($con) en lugar de la variable no utilizada ($conexion)
    $stmt = $con->prepare("SELECT 
    productos.id, 
    marca, 
    precio, 
    descripcion,
    GROUP_CONCAT(files.filename) AS filename,
     distribuidor, tallas FROM productos
       INNER JOIN productos_files ON productos_files.producto_id = productos.id
       INNER JOIN files ON productos_files.file_id = files.id
       WHERE productos.id = ?");
    
    // Enlaza el valor de $_POST["id_usuario"] como un parámetro
    $stmt->bind_param("i", $_POST["id_usuario"]);
    
    $stmt->execute();
    
    // Obtén un array asociativo como resultado
    $resultado = $stmt->get_result();
    
    foreach ($resultado as $fila) {
        $salida["id_usuario"] = $fila["id"];
        $salida["marca"] = $fila["marca"];
        $salida["precio"] = $fila["precio"];
        $salida["descripcion"] = $fila["descripcion"];
        $salida["distribuidor"] = $fila["distribuidor"];

        
        $salida['filename'] = explode(',', $fila['filename']);

        $salida["tallas"] = $fila["tallas"];
        if ($fila["filename"] != "") {
            $imagenes = explode(',', $fila['filename']);
            $imagen_html = '';
            $count = 0;
            foreach ($imagenes as $imagen) {
                $count++;
                $imagen_html .= '<img src="./upload/' . $imagen . '" class="img-thumbnail" width="100" height="50" /> <input type="hidden" id="imgOculta" name="imagen_usuario_oculta'.$count.'" value="' . $imagen . '" />';

            }
        
            $salida["imagen_usuario"] = $imagen_html;
        } else {
            $salida["imagen_usuario"] = '<input type="hidden" id="imgOculta" name="imagen_usuario_oculta" value="'.$fila["filename"].'" />';
        }
    }
    
    echo json_encode($salida);
}
?>

