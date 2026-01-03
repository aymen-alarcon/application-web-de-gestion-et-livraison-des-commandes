<?php 
    require '../includes/header.php'; 
    $commandes = $_SESSION['commandes'] ?? []; 
    $commandeItems = $_SESSION["commande_items"] ?? [];

    foreach ($commandes as $c) {
        if ($c['id'] == $commandeItems[0]["commande_id"]) {
            $commande = $c;
            break;
        }
    }
?>
<style>
.timeline-icon.border {
    background: transparent;
}

.timeline-icon.active {
    box-shadow: 0 0 0 4px rgba(13,110,253,.25);
}
</style>
<div class="container-fluid py-4">
    <div class="container-xl">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
            <div>
                <h1 class="fw-black">Order <?= $commande["id"] ?></h1>
                <span class="badge badge-status"><?= $commande["statu"] ?></span>
                <div class="text-white mt-1">
                    Created on <?= $commande["created_at"] ?>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="client_update_commande.php" class="btn btn-outline-light text-decoration-none btn-sm">Edit</a>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-xl-8">
                <div class="card bg-surface mb-4 p-2">
                    <div class="card-header d-flex justify-content-between text-white">
                        <strong>Products Ordered</strong>
                        <small class="text-white">3 items</small>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark align-middle">
                            <thead class="text-white small">
                                <tr>
                                    <th>Product</th>
                                    <th>Notes</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($commandeItems as $commandeItem) :?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <?= $commandeItem["name"] ?>
                                        </div>
                                    </td>
                                    <td class="text-white fst-italic"><?= $commandeItem["description"] ?></td>
                                    <td class="text-end"><?= $commandeItem["quantity"] ?></td>
                                    <td class="text-end text-white"><?= $commandeItem["price"] ?></td>
                                    <td class="text-end fw-bold totalPrice">
                                        <?= $commandeItem["price"] * $commandeItem["quantity"] ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="px-4 py-3 text-end">
                            <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                <span>Subtotal</span>
                                <span class="Subtotal"></span>
                            </div>
                            <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                <span>Delivery Fee</span>
                                <span>$5.00</span>
                            </div>
                            <div class="d-flex justify-content-end gap-5 fw-bold fs-5">
                                <span class="text-primary finalPrice"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($_SESSION["commandes"])): ?>
                    <div class="card bg-surface p-4 text-white">
                        <strong class="mb-4 d-block">Order Status Timeline</strong>
                        <?php if ($commande['statu'] !== "Canceled"): ?>
                            <div class="d-flex gap-3 mb-4">
                                <div class="timeline-icon bg-primary text-white active">
                                    <i class="bi bi-cart-fill fs-4"></i>
                                </div>
                                <div>
                                    <strong <?= $commande['statu'] === "Pending" ? 'class="text-primary"' : '' ?>>
                                        Order Placed
                                    </strong>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-4">
                                <div class="timeline-icon
                                    <?= $commande['statu'] === "Pending" ? 'border border-primary text-primary' : 'bg-primary text-white active' ?>">
                                    <i class="bi bi-fire fs-4"></i>
                                </div>
                                <div>
                                    <strong <?= $commande['statu'] === "In Progress" ? 'class="text-primary"' : '' ?>>
                                        Prepared
                                    </strong>
                                </div>
                            </div>
                            <?php if ($commande['statu'] === "In Progress" || $commande['statu'] === "Completed"): ?>
                                <div class="d-flex gap-3 mb-4">
                                    <div class="timeline-icon
                                        <?= $commande['statu'] === "In Progress" ? 'border border-primary text-primary' : 'bg-primary text-white active' ?>">
                                        <i class="bi bi-truck fs-4"></i>
                                    </div>
                                    <div>
                                        <strong>Out for Delivery</strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($commande['statu'] === "Completed"): ?>
                                <div class="d-flex gap-3">
                                    <div class="timeline-icon bg-success text-white active">
                                        <i class="bi bi-check-circle-fill fs-4"></i>
                                    </div>
                                    <div>
                                        <strong class="text-success">Delivered</strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-4">
                <div class="card bg-surface mb-4 text-white">
                    <div class="card-header">
                        <strong>Client Information</strong>
                    </div>
                    <div class="card-body d-flex flex-column gap-3">
                        <div>
                            <strong class="fs-5"><?= $_COOKIE["username"] ?></strong>
                            <div class="text-muted-dark">
                                <?= $_COOKIE["first_name"] . " " . $_COOKIE["last_name"] ?>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 text-muted-dark">
                            <i class="bi bi-envelope fs-5"></i>
                            <span><?= $_COOKIE["email"] ?></span>
                        </div>
                        <div class="d-flex align-items-start gap-2 text-muted-dark">
                            <i class="bi bi-geo-alt fs-5 mt-1"></i>
                            <span><?= $_COOKIE["address"] ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 text-muted-dark">
                            <i class="bi bi-telephone fs-5"></i>
                            <span><?= $_COOKIE["phone"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="card bg-surface">
                    <div class="card-header d-flex justify-content-between text-white">
                        <strong>Deliverer Info</strong>
                    </div>
                    <div class="card-body text-white">
                        <strong>Mike Ross</strong>
                        <div class="text-white">Scooter • 4.9 ★</div>
                    </div>
                </div>

            </div>
        </div>
        <div class="action-bar d-flex justify-content-end m-2">
            <a href="../src/Controller/UpdateCommandItemHandler.php" class="text-decoration-none rounded p-2 action-btn cancel-btn">
                <i class="bi bi-x-circle pe-2"></i>Cancel Order
            </a>
        </div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>