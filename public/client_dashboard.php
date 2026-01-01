<?php 
    require __DIR__ . '/includes/header.php'; 
    $commandes = $_SESSION['commandes'] ?? [];
    $countOrders = count($commandes);
    $countPendingOrders = 0;
    $countCompletedOrders = 0;
    $countInProgressOrders = 0;
    $countCanceledOrders = 0;

    foreach ($commandes as $commande) {
        switch ($commande['statu']) {
            case 'Pending':
                $countPendingOrders++;
                break;

            case 'Completed':
                $countCompletedOrders++;
                break;

            case 'In Progress':
                $countInProgressOrders++;
                break;

            case 'Canceled':
                $countCanceledOrders++;
                break;
        }
    }
?>
    <div class="container-fluid vh-100">
        <main class="container container-max py-5">
            <p class="text-secondary mb-5">
                Real-time performance metrics for logistics operations.
            </p>
            <div class="row g-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4 position-relative">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary fw-semibold">Total Orders</small>
                            <span class="kpi-icon bg-primary bg-opacity-25 text-primary">
                                <i class="bi bi-archive"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countOrders ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4 border-left-warning">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase fw-bold text-warning">Pending Orders</small>
                            <span class="kpi-icon bg-warning bg-opacity-25 text-warning">
                                <i class="bi bi-hourglass-split"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-baseline gap-2">
                            <h2 class="fw-extrabold text-white"><?= $countPendingOrders ?></h2>
                            <span class="text-warning small fw-medium">Requires Action</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Completed Orders</small>
                            <span class="kpi-icon bg-success bg-opacity-25 text-success">
                                <i class="bi bi-check-circle"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countCompletedOrders ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Canceled Orders</small>
                            <span class="kpi-icon bg-danger bg-opacity-25 text-danger">
                                <i class="bi bi-x-lg"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countCanceledOrders ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">In Progress Orders</small>
                            <div class="d-flex align-items-center gap-2">
                                <span class="kpi-icon bg-success rounded-circle" style="width:8px;height:8px;"></span>
                                <small class="text-success fw-semibold">LIVE</small>
                            </div>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countInProgressOrders ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Offers Sent</small>
                            <span class="kpi-icon bg-indigo bg-opacity-25 text-primary">
                                <i class="bi bi-send"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white">1,250</h2>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php require __DIR__ . '/includes/footer.php'; ?>