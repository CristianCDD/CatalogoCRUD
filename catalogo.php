<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="./css/catalogo.css">
    <link rel="stylesheet" href="./css/footer.css">

    <title>Catalogo productos</title>
</head>

<body>
    <style>
        .swiper-button-prev,
        .swiper-button-next {
            top: 20%;

        }
    </style>
    <div class="container-fluid">


        <!--  <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <input type="text" id="nombre" class="form-control" placeholder="Buscar por nombre">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <button id="buscar" class="btn btn-primary">Buscar</button>
                </div> -->
        <div class="cont1">
            <div class="Clogo">
                <img src="./imagenes/logoSF.png">
            </div>

            <div class="letra">
                <h1>¡Descubre la moda!</h1>
                <p>Explora nuestra coleccion exclusiva</p>
                <a href="#" class="btn">Comprar ahora</a>
            </div>




        </div>

        <div class="containerProd">
            <div class="row">
                <div class="col-12">

                    <div class="row mt-1 resultado">

                    </div>





                </div>



            </div>
        </div>

    </div>
    <div class="pagination-container">
        <ul class="pagination d-flex justify-content-center">
            <!-- Aquí se generará la paginación dinámicamente -->
        </ul>
    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="./imagenes/logo.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Nuestro compromiso con la satisfacción del cliente es inquebrantable. Ofrecemos entregas rápidas y un servicio al cliente excepcional para asegurarnos de que obtengas lo que necesitas, cuando lo necesitas.</p>

            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



    <script src="js/funciones.js"></script>
</body>

</html>