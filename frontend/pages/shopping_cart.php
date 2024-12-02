<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
session_start();



$user_id = $_SESSION['user']['id'];
$query = "SELECT
    c.cart_id,
    p.image_url,
    p.name AS product_name,
    c.quantity,
    p.price,
    c.subtotal

FROM
    cart c
JOIN
    product p
ON
    c.product_id = p.product_id
WHERE
    c.user_id = ?;
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("SQL Error: " . $stmt->error);
}
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />


    <style>
        .card-img-top {
            height: 40vh;
            /* Set a fixed height for all images */
            object-fit: cover;
            /* Ensures the image covers the area while maintaining aspect ratio */
            width: 100%;
            /* Ensures the image takes the full width of the card */
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="welcome.php" id="navbarBrand">IngeManager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">


                        <li class="nav-item">
                            <a class="nav-link" href="#" id="accountLink" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="far fa-circle-user"></i> Mi cuenta
                            </a>
                        </li>
                        <!-- Cart Bag Item -->
                        <li class="nav-item">
                            <a class="nav-link" href="shopping_cart.php" id="cartLink">
                                <i class="fas fa-cart-shopping"></i> Carrito
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-dark text-white">
            <h5 id="offcanvasRightLabel" class="fw-bold">Mi Cuenta</h5>
            <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #f8f9fa; color: #333;">
            <div class="text-center mb-4">
                <img src="../img/messi.jpg" alt="User  Profile" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="mb-4">
                <h4 class="text-left">Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>!</h4>
                <p class="text-left">Tu correo: <strong><?php echo htmlspecialchars($_SESSION['user']['email']); ?></strong></p>
                <p class="text-left">Tel: <strong><?php echo htmlspecialchars($_SESSION['user']['phone']); ?></strong></p>
                <p class="text-left text-muted">Miembro desde: <strong><?php echo htmlspecialchars($_SESSION['user']['date']); ?></strong></p>
                <p class="text-left text-muted">Cumpleaños: <strong><?php echo htmlspecialchars($_SESSION['user']['birthday']); ?></strong></p>
                <p class="text-left text-muted">Rol: <strong>Administrador</strong></p>
            </div>
            <hr class="my-4">
            <div class="mb-4">
                <a href="profile_settings.php" class="btn btn-outline-dark btn-sm w-100 mb-3 text-start">
                    <i class="fas fa-user-edit"></i> Editar perfil
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#pwdModal" class="btn btn-outline-dark btn-sm w-100 mb-3 text-start">
                    <i class="fas fa-key"></i> Cambiar contraseña
                </a>
            </div>
            <hr class="my-4">
            <div class="d-flex justify-content-start mt-5">
                <a href="logout.php" class="btn btn-danger px-4 py-2" style="text-transform: uppercase;">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </div>

    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            
            <div class="mb-4">
                <a href="welcome.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="h5">Carrito de compras</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Eliminar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subtotal = 0;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $product_name = htmlspecialchars($row['product_name']);
                                        $quantity = intval($row['quantity']);
                                        $price = floatval($row['price']);
                                        $cart_id = intval($row['cart_id']);
                                        $image_url = htmlspecialchars($row['image_url']);
                                        $item_subtotal = floatval($row['subtotal']);
                                        $subtotal += $quantity * $price;
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo $image_url; ?>" class="img-fluid rounded-3" style="width: 120px;" alt="<?php echo $product_name; ?>">
                                                    <div class="flex-column ms-4">
                                                        <p class="mb-2"><?php echo $product_name; ?></p>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="align-middle">
                                                <div class="d-flex flex-row">
                                                    <!-- Decrease Quantity Button -->
                                                    <a href="crud_operations/increase_item_quantity.php?cart_item_id=<?php echo $cart_id; ?>&action=decrease" class="btn btn-link px-2" title="Decrease Quantity">
                                                        <i class="fas fa-minus"></i>
                                                    </a>

                                                    <!-- Quantity Input Field -->
                                                    <input id="form1" min="0" name="quantity" value="<?php echo $quantity; ?>" type="number" class="form-control form-control-sm" style="width: 50px;" readonly />

                                                    <!-- Increase Quantity Button -->
                                                    <a href="crud_operations/increase_item_quantity.php?cart_item_id=<?php echo $cart_id; ?>&action=increase" class="btn btn-link px-2" title="Increase Quantity">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="mb-0" style="font-weight: 500;">$<?php echo number_format($price, 2); ?></p>
                                            </td>


                                            <td class="align-middle">
                                                <p class="mb-0" style="font-weight: 500;">$<?php echo number_format($item_subtotal, 2); ?></p>
                                            </td>

                                            <td class="align-middle">
                                                <a href="crud_operations/delete_cart_item.php?cart_item_id=<?php echo $cart_id ?>" class="btn btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No items found in the cart.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-5 col-xl-4">
                                <div class="card shadow-2-strong rounded-4">
                                    <div class="card-body p-4">
                                        <div class="mb-3 d-flex justify-content-between">
                                            <span class="fw-semibold">Subtotal</span>
                                            <span class="fw-semibold">$<?php echo number_format($subtotal, 2); ?></span>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-between">
                                            <span class="fw-semibold">Shipping</span>
                                            <span class="fw-semibold">$2.99</span>
                                        </div>
                                        <hr>
                                        <div class="mb-4 d-flex justify-content-between">
                                            <span class="fw-bold">Total (tax included)</span>
                                            <span class="fw-bold">$<?php echo number_format($subtotal + 2.99, 2); ?></span>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>Checkout</span>
                                                <span>$<?php echo number_format($subtotal + 2.99, 2); ?></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
                        <tbody>
                            <?php
                            // Reset the result pointer to fetch data again for the modal
                            $result->data_seek(0); // Move the pointer back to the start
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $product_name = htmlspecialchars($row['product_name']);
                                    $quantity = intval($row['quantity']);
                                    $price = floatval($row['price']);
                                    $item_subtotal = floatval($row['subtotal']);
                            ?>
                                    <tr>
                                        <td><?php echo $product_name; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td>$<?php echo number_format($price, 2); ?></td>
                                        <td>$<?php echo number_format($item_subtotal, 2); ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No hay productos en el carrito.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-semibold">Subtotal</span>
                        <span class="fw-semibold">$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-semibold">Envío</span>
                        <span class="fw-semibold">$2.99</span>
                    </div>
                    <hr>
                    <div class="mb-4 d-flex justify-content-between">
                        <span class="fw-bold">Total (impuestos incluidos)</span>
                        <span class="fw-bold">$<?php echo number_format($subtotal + 2.99, 2); ?></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form action="crud_operations/process_payment.php" method="POST">
                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to trigger the modal -->
    <script>
        document.querySelector('.btn-primary.btn-lg.w-100').addEventListener('click', function() {
            var checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            checkoutModal.show(); // Add parentheses to call the show function
        });
    </script>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>