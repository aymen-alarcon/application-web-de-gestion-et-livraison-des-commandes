<?php require __DIR__ . '/includes/header.php'; ?>
    <div class="container-fluid vh-100">
        <main class="container container-max py-5">
            <p class="text-secondary mb-5">
                Real-time performance metrics for today's logistics operations.
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
                        <h2 class="fw-extrabold text-white">15,234</h2>
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
                            <h2 class="fw-extrabold text-white">42</h2>
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
                        <h2 class="fw-extrabold text-white">14,800</h2>
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
                        <h2 class="fw-extrabold text-white">392</h2>
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
                <div class="col-sm-6 col-xl-4">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-uppercase text-secondary">Active Deliverers</small>
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-success rounded-circle" style="width:8px;height:8px;"></span>
                                <small class="text-success fw-semibold">LIVE</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline gap-2">
                            <h2 class="fw-extrabold text-white">85</h2>
                            <span class="text-secondary small">/ 120 Total</span>
                        </div>
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
                            <span class="text-primary fw-medium">Go to Users →</span>
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
                            <span class="text-primary text-danger fw-medium">View All Orders →</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none text-white">
                        <div class="card p-4 quick-card h-100">
                            <div class="kpi-icon bg-success bg-opacity-25 text-success mb-3">
                                <i class="bi bi-scooter"></i>
                            </div>
                            <h5 class="fw-bold text-white">Deliverer Performance</h5>
                            <p class="text-secondary small">
                                Track deliverer ratings, delivery times, and active shifts.
                            </p>
                            <span class="text-success fw-medium">Analyze Fleet →</span>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
<?php require __DIR__ . '/includes/footer.php'; ?>