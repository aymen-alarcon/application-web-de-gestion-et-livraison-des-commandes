<?php 
    require __DIR__ . '/includes/header.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['commandes'] = $_POST;
    }

    if (!isset($_SESSION['commandes'])) {
        header('Location: client_add_order.php');
        exit;
    }
?>
    <main class="container py-4">
        <div class="mb-3 text-secondary-custom">My Orders / <span class="text-white">Create New Order</span></div>
        <form action="../src/Controller/InsertCommandeItemHandler.php" method="post" class="row g-4">
            <div class="col-lg-8">
                <div class="card card-dark mb-4 p-4">
                    <h5 class="text-white fw-bold mb-3">
                    <i class="bi bi-archive text-primary fs-4"></i> Package Details
                    </h5>
                    <div class="row g-3" id="itemsContainer">
                        <div class="col-md-6">
                            <label class="form-label text-white">What do you want?</label>
                            <input type="text" class="form-control bg-black text-white" name="product[]" placeholder="e.g. Apples" required>
                        </div>
                        <input type="text" name="commande_id" value="<?= $_GET["commande_id"] ?>" required hidden>
                        <div class="col-md-6">
                            <label class="form-label text-white">Quantity</label>
                            <input type="number" class="form-control bg-black text-white" name="quantity[]" placeholder="e.g. 2" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Price</label>
                            <input type="number" class="form-control bg-black text-white" name="price[]" placeholder="e.g. 2" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-success w-100 add-product">+</button>
                    </div>
                    <div class="mt-3">
                        <label class="form-label text-white">Description</label>
                        <textarea class="form-control bg-black" name="description" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <button type="submit" class="btn btn-primary w-100">Next: Route Details</button>
            </div>
        </form>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>