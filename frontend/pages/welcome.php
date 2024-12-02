<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");




// Fetch products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<?php include('components/header.php'); ?>

<h1 class="text-center mt-4">Has iniciado sesión correctamente!</h1>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                        <div class="card mb-3">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <h5 class="text-dark mb-0">$<?php echo number_format($row['price'], 2); ?></h5>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Available: <span class="fw-bold"><?php echo htmlspecialchars($row['available']); ?></span></p>
                                </div>
                                <div class="description mb-3" style="display: none;">
                                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                                </div>
                                <button class="btn btn-link" onclick="toggleDescription(this)">Show Description</button>
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-primary" onclick="setProductDetails('<?php echo htmlspecialchars($row['name']); ?>', <?php echo $row['price']; ?>, <?php echo $row['product_id']; ?>)">Buy Now</button>
                                    <a href="crud_operations/add_to_cart.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-secondary">Add to cart</a>
                                </div>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col -->
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div> <!-- row -->
    </div> <!-- container -->
</section>
<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Detalles de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Resumen de tu pedido</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetailsBody">
                        <!-- Aquí se llenarán los detalles del pedido -->
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-between">
                    <span class="fw-semibold">Subtotal</span>
                    <span class="fw-semibold" id="subtotalAmount">$0.00</span>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <span class="fw-semibold">Envío</span>
                    <span class="fw-semibold">$2.99</span>
                </div>
                <hr>
                <div class="mb-4 d-flex justify-content-between">
                    <span class="fw-bold">Total (impuestos incluidos)</span>
                    <span class="fw-bold" id="totalAmount">$0.00</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="crud_operations/buy_now.php" method="POST">
                    <input type="hidden" name="product_id" id="productIdInput"> <!-- Campo oculto para el ID del producto -->
                    <input type="hidden" name="total" id="totalInput"> <!-- Campo oculto para el total -->
                    <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setProductDetails(productName, productPrice, productId) {
        const orderDetailsBody = document.getElementById('orderDetailsBody');
        const subtotalAmount = document.getElementById('subtotalAmount');
        const totalAmount = document.getElementById('totalAmount');
        const totalInput = document.getElementById('totalInput');
        const productIdInput = document.getElementById('productIdInput'); // Obtener el campo oculto para el ID del producto

        // Limpiar la tabla antes de agregar nuevos detalles
        orderDetailsBody.innerHTML = '';

        // Agregar el producto a la tabla
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${productName}</td>
        <td>1</td> 
        <td>$${productPrice.toFixed(2)}</td>
        <td>$${productPrice.toFixed(2)}</td>
    `;
        orderDetailsBody.appendChild(row);

        // Calcular subtotal y total
        const subtotal = parseFloat(productPrice);
        const shipping = 2.99;
        const total = subtotal + shipping;

        subtotalAmount.innerText = `$${subtotal.toFixed(2)}`;
        totalAmount.innerText = `$${total.toFixed(2)}`;
        totalInput.value = total.toFixed(2); // Establecer el valor del total en el campo oculto
        productIdInput.value = productId; // Establecer el ID del producto en el campo oculto

        // Mostrar el modal
        var checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    }
</script>
<script>
    function toggleDescription(button) {
        // Obtener el elemento de descripción más cercano
        const description = button.previousElementSibling; // Asumiendo que la descripción está justo antes del botón

        // Alternar la visibilidad de la descripción
        if (description.style.display === "none" || description.style.display === "") {
            description.style.display = "block"; // Mostrar la descripción
            button.innerText = "Hide Description"; // Cambiar el texto del botón
        } else {
            description.style.display = "none"; // Ocultar la descripción
            button.innerText = "Show Description"; // Cambiar el texto del botón
        }
    }
</script>

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica si hay mensajes de error o éxito
if (isset($_SESSION['error'])) {
    $message = htmlspecialchars($_SESSION['error']);
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('messageContent').innerText = '$message';
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
        });
    </script>";
    unset($_SESSION['error']); // Limpiar el mensaje después de mostrarlo
}

if (isset($_SESSION['success'])) {
    $message = htmlspecialchars($_SESSION['success']);
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('messageContent').innerText = '$message';
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
        });
    </script>";
    unset($_SESSION['success']); // Limpiar el mensaje después de mostrarlo
}
?>

<?php include('components/footer.php'); ?>