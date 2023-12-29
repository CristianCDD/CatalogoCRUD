<?php
include("../conexion.php");

if (isset($_POST["id_usuario"])) {
    $idUsuario = $_POST["id_usuario"];

    $stmt = $con->prepare("SELECT 
        p.id AS producto_id, 
        p.marca AS producto_marca, 
        f.filename AS archivo_filename,
        f.id AS archivo_id
        FROM productos AS p 
        INNER JOIN productos_files AS pf ON pf.producto_id = p.id 
        INNER JOIN files AS f ON f.id = pf.file_id
    WHERE p.id = ? ");

    $stmt->bind_param("i", $idUsuario);

    $stmt->execute();

    // Obtén un array asociativo como resultado
    $resultado = $stmt->get_result();

    // Verifica si hay resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        
        $nombreArchivo = $fila["archivo_filename"];
        $idArchivo = $fila["archivo_id"];


        // Ruta completa al archivo a eliminar
        $rutaArchivo = "../../upload/" . $nombreArchivo;

        unlink($rutaArchivo);

        $stmt = $con->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $idUsuario);
    
        // Prepara la consulta para eliminar el registro de la tabla `files`
        $stmt2 = $con->prepare("DELETE FROM files WHERE id = ?");
        $stmt2->bind_param("i", $idArchivo);
    
        // Ejecuta ambas consultas de eliminación
        $resultado1 = $stmt->execute();
        $resultado2 = $stmt2->execute();

        if ( $resultado1 &&  $resultado2) {
            echo "Registro borrado";
        } else {
            echo "No se pudo borrar el registro";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}
?>
