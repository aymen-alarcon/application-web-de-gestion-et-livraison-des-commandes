<?php require "../includes/header_deliverer.php"; ?>
    <main class="container py-4 py-md-5">

        <div class="mb-4">
            <h1 class="fw-black display-6 mb-1">Welcome back, Alex</h1>
            <p class="text-muted-dark">Here is your daily summary and current tasks.</p>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="bg-card-dark border-0 rounded-xl p-4 shadow h-100">
                    <div class="d-flex justify-content-between">
                        <span class="fw-medium">Average Rating</span>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <div class="d-flex align-items-end gap-2 mt-1">
                        <h3 class="fw-bold mb-0">4.8</h3>
                        <small class="text-success fw-medium">+0.2%</small>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="bg-card-dark border-0 rounded-xl p-4 shadow h-100">
                    <div class="d-flex justify-content-between">
                        <span class="fw-medium">Deliveries Today</span>
                        <i class="bi bi-truck primary"></i>
                    </div>
                    <div class="d-flex align-items-end gap-2 mt-1">
                        <h3 class="fw-bold mb-0">12</h3>
                        <small class="text-success fw-medium">+2</small>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="bg-card-dark border-0 rounded-xl p-4 shadow h-100">
                    <div class="d-flex justify-content-between">
                        <span class="fw-medium">Earnings Today</span>
                        <i class="bi bi-currency-dollar text-success"></i>
                    </div>
                    <div class="d-flex align-items-end gap-2 mt-1">
                        <h3 class="fw-bold mb-0">$145.50</h3>
                        <small class="text-success fw-medium">+$45.50</small>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="bg-card-dark border-0 rounded-xl p-4 shadow h-100">
                    <div class="d-flex justify-content-between">
                        <span class="fw-medium">Pending Orders</span>
                        <i class="bi bi-hourglass-split text-warning"></i>
                    </div>
                    <div class="d-flex align-items-end gap-2 mt-1">
                        <h3 class="fw-bold mb-0">2</h3>
                        <small class="text-danger fw-medium">-1</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="bg-card-dark border-0 rounded-xl p-4 shadow">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold mb-0">Notifications</h5>
                        <button class="btn btn-link small p-0 primary fw-semibold text-uppercase">Mark all read</button>
                    </div>
                    <div class="d-flex gap-2 border-bottom pb-3">
                        <div class="rounded-circle p-2" style="background:rgba(19,127,236,.12)">
                            <i class="bi bi-truck primary"></i>
                        </div>
                        <div>
                            <div class="fw-medium small">New Order Assigned</div>
                            <div class="text-muted-dark small">You have been assigned order #3950</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold mb-2">My Current Deliveries</h4>

                <div class="bg-card-dark border-0 rounded-xl p-4 shadow mb-4">
                    <div class="row g-3">
                        <div class="col-md-8 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="pill badge-soft-blue">En Route</span>
                                    <span class="fw-bold fs-5">Order #3942</span>
                                </div>

                                <div class="text-muted-dark small mb-2">
                                    <i class="bi bi-person"></i> Client: Alice M.
                                </div>

                                <div class="small">
                                    <div class="d-flex gap-2 mb-1">
                                        <i class="bi bi-geo-alt"></i> Pickup: 123 Main St, Springfield
                                    </div>
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-flag"></i> <strong>Dropoff:</strong> 456 Elm St, Springfield
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                <button class="btn btn-primary px-3">
                                    Update Status <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-card-dark border-0 rounded-xl shadow mb-4">
            <div class="d-flex justify-content-between p-3">
                <h5 class="fw-bold mb-0">Completed Deliveries</h5>
                <a href="#" class="primary small fw-medium">View All</a>
            </div>

            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="text-muted-dark text-uppercase small fw-semibold">
                        <th class="ps-3">Order ID</th>
                        <th>Date</th>
                        <th>Address</th>
                        <th class="text-end pe-3">Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-medium">#3940</td>
                        <td>Today, 10:30 AM</td>
                        <td>88 Broadway, City Center</td>
                        <td class="fw-bold text-end pe-3">$12.50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <?php require '../includes/footer.php'; ?>