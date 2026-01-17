    <?php require "../includes/header_deliverer.php"; ?>
    <main class="container py-4">
        <div class="mb-4">
            <h1 class="fw-bold">Activity Log</h1>
            <p class="text-muted">Track your active negotiations, recent alerts, and complete order history.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 d-flex flex-column gap-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                        <h5 class="mb-0">My Offers Sent</h5>
                        <i class="bi bi-box-arrow-up-right fs-5 text-muted"></i>
                    </div>
                    <div class="card-body p-3 d-flex flex-column gap-3">
                        <div class="border rounded p-2 bg-transparent border border-dark p-4 d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 fw-semibold">Order #8821</p>
                                <small class="text-muted">Sent 15 mins ago</small>
                            </div>
                            <span class="badge bg-warning text-dark badge-status">
                                <i class="bi bi-clock me-1"></i> Pending
                            </span>
                        </div>
                        <div class="border rounded p-2 bg-transparent border border-dark p-4 d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 fw-semibold">Order #8804</p>
                                <small class="text-muted">Sent 2 hours ago</small>
                            </div>
                            <span class="badge bg-success badge-status">
                                <i class="bi bi-check-circle me-1"></i> Accepted
                            </span>
                        </div>
                        <div class="border rounded p-2 bg-transparent border border-dark p-4 d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 fw-semibold">Order #8792</p>
                                <small class="text-muted">Sent yesterday</small>
                            </div>
                            <span class="badge bg-danger badge-status">
                                <i class="bi bi-x-circle me-1"></i> Refused
                            </span>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button class="btn btn-outline-primary w-100">View All Offers</button>
                    </div>
                </div>

                <div class="card shadow-sm flex-grow-1">
                    <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                        <h5 class="mb-0">Notifications</h5>
                        <i class="bi bi-bell fs-5 text-muted"></i>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex gap-3 align-items-start">
                            <div class="flex-shrink-0 rounded-circle bg-primary" style="width:10px; height:10px; margin-top:6px;"></div>
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-medium">Offer accepted for Order #8804</p>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex gap-3 align-items-start">
                            <div class="flex-shrink-0 rounded-circle bg-secondary" style="width:10px; height:10px; margin-top:6px;"></div>
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-medium">New high-priority order available in your zone</p>
                                <small class="text-muted">4 hours ago</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex gap-3 align-items-start">
                            <div class="flex-shrink-0 rounded-circle bg-danger" style="width:10px; height:10px; margin-top:6px;"></div>
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-medium">Order #8755 was canceled by client</p>
                                <small class="text-muted">Yesterday at 4:30 PM</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 bg-transparent">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="mb-0">Order History</h5>
                            <span class="badge bg-secondary">Total: 42</span>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search Order ID">
                            </div>
                            <select class="form-select form-select-sm">
                                <option>All Statuses</option>
                                <option>Completed</option>
                                <option>In Progress</option>
                                <option>Canceled</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order Details</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded">
                                                <i class="bi bi-truck"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Order #8804</div>
                                                <small class="text-muted">Package: Electronics</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Today, 10:30 AM</td>
                                    <td>
                                        <span class="badge bg-primary badge-status">
                                            In Progress
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-outline-primary btn-sm">Update Status</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-success bg-opacity-10 text-success p-2 rounded">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Order #8762</div>
                                                <small class="text-muted">Package: Documents</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Oct 24, 2023</td>
                                    <td>
                                        <span class="badge bg-success badge-status">Completed</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-outline-secondary btn-sm">View Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center bg-transparent">
                        <small class="text-muted">Showing 1-5 of 42 orders</small>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-secondary disabled">Previous</button>
                            <button class="btn btn-outline-secondary">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require "../includes/footer.php"; ?>