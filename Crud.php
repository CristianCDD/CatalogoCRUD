<!doctype html>
<html lang="en">

<head>
  <!-- Meta etiquetas requeridas -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">ç


  <title>Hello, world!</title>
</head>

<body>
  <div class="container fondo">
   
    <h1 class="text-center">CRUD con PHP, PDO, Ajax y Datatables.js</h1>
    <a href="https://www.render2web.com">
    </a>
    <div class="row">
      <div class="col-2 offset-10">
        <div class="text-center">
          <!-- Botón para abrir el modal -->
          <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
            <i class="bi bi-plus-circle-fill"></i> Crear
          </button>
        </div>
      </div>
    </div>
    <br /><br />
    <div class="table-responsive">
    <table id="datos_usuario" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Marca</th>
      <th>Precio</th>

      <th>Editar</th>
      <th>Borrar</th> 

    </tr>
  </thead>
  <tbody></tbody>
</table>
    </div>
  </div>

  <!-- Modal para ingresar nuevo usuario -->
  <div class="modal fade" id="modalUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            Ingresar Nuevo Usuario al Registro
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Formulario para que el usuario ingrese los datos -->
        <form method="POST" id="formulario" enctype="multipart/form-data">
          
          <div class="modal-body">
            <label for="marca">Ingrese la marca del producto</label>
            <input type="text" name="marca" id="marca" class="form-control">
            <br />

           

            <label for="precio">Ingrese los precio</label>
            <input type="text" name="precio" id="precio" class="form-control">
            <br />

           
           
            
            <label for="imagen_usuario">Seleccione una imagen</label>
            <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
            <input type="file" name="imagen_usuario2" id="imagen_usuario2" class="form-control">


            <span id="imagen_subida"></span>
            
            <br />
          </div>
          <!-- Modal - Footer -->
          <div class="modal-footer">
            <input type="hidden" name="id_usuario" id="id_usuario">
            <input type="hidden" name="operacion" id="operacion">
            <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      

  

  <!-- Configuración de DataTables -->

<script src="./js/crud.js"></script>
</body>

</html>