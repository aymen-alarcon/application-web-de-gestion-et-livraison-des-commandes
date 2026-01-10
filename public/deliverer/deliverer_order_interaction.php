<?php 
    require "../includes/header_deliverer.php"; 
    $commandeItems = $_SESSION["commande_items"];
?>
    <style>
        .status-badge {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .hover-bg:hover {
            background-color: rgba(0, 0, 0, 0.03);
            transition: background-color 0.2s ease-in-out;
        }
    </style>
</head>
<body class="scrollbar-custom">
    <main class="container py-4">
        <div class="mx-auto" style="max-width: 1100px;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end gap-3 mb-4">
                <div>
                    <nav class="d-flex align-items-center gap-2 text-muted small">
                        <span class="cursor-pointer text-decoration-underline text-primary">Dashboard</span>
                        <i class="bi bi-chevron-right" style="font-size:16px;"></i>
                        <span>Orders</span>
                    </nav>
                    <h1 class="fw-bold display-6 mt-1">Order <?= $commandeItems[0]["commande_id"] ?></h1>
                    <p class="text-muted">Review the route and details below before accepting.</p>
                </div>
                <div class="d-flex align-items-center gap-2 px-3 py-1 rounded-pill status-badge">
                    <span class="position-relative d-flex" style="width:10px; height:10px;">
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-circle bg-success opacity-50 animate-ping"></span>
                        <span class="rounded-circle bg-success" style="width:10px; height:10px;"></span>
                    </span>
                    <span class="fw-bold small">Status: Pending</span>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-8 d-flex flex-column gap-4">
                    <div class="card shadow-sm rounded-xl overflow-hidden">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0 fw-bold">Item Details</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body p-0">
                                <?php if (!empty($commandeItems)) : ?>
                                    <div class="p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h6 class="fw-bold mb-0">
                                                <i class="bi bi-box-seam me-2 text-primary"></i>
                                                Order Items
                                            </h6>
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                <?= count($commandeItems) ?> items
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column gap-3">
                                            <?php 
                                                $grandTotal = 0;
                                                foreach ($commandeItems as $item) :
                                                    $total = $item['price'] * $item['quantity'];
                                                    $grandTotal += $total;
                                            ?>
                                                <div class="d-flex justify-content-between align-items-start p-3 rounded-3 hover-bg">
                                                    <div class="d-flex gap-3">
                                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                                            style="width:42px;height:42px;">
                                                            <i class="bi bi-cube"></i>
                                                        </div>

                                                        <div>
                                                            <p class="fw-semibold mb-1">
                                                                <?= htmlspecialchars($item['name']) ?>
                                                            </p>
                                                            <p class="small text-muted mb-1">
                                                                <?= htmlspecialchars($item['description']) ?>
                                                            </p>
                                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                                Qty: <?= (int)$item['quantity'] ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <p class="fw-semibold mb-1">
                                                            $<?= number_format($item['price'], 2) ?>
                                                        </p>
                                                        <p class="small text-muted mb-0">
                                                            Total: <span class="fw-bold">$<?= number_format($total, 2) ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="mt-4 p-3 rounded-3 bg-success bg-opacity-10 d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-success">
                                                <i class="bi bi-cash-stack me-1"></i> Grand Total
                                            </span>
                                            <span class="fw-bold fs-5 text-success">
                                                $<?= number_format($grandTotal, 2) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="p-4 text-center text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        No items found for this order.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column gap-4">
                    <div class="card shadow-lg  rounded-xl p-4 sticky-top" style="top:96px;">
                        <form action="../../src/Controller/CreateOfferHandler.php" method="post">
                            <input type="text" hidden name="commande_id" value="<?= $commandeItems[0]["commande_id"] ?>">
                            <h5 class="fw-bold">Select Delivery Vehicle</h5>
                            <p class="small text-muted mb-3">Choose the vehicle you are using for this trip.</p>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="vehicle-option w-100">
                                        <input type="radio" name="vehicle" value="bicycle">
                                        <i class="bi bi-bicycle" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                        Bicycle
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="vehicle-option checked w-100">
                                        <input type="radio" name="vehicle" value="scooter" checked>
                                        <i class="bi bi-scooter " style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                        Motorbike
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="vehicle-option w-100">
                                        <input type="radio" name="vehicle" value="car">
                                        <i class="bi bi-car-front" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                        Car
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="vehicle-option w-100">
                                        <input type="radio" name="vehicle" value="truck">
                                        <i class="bi bi-truck" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                        Van
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Price</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="price" placeholder="10$">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">When will it be ready</label>
                                <input type="date" class="form-control bg-dark text-white border-secondary" name="duree">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2">
                                    Send Order <i class="bi bi-arrow-right"></i>
                                </button>
                                <a href="deliverer_orders.php" class="btn btn-outline-secondary">Cancel & Go Back</a>
                            </div>
                            <p class="small text-center text-muted mt-3">By accepting this order, you agree to the <a href="#" class="text-decoration-underline text-primary">Terms of Service</a>. You are expected to arrive at the pick-up location within 20 minutes.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require "../includes/footer.php"; ?>