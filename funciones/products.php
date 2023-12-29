<?php
include_once "./conexion.php";

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtenemos la página actual desde el parámetro GET
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 6;
$offset = ($page - 1) * $itemsPerPage;

$query = "SELECT 
    p.id, 
    p.marca, 
    p.precio, 
    GROUP_CONCAT(f.web_path) AS web_path
    FROM productos AS p 
    INNER JOIN productos_files AS pf ON pf.producto_id = p.id 
    INNER JOIN files AS f ON f.id = pf.file_id
    GROUP BY p.id, p.marca, p.precio, p.descripcion, p.tallas, p.distribuidor
    LIMIT $offset, $itemsPerPage;
";

$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['web_path'] = explode(',', $row['web_path']);
    $data[] = $row;
}

// Consulta para calcular el número total de productos
$countQuery = "SELECT COUNT(DISTINCT p.id) AS cuenta FROM productos AS p";
$countResult = mysqli_query($con, $countQuery);
$rowCuenta = mysqli_fetch_assoc($countResult);
$totalRegistro = $rowCuenta['cuenta'];
$totalPaginas = ceil($totalRegistro / $itemsPerPage);

mysqli_close($con);

$response = array(
    'productos' => $data,
    'totalPaginas' => $totalPaginas
);

/* header('Content-Type: application/json'); */
echo json_encode($response);
?>
