$(document).ready(function () {
  // Función para cargar los datos de los productos
  function cargarDatos(nombre, pagina) {
    $.ajax({
      url: "./funciones/products.php?page=" + pagina, // Agrega el parámetro de página
      type: "GET",
      dataType: "json",
      success: function (data) {
        console.log(data);
        // Limpia el contenido actual
        $(".resultado").empty();

        // Itera sobre los productos y crea las tarjetas
        data.productos.forEach(function (item) {
          var imageHtml = "";
          item.web_path.forEach(function (imagePath) {
            imageHtml += `
                            <div class="swiper-slide">
                                <img class="card-img-top img-thumbnail" src="${imagePath}" alt="">
                            </div>
                        `;
          });

          var cardHtml = `
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card border-primary swiper swiper1">
                                <div class="swiper-wrapper">
                                    ${imageHtml}
                                </div>

                                <div class="card-body">
                                    <p class="card-title"><strong>Producto:</strong> ${item.marca}</p>
                                    <p class="card-text"><strong>Precio:</strong> S/${item.precio}</p>
                                    <a href="index.php?modulo=detalleproducto&id=${item.id}" class="btn btn-primary botonV">Ver más</a>
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    `;

          $(".resultado").append(cardHtml);
        });

        $(".swiper1").each(function () {
          new Swiper(this, {
            direction: "horizontal",
            loop: true,
            navigation: {
              nextEl: this.querySelector(".swiper-button-next"),
              prevEl: this.querySelector(".swiper-button-prev"),
            },
            autoplay: {
              delay: 3000,
            },
            pagination: {
              el: this.querySelector(".swiper-pagination"),
              type: "bullets",
              clickable: true,
            },
          });
        });

        /* Paginacion */
        $(".pagination").empty();
        for (var i = 1; i <= data.totalPaginas; i++) {
            console.log(pagina);
          var pageHtml = `
                        <li class="page-item ${pagina == i ? "active" : ""}">
                            <a class="page-link" href="#">${i}</a>
                        </li>
                    `;
          $(".pagination").append(pageHtml);
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  // Llama a cargarDatos con la página 1 al cargar la página
  cargarDatos("", 1);

  // Agrega un evento de clic para las páginas de paginación
  $(document).on("click", ".pagination .page-link", function (event) {
    event.preventDefault();
    var pagina = $(this).text();
    cargarDatos("", pagina);
  });
});
