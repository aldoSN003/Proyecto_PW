<?php
include("connection.php");
session_start();

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user'])) {
    // Redirect to the login page if the user is not logged in
    header("location: index.php");
    exit();
}
// Fetch products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);



?>



<?php include('components/header.php'); ?>


<h1 class="text-center mt-4">Has iniciado sesión correctamente!</h1>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6 col-lg-4 mb-4 mb-md-0">';
                    echo '<div class="card mb-3">';
                    echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="' . $row['name'] . '" />';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex justify-content-between mb-3">';
                    echo '<h5 class="mb-0">' . $row['name'] . '</h5>';
                    echo '<h5 class="text-dark mb-0">$' . number_format($row['price'], 2) . '</h5>';
                    echo '</div>';
                    echo '<div class="d-flex justify-content-between mb-2">';
                    echo '<p class="text-muted mb-0">Available: <span class="fw-bold">' . $row['available'] . '</span></p>';
                    echo '</div>';
                    echo '<div class="description mb-3" style="display: none;">'; // Set initial display to block
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '<button class="btn btn-link" onclick="toggleDescription(this)">Show Description</button>';
                    echo '<div class="d-flex justify-content-between mt-3">';
                    echo '<button class="btn btn-primary">Buy Now</button>';
                    echo '<button class="btn btn-secondary">Add to Cart</button>';
                    echo '</div>';
                    echo '</div>'; // card-body
                    echo '</div>'; // card
                    echo '</div>'; // col
                }
            } else {
                echo '<p>No products found.</p>';
            }
            $conn->close(); // Close the database connection
            ?>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="pwdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header h5 text-white bg-primary justify-content-center bg-dark">
                Restablecer la contraseña
                <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <p class="py-2">
                    Ingresa tu dirección de correo electrónico y te enviaremos un correo con las instrucciones para restablecer tu contraseña.
                </p>
                <div class="form-outline">
                    <input type="email" id="typeEmail" class="form-control my-3" required />
                    <label class="form-label" for="typeEmail">Correo electrónico</label>
                </div>
                <button class="btn btn-dark w-100">Restablecer contraseña</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDescription(button) {
        const description = button.previousElementSibling; // Get the description element
        if (description.style.display === "none") {
            description.style.display = "block"; // Show the description
            button.innerText = "Hide Description"; // Change button text
        } else {
            description.style.display = "none"; // Hide the description
            button.innerText = "Show Description"; // Change button text
        }
    }
</script>

<?php include('components/footer.php'); ?>