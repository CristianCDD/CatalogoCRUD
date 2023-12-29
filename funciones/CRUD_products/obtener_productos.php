<?php

include("../conexion.php");

// Consulta SQL para obtener los registros de productos
$query = "SELECT * FROM productos";

// Si se especifica la longitud (length) en la solicitud, aplicar limit
if ($_POST["length"] != -1) {
    $query .= " LIMIT " . $_POST["start"] . ',' . $_POST["length"];
}

// Ejecutar la consulta SQL
$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $subArray = [];
    $subArray[] = $row["id"];
    $subArray[] = $row["marca"];
    $subArray[] = $row["precio"];


    $subArray[] = '<button type="button" name="editar" id="' . $row["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
    $subArray[] = '<button type="button" name="borrar" id="' . $row["id"] . '" class="btn btn-danger btn-xs borrar">Borrar</button>';
    $data[] = $subArray;
}

// Obtener el número total de registros en la tabla de productos
$totalRecordsQuery = "SELECT COUNT(*) as total FROM productos";
$totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
$totalRecords = $totalRecordsRow['total'];

// Configurar el arreglo de salida JSON
header('Content-Type: application/json');

$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalRecords, // Número total de registros en la tabla
    "recordsFiltered" => $totalRecords, // Número de registros después de aplicar filtros
    "data" => $data
);

echo json_encode($salida);

?>
