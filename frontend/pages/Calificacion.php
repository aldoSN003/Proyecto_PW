<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calificación de la Experiencia</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php
  // Verificar si se envió la calificación
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'])) {
    $rating = intval($_POST['rating']);
    // Aquí puedes agregar la lógica para guardar la calificación en una base de datos o realizar otras acciones
    echo "<div class='alert alert-success mt-3'>Gracias por calificar tu experiencia con $rating estrellas!</div>";
  }
?>

<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#ratingModal">
  Calificar Experiencia
</button>

<!-- Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ratingModalLabel">Califica tu experiencia de navegación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="submitRating()">Enviar Calificación</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
  let selectedRating = 0;

  // Añadir evento de clic a cada estrella
  document.querySelectorAll('.rating i').forEach(star => {
    star.addEventListener('click', function() {
      selectedRating = this.getAttribute('data-rating');
      updateStars(selectedRating);
    });
  });

  // Actualizar las estrellas visualmente
  function updateStars(rating) {
    document.querySelectorAll('.rating i').forEach(star => {
      star.classList.remove('fas'); 
      star.classList.add('far');    
    });
    for (let i = 0; i < rating; i++) {
      document.querySelectorAll('.rating i')[i].classList.remove('far');
      document.querySelectorAll('.rating i')[i].classList.add('fas');
    }
  }

  // Función para enviar la calificación
  function submitRating() {
    if (selectedRating > 0) {
      // Crear un formulario y enviar la calificación
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '';

      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'rating';
      input.value = selectedRating;

      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    } else {
      alert("Por favor selecciona una calificación antes de enviar.");
    }
  }
</script>

</body>
</html>
