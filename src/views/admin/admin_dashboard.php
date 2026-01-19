<?php 
    require 'src/Views/includes/header_admin.php'; 

    // $OrdersFilteredByAvailability = array_filter($_SESSION["commandes"], fn($value) => $value["is_deleted"] == 0);
    // $UsersFilteredByAvailability = array_filter($_SESSION["users"], fn($value) => $value["is_deleted"] == 0);
    // $admins = array_filter($_SESSION["roles"], fn($value) => $value["role_name"] == "admin");
    // $deliverers = array_filter($_SESSION["roles"], fn($value) => $value["role_name"] == "deliverer");
    // $clients = array_filter($_SESSION["roles"], fn($value) => $value["role_name"] == "client");
    // $pendingOrders = array_filter($OrdersFilteredByAvailability, fn($value) => $value["status"] == "Pending");
    // $CompletedOrders = array_filter($OrdersFilteredByAvailability, fn($value) => $value["status"] == "Completed");
    // $CanceledOrders = array_filter($OrdersFilteredByAvailability, fn($value) => $value["status"] == "Canceled");
    // $InProgressOrders = array_filter($OrdersFilteredByAvailability, fn($value) => $value["status"] == "In Progress");
    // $PendingOffers = array_filter($_SESSION["offers"], fn($value) => $value["status"] == "pending");
    // $CompletedOffers = array_filter($_SESSION["offers"], fn($value) => $value["status"] == "completed");

    // $countpendingOrders = count($pendingOrders);
    // $countCompletedOrders = count($CompletedOrders);
    // $countCanceledOrders = count($CanceledOrders);
    // $countInProgressOrders = count($InProgressOrders);
    // $countOrders = count($OrdersFilteredByAvailability);
    // $countUsers = count($UsersFilteredByAvailability);
    // $countDeliverers = count($deliverers);
    // $countAdmins = count($admins);
    // $countClients = count($clients);
    // $countPendingOffers = count($PendingOffers);
    // $countCompletedOffers = count($CompletedOffers);
?>
    <div class="container-fluid vh-100">
        <main class="container container-max py-5">
            <p class="text-secondary mb-5">
                Real-time performance metrics for today's logistics operations.
            </p>
            <div class="row g-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Client</small>
                            <span class="kpi-icon bg-indigo bg-opacity-25 text-primary">
                                <i class="bi bi-person"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-baseline gap-2">
                            <h2 class="fw-extrabold text-white"><?= $countClients ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Deliverers</small>
                            <span class="kpi-icon bg-indigo bg-opacity-25 text-primary">
                                <i class="bi bi-person"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-baseline gap-2">
                            <h2 class="fw-extrabold text-white"><?= $countDeliverers ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Admins</small>
                            <span class="kpi-icon bg-indigo bg-opacity-25 text-primary">
                                <i class="bi bi-person"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-baseline gap-2">
                            <h2 class="fw-extrabold text-white"><?= $countAdmins ?></h2>
                        </div>
                    </div>
                </div>
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
                            <h2 class="fw-extrabold text-white"><?= $countpendingOrders ?></h2>
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
                            <small class="text-uppercase text-secondary">Offers Sent</small>
                            <span class="kpi-icon bg-indigo bg-opacity-25 text-primary">
                                <i class="bi bi-send"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countPendingOffers ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Completed Offers</small>
                            <span class="kpi-icon bg-success bg-opacity-25 text-success">
                                <i class="bi bi-check-circle"></i>
                            </span>
                        </div>
                        <h2 class="fw-extrabold text-white"><?= $countCompletedOffers ?></h2>
                    </div>
                </div>
            </div>
            <h4 class="mt-5 mb-3 fw-semibold">Quick Management</h4>

            <div class="row g-4">
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none text-white">
                        <div class="card p-4 quick-card h-100">
                            <div class="kpi-icon bg-primary bg-opacity-25 text-primary mb-3">
                                <i class="bi bi-person-gear"></i>
                            </div>
                            <h5 class="fw-bold text-white">User Management</h5>
                            <p class="text-secondary small">
                                Manage client profiles, administrator roles, and access permissions.
                            </p>
                            <a href="admin_user_management.php" class="text-primary fw-medium">Go to Users →</a>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none text-white">
                        <div class="card p-4 quick-card h-100">
                            <div class="kpi-icon bg-danger bg-opacity-25 text-primary mb-3">
                                <i class="bi bi-list-task text-danger"></i>
                            </div>
                            <h5 class="fw-bold text-white">Order Management</h5>
                            <p class="text-secondary small">
                                Access the full database of orders. Filter by status, date, or ID.
                            </p>
                            <a href="admin_orders_management.php" class="text-primary text-danger fw-medium">View All Orders →</a>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none text-white">
                        <div class="card p-4 quick-card h-100">
                            <div class="kpi-icon bg-success bg-opacity-25 text-success mb-3">
                                <i class="bi bi-scooter"></i>
                            </div>
                            <h5 class="fw-bold text-white">Offers Management</h5>
                            <p class="text-secondary small">
                                Track Offers ratings, delivery times, and active shifts.
                            </p>
                            <a href="admin_offers_management.php" class="text-success fw-medium">Analyze Fleet →</a>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
<?php require 'src/Views/includes/footer.php'; ?>