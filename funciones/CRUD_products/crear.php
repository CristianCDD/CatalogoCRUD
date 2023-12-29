<?php
include("../conexion.php");

if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    $imagen2 = ''; // Nuevo campo para el segundo archivo
    $arreglo = [];

    // Verifica si se ha subido un archivo para el primer campo (imagen_usuario)
    if (isset($_FILES["imagen_usuario"]["name"])) {
        $nombreArchivo = $_FILES["imagen_usuario"]["name"];

        // Genera un número aleatorio entre 1000 y 9999
        $numeroAleatorio = rand(1000, 9999);

        // Genera dos letras aleatorias
        $letrasAleatorias = chr(rand(65, 90)) . chr(rand(65, 90));

        // Concatena el número aleatorio y las letras aleatorias al nombre del archivo
        $nombreArchivo = $numeroAleatorio . $letrasAleatorias . "_" . $nombreArchivo;

        $imagen = $nombreArchivo;

        // Mueve el archivo subido a la ubicación deseada en el servidor
        $archivoTempPath = $_FILES["imagen_usuario"]["tmp_name"];
        $rutaImagen = "../../upload/" . $nombreArchivo;

        $direcSystem = "./upload/" . $imagen; // Cambiar según tus necesidades
        $direcWeb = "http://localhost/catalogo/upload/" . $imagen; // Cambiar según tus necesidades

        move_uploaded_file($archivoTempPath, $rutaImagen);
    }

    // Verifica si se ha subido un archivo para el segundo campo (imagen_usuario2)
    if (isset($_FILES["imagen_usuario2"]["name"]) && !empty($_FILES["imagen_usuario2"]["name"])) {
        $nombreArchivo2 = $_FILES["imagen_usuario2"]["name"];
       
        // Genera un número aleatorio entre 1000 y 9999
        $numeroAleatorio2 = rand(1000, 9999);

        // Genera dos letras aleatorias
        $letrasAleatorias2 = chr(rand(65, 90)) . chr(rand(65, 90));

        // Concatena el número aleatorio y las letras aleatorias al nombre del archivo
        $nombreArchivo2 = $numeroAleatorio2 . $letrasAleatorias2 . "_" . $nombreArchivo2;

        $imagen2 = $nombreArchivo2;

        // Mueve el archivo subido a la ubicación deseada en el servidor
        
        $archivoTempPath2 = $_FILES["imagen_usuario2"]["tmp_name"];
        $rutaImagen2 = "../../upload/" . $nombreArchivo2;

        $direcSystem2 = "./upload/" . $imagen2; // Cambiar según tus necesidades
        $direcWeb2 = "http://localhost/catalogo/upload/" . $imagen2; // Cambiar según tus necesidades

        move_uploaded_file($archivoTempPath2, $rutaImagen2);
    }

    // Utiliza sentencias preparadas para evitar SQL Injection
    $sql = "INSERT INTO productos (marca, precio) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sd", $_POST["marca"], $_POST["precio"]);
    $resultado = $stmt->execute();

    $sql2 = "INSERT INTO files (filename, web_path, system_path) VALUES (?, ?, ?)";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("sss", $imagen, $direcSystem, $direcWeb);
    $resultado2 = $stmt2->execute();

    // Inserta el segundo archivo en la base de datos
    $resultCondicion = false;
    if ($imagen2 != '') {
        $sql3 = "INSERT INTO files (filename, web_path, system_path) VALUES (?, ?, ?)";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("sss", $imagen2, $direcSystem2, $direcWeb2);
        $resultado3 = $stmt3->execute();
        $resultCondicion = true;
    }
 

    if ($resultado && $resultado2 || $resultado3) {
        // Obtén el último ID insertado en la tabla 'productos'
        $ultimoIDProducto = $stmt->insert_id;

        // Obtén el último ID insertado en la tabla 'files' para el primer archivo
        $ultimoIDFile = $stmt2->insert_id;

        // Obtén el último ID insertado en la tabla 'files' para el segundo archivo
        if($resultCondicion){
            $ultimoIDFile2 = $stmt3->insert_id;

        }

        // Inserta relaciones entre productos y archivos
        $sql4 = "INSERT INTO productos_files (producto_id, file_id) VALUES (?, ?)";
        $stmt4 = $con->prepare($sql4);
        $stmt4->bind_param("ii", $ultimoIDProducto, $ultimoIDFile);
        $resultado4 = $stmt4->execute();

        // Inserta la relación para el segundo archivo
        if($resultCondicion){
            $sql5 = "INSERT INTO productos_files (producto_id, file_id) VALUES (?, ?)";
            $stmt5 = $con->prepare($sql5);
            $stmt5->bind_param("ii", $ultimoIDProducto, $ultimoIDFile2);
            $resultado5 = $stmt5->execute();
        }
       
      

        if ($resultado4 || $resultado5) {
            echo "Productos y archivos creados con éxito";
        } else {
            echo "Error al crear relaciones entre productos y archivos";
        }
    } else {
        echo "Error al crear el registro en productos o files";
    }
}


if ($_POST["operacion"] == "Editar") {
  
    /*   $imagen = '';
      if($_FILES["imagen_usuario"]["name"] != ""){
          $nombreArchivo = $_FILES["imagen_usuario"]["name"];
          $imagen = $nombreArchivo;
      }else{
          $imagen = $_POST["imagen_usuario_oculta1"];
      }
  
      echo $imagen; */
  
      if($_FILES["imagen_usuario"]["name"] != ""){
          $nombreArchivo = $_FILES["imagen_usuario"]["name"];
          $imagen = $nombreArchivo;
      }else{
          $imagen = $_POST["imagen_usuario_oculta1"];
      }
  
      $rutaImagen = "../../upload/" . $imagen;
      $direcWeb = "http://localhost/catalogo/upload/" . $imagen;
      move_uploaded_file($_FILES["imagen_usuario"]["tmp_name"], $rutaImagen);
  
      $sql = "UPDATE productos
          INNER JOIN productos_files ON productos.id = productos_files.producto_id
          INNER JOIN files ON files.id = productos_files.file_id
          SET productos.marca = ?,
              productos.precio = ?,
  
  
              files.filename = ?,
              files.web_path = ?,
              files.system_path = ?
  
          WHERE productos.id = ?";
  
  $stmt = $con->prepare($sql);
  $valorSystemPath = "/catalogo/upload/" . $imagen;
  if ($stmt) {
      $stmt->bind_param("sdsssi", $_POST["marca"], $_POST["precio"], $imagen, $valorSystemPath, $direcWeb,  $_POST["id_usuario"]);
      $resultado = $stmt->execute();
  
      if ($resultado) {
          echo "Producto actualizado correctamente";
      } else {
          echo "Error al actualizar el producto: " . $stmt->error;
      }
  
      $stmt->close();
  } else {
      echo "Error en la preparación de la consulta: " . $con->error;
  }
  
  $con->close();
  
  
  
  
      
  }
