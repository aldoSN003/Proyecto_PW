<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <link rel="stylesheet" href="css/style.css">
  <title>INGEMANAGER</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container">
        <a class="navbar-brand text-uppercase" href="#" id="navbarBrand">IngeManager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#" id="mainPanelLink">Panel principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="faqLink">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="accountLink">
                <i class="far fa-circle-user"></i>
                Mi cuenta
              </a>
            </li>
            <!-- Botón para calificar -->
            <li class="nav-item">
              <button type="button" class="btn btn-primary nav-link" style="color: white;" data-bs-toggle="modal"
                data-bs-target="#ratingModal">
                Calificar Experiencia
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active c-item">
          <img src="img/car.jpg" class="d-block w-100 c-img" alt="Car image showcasing task management" />
          <div class="carousel-caption top-0 mt-4">
            <h1 class="mt-5 display-1 fw-bolder text-capitalize" id="carouselCaption1">
              Administra tus tareas
            </h1>
            <p id="carouselDescription1">
              Con INGEMANAGER serás capaz de organizar tus tareas inteligentemente
            </p>
            <button class="btn btn-primary mt-5 px-4 py-2" data-bs-toggle="modal"
              onclick="window.location.href='pages/login.php';" id="startButton1">
              Comenzar
            </button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img src="img/notebookl.jpg" class="d-block w-100 c-img" alt="Notebook image representing productivity" />
          <div class="carousel-caption top-0 mt-4">
            <h1 class="mt-5 display-1 fw-bolder text-capitalize" id="carouselCaption2">
              Gestiona tu productividad
            </h1>
            <p id="carouselDescription2">
              Con INGEMANAGER podrás llevar un control eficiente de tus actividades diarias
            </p>

            <button class="btn btn-primary mt-5 px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModal"
              onclick="window.location.href='pages/login.php';" id="startButton2">
              Comenzar
            </button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img src="img/sand.jpg" class="d-block w-100 c-img" alt="Sand image illustrating relaxation" />
          <div class="carousel-caption top-0 mt-4">
            <h1 class="mt-5 display-1 fw-bolder text-capitalize" id="carouselCaption3">
              Organiza tu tiempo
            </h1>
            <p id="carouselDescription3">
              INGEMANAGER te ayuda a planificar y optimizar tu agenda de manera efectiva
            </p>

            <button class="btn btn-primary mt-5 px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModal"
              onclick="window.location.href='pages/login.php';" id="startButton3">
              Comenzar
            </button>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </main>

  <!-- Modal de calificación -->
  <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ratingModalLabel">Califica tu experiencia de navegación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body text-center">
          <p>¿Cómo calificarías tu experiencia de navegación?</p>
          <!-- Contenedor de estrellas para la calificación -->
          <div class="rating">
            <i class="far fa-star fa-2x" data-rating="1"></i>
            <i class="far fa-star fa-2x" data-rating="2"></i>
            <i class="far fa-star fa-2x" data-rating="3"></i>
            <i class="far fa-star fa-2x" data-rating="4"></i>
            <i class="far fa-star fa-2x" data-rating="5"></i>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="submitRating()">Enviar Calificación</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-lg-start text-white bg-dark" style="background-color: #45526e">
    <div class="container p-4 pb-0">
      <section>
        <div class="row">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">INGEMANAGER</h6>
            <p id="footerDescription">
              Descubre la plataforma definitiva para ingenieros y equipos de
              proyecto. IngeManager optimiza tu flujo de trabajo, simplifica
              la gestión de tareas y te ayuda a lograr más, en equipo.
            </p>
          </div>
          <hr class="w-100 clearfix d-md-none" />
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
            <a href="https://maps.app.goo.gl/Hbwb4LxcJFWEyAgN7" target="_blank" class="text-decoration-none"
              id="contactLocation">
              <div class="link-info">
                <i class="fas fa-map-location-dot"></i>
                Zacatepec, Morelos 62147, México
              </div>
            </a>
            <p>
              <a href="mailto:pwebxa982@gmail.com" class="link-info text-decoration-none" id="contactEmail">
                <i class="fas fa-envelope mr-3"></i> pwebxa982@gmail.com
              </a>
            </p>
            <p>
              <i class="fas fa-phone mr-3"></i>
              <a href="tel:+527345461235" class="link-info text-decoration-none" id="contactPhone">+52 734 546 12 35</a>
            </p>
          </div>
        </div>
      </section>
      <hr class="my-3" />
      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <a href="" target="_blank" class="text-decoration-none">
              <div class="p-3 link-info" id="footerCopyright">
                © 2024 IngeManager. Todos los derechos reservados.
              </div>
            </a>
          </div>
          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
            <a class="btn text-white" data-mdb-ripple-init style="background-color: #3b5998" href="#!" role="button"
              id="facebookButton">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee" href="#!" role="button"
              id="twitterButton">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="btn text-white" data-mdb-ripple-init style="background-color: #dd4b39" href="#!" role="button"
              id="googleButton">
              <i class="fab fa-google"></i>
            </a>
            <a class="btn text-white" data-mdb-ripple-init style="background-color: #ac2bac" href="#!" role="button"
              id="instagramButton">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </section>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const stars = document.querySelectorAll(".rating i");
      let selectedRating = 0;

      stars.forEach(star => {
        star.addEventListener("click", function () {
          selectedRating = this.getAttribute("data-rating");
          updateStarDisplay(selectedRating);
        });
      });

      function updateStarDisplay(rating) {
        stars.forEach(star => {
          star.classList.remove('fas');
          star.classList.add('far');
        });

        for (let i = 0; i < rating; i++) {
          stars[i].classList.remove('far');
          stars[i].classList.add('fas');
        }
      }

      window.submitRating = function () {
        alert('Gracias por calificar! Tu calificación es: ' + selectedRating + ' estrellas');
    
      }
    });
  </script>
</body>

</html>
