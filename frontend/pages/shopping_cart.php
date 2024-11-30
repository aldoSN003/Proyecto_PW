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

<?php include("components/header.php") ?>


<section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <!-- Continue Shopping Button -->
        <h4 class="text-left">ID, <strong><?php echo htmlspecialchars($_SESSION['user']['id']); ?></strong>!</h4>
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
                                <th scope="col" class="h5">Shopping Bag</th>

                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.imgur.com/2DsA49b.webp" class="img-fluid rounded-3"
                                            style="width: 120px;" alt="Book">
                                        <div class="flex-column ms-4">
                                            <p class="mb-2">Thinking, Fast and Slow</p>
                                            <p class="mb-0">Daniel Kahneman</p>
                                        </div>
                                    </div>
                                </th>

                                <td class="align-middle">
                                    <div class="d-flex flex-row">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="2" type="number"
                                            class="form-control form-control-sm" style="width: 50px;" />

                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;">$9.99</p>
                                </td>
                            </tr>


                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.imgur.com/2DsA49b.webp" class="img-fluid rounded-3"
                                            style="width: 120px;" alt="Book">
                                        <div class="flex-column ms-4">
                                            <p class="mb-2">Thinking, Fast and Slow</p>
                                            <p class="mb-0">Daniel Kahneman</p>
                                        </div>
                                    </div>
                                </th>

                                <td class="align-middle">
                                    <div class="d-flex flex-row">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="2" type="number"
                                            class="form-control form-control-sm" style="width: 50px;" />

                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;">$9.99</p>
                                </td>
                            </tr>
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
                                        <span class="fw-semibold">$23.49</span>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="fw-semibold">Shipping</span>
                                        <span class="fw-semibold">$2.99</span>
                                    </div>
                                    <hr>
                                    <div class="mb-4 d-flex justify-content-between">
                                        <span class="fw-bold">Total (tax included)</span>
                                        <span class="fw-bold">$26.48</span>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Checkout</span>
                                            <span>$26.48</span>
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

<?php include("components/footer.php") ?>