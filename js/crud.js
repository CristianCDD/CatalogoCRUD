$(document).ready(function () {
  $("#botonCrear").click(function () {
    $("#formulario")[0].reset();
    $(".modal-title").text("Crear usuario");
    $("#action").val("Crear");
    $("#operacion").val("Crear");
    $("#imagen_subida").html("");
  });

  var dataTable = $("#datos_usuario").DataTable({
    processing: true,
    serverSide: true,
    order: [[0, "asc"]], // Order by the first column (id)
    pageLength: 10,

    ajax: {
      url: "./funciones/CRUD_products/obtener_productos.php",

      type: "POST",
    },

    columnDefs: [
      {
        /* "orderable": false,
            "targets": [2]  */

       /*  width: "60%",
        targets: 3, */
      },
      {
        targets: [0],
        orderable: false,
      },
    ],

    language: {
      decimal: "",
      emptyTable: "No hay registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 a 0 de 0 Entradas",
      infoFiltered: "(Filtrando de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });

  /* Agregar */
  $(document).on("submit", "#formulario", function (event) {
    event.preventDefault();
   

    var marca = $("#marca").val();
    var telefono = $("#precio").val();
    var extension = $("#imagen_usuario").val().split(".").pop().toLowerCase();

    var imagenUsuarioVal = $("#imgOculta").val(); // Obtén el valor de #imagen_usuario
    if (imagenUsuarioVal) {
      // Verifica si el valor existe
      extension = imagenUsuarioVal.split(".").pop().toLowerCase(); // Divide la cadena si existe
    }

    

    // Comprobar si extension está vacío y usar extensionOculta si no lo está
    if (extension === "" && extensionOculta !== "") {
      extension = extensionOculta;
    }
  
    // Verificar si la extensión es válida
    if (jQuery.inArray(extension, ["gif", "jpg", "jpeg", "png"]) == -1) {
      alert("Formato de imagen inválido");
      $("#imagen_usuario").val("");
      $("#imgOculta").val("");
      return false;
    }
  
    if (marca != ""  && telefono != "" && (extension != "" || extensionOculta != "")) {
      $.ajax({
        url: "./funciones/CRUD_products/crear.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (data) {
          alert(data);
          $("#formulario")[0].reset();
          $("#modalUsuario").modal("hide");
          dataTable.ajax.reload();
        },
      });
    } else {
      alert("Algunos campos son obligatorios");
    }
  });
  
  /* Editar */
  
  $(document).on("click", ".editar", function () {
    var id_usuario = $(this).attr("id");
  
    $.ajax({
      url: "./funciones/CRUD_products/editar.php",
      method: "POST",
      data: { id_usuario: id_usuario },
      dataType: "json",
      success: function (data) {
        console.log(data);
          $("#modalUsuario").modal("show");
        $("#marca").val(data.marca);
        $("#precio").val(data.precio);
        $("#descripcion").val(data.descripcion);
        $("#distribuidor").val(data.distribuidor);

        $("#tallas").val(data.tallas);

        $(".modal-title").text("Editar usuario");
        
        $("#imagen_subida").html(data.imagen_usuario);
        $("#id_usuario").val(id_usuario);
        $("#action").val("Editar");
        $("#operacion").val("Editar");  
  
        console.log(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      },
    });
  });


  $(document).on("click", ".borrar", function () {
    var id_usuario = $(this).attr("id");
    if (confirm("Esta segura de borrar este registro: " + id_usuario)) {
      $.ajax({
        url: "./funciones/CRUD_products/borrar.php",
        method: "POST",
        data: { id_usuario: id_usuario },
        success: function (data) {
          alert(data);
          dataTable.ajax.reload();
        },
      });
    } else {
      return false;
    }
  });
});