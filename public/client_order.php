<?php 
    require __DIR__ . '/includes/header.php'; 
    $commandes = $_SESSION['commandes'] ?? []; 
    $commandeItems = $_SESSION["commande_items"] ?? [];
?>
    <div class="container-fluid py-4">
        <div class="container-xl">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <h1 class="fw-black">Order <?= $commandes[0]["id"] ?></h1>
                    <span class="badge badge-status"><?= $commandes[0]["statu"] ?></span>
                    <div class="text-white mt-1">
                        Created on <?= $commandes[0]["created_at"] ?>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-light btn-sm">Edit</button>
                    <button class="btn btn-primary btn-sm">Update Status</button>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-surface p-3">
                        <div class="text-white">Total Cost</div>
                        <div class="fs-3 fw-bold text-white">$45.50</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-surface p-3">
                        <div class="text-white">Est. Delivery</div>
                        <div class="fs-3 fw-bold text-white">15:15 PM</div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-xl-8">
                    <div class="card bg-surface mb-4">
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
                                        <td class="text-white fst-italic">Extra crispy crust please</td>
                                        <td class="text-end"><?= $commandeItem["quantity"] ?></td>
                                        <td class="text-end text-white"><?= $commandeItem["price"] ?></td>
                                        <td class="text-end fw-bold totalPrice"><?= $commandeItem["price"] * $commandeItem["quantity"] ?> $</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="px-4 py-3 text-end">
                                <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                    <span>Subtotal</span>
                                    <span>$29.50</span>
                                </div>
                                <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                    <span>Delivery Fee</span>
                                    <span>$5.00</span>
                                </div>
                                <div class="d-flex justify-content-end gap-5 fw-bold fs-5">
                                    <span>Total</span>
                                    <span class="text-primary">$37.50</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card bg-surface p-4 position-relative text-white">
                        <strong class="mb-4 d-block">Order Status Timeline</strong>

                        <div class="d-flex gap-3 mb-4 position-relative">
                            <div class="timeline-icon bg-primary text-white">
                                <span class="material-symbols-outlined">shopping_cart</span>
                            </div>
                            <div>
                                <strong>Order Placed</strong>
                                <div class="text-white">Oct 24, 14:30</div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4 position-relative">
                            <div class="timeline-icon bg-primary text-white">
                                <span class="material-symbols-outlined">skillet</span>
                            </div>
                            <div>
                                <strong>Prepared by Merchant</strong>
                                <div class="text-white">Oct 24, 14:55</div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 position-relative">
                            <div class="timeline-icon active">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </div>
                            <div>
                                <strong class="text-primary">Out for Delivery</strong>
                                <div class="text-white">Driver is on the way</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card bg-surface mb-4">
                        <div class="card-header text-white"><strong>Client Information</strong></div>
                        <div class="card-body text-white">
                            <strong>Sarah Jenkins</strong>
                            <div class="text-white mt-1">sarah.j@example.com</div>
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
        </div>
    </div>
<?php require __DIR__ . '/includes/footer.php'; ?>