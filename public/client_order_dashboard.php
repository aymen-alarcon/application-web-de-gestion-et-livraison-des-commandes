<?php require __DIR__ . '/includes/header.php'; ?>
    <main class="container pt-5 vh-100">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="h3">My Orders</h1>
                <p class="text-secondary">Track, manage and create new delivery requests.</p>
            </div>
            <button class="btn btn-primary d-flex align-items-center gap-2">
                <a href="client_add_new_commande_dashboard.php" class="bnt btn-primary text-white text-decoration-none"> + add Create New Order</a>
            </button>
        </div>
        <div class="row mb-4 g-2">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white"><span class="material-symbols-outlined text-secondary">search</span></span>
                    <input type="text" class="form-control bg-dark" placeholder="Search by Order ID, Item, or Location...">
                </div>
            </div>
            <div class="col-md-6 d-flex flex-wrap gap-2">
                <button class="btn btn-primary rounded-pill">All Orders</button>
                <button class="btn btn-outline-secondary rounded-pill position-relative">
                    Active
                    <span
                        class="badge bg-primary rounded-circle position-absolute top-0 start-100 translate-middle p-1">3</span>
                </button>
                <button class="btn btn-outline-secondary rounded-pill">Completed</button>
                <button class="btn btn-outline-secondary rounded-pill">Canceled</button>
            </div>
        </div>
        <div class="table-responsive rounded shadow-sm border border-border-light bg-surface-light">
            <table class="table table-hover mb-0 dark">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Route</th>
                        <th>Date Created</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>#ORD-5829</div>
                            <div class="text-secondary small">Box of Electronics</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 small text-success"><span
                                        class="material-symbols-outlined">trip_origin</span>123 Main St, New York</div>
                                <div class="d-flex align-items-center gap-1 small text-danger"><span
                                        class="material-symbols-outlined">location_on</span>456 Elm St, Brooklyn</div>
                            </div>
                        </td>
                        <td>
                            <div>Oct 25, 2023</div>
                            <div class="small">10:30 AM</div>
                        </td>
                        <td>--</td>
                        <td><span class="badge bg-warning text-dark">Waiting for offers</span></td>
                        <td class="text-end">
                            <button class="btn btn-link text-primary p-0 me-2">Review Offers</button>
                            <button class="btn btn-link text-secondary p-0"><span
                                    class="material-symbols-outlined">more_vert</span></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>#ORD-4921</div>
                            <div class="text-secondary small">Office Supplies</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 small text-success"><span
                                        class="material-symbols-outlined">trip_origin</span>789 Oak Ave, Jersey City
                                </div>
                                <div class="d-flex align-items-center gap-1 small text-danger"><span
                                        class="material-symbols-outlined">location_on</span>101 Pine Rd, Newark</div>
                            </div>
                        </td>
                        <td>
                            <div>Oct 24, 2023</div>
                            <div class="small">02:15 PM</div>
                        </td>
                        <td>$45.00</td>
                        <td><span class="badge bg-primary">In Progress</span></td>
                        <td class="text-end">
                            <button class="btn btn-link text-primary p-0 me-2">Track</button>
                            <button class="btn btn-link text-secondary p-0"><span
                                    class="material-symbols-outlined">more_vert</span></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>#ORD-4920</div>
                            <div class="text-secondary small">Furniture Parts</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 small text-success"><span
                                        class="material-symbols-outlined">trip_origin</span>Warehouse 4B, Queens</div>
                                <div class="d-flex align-items-center gap-1 small text-danger"><span
                                        class="material-symbols-outlined">location_on</span>Store 22, Manhattan</div>
                            </div>
                        </td>
                        <td>
                            <div>Oct 22, 2023</div>
                            <div class="small">09:00 AM</div>
                        </td>
                        <td>$120.50</td>
                        <td><span class="badge bg-purple text-white">Shipped</span></td>
                        <td class="text-end">
                            <button class="btn btn-link text-primary p-0 me-2">View Details</button>
                            <button class="btn btn-link text-secondary p-0"><span
                                    class="material-symbols-outlined">more_vert</span></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>#ORD-4915</div>
                            <div class="text-secondary small">Documents</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center gap-1 small text-success"><span
                                        class="material-symbols-outlined">trip_origin</span>Legal Office, Midtown</div>
                                <div class="d-flex align-items-center gap-1 small text-danger"><span
                                        class="material-symbols-outlined">location_on</span>Court House, Downtown</div>
                            </div>
                        </td>
                        <td>
                            <div>Oct 20, 2023</div>
                            <div class="small">11:45 AM</div>
                        </td>
                        <td>$28.00</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td class="text-end">
                            <button class="btn btn-link text-primary p-0 me-2">View Invoice</button>
                            <button class="btn btn-link text-secondary p-0"><span
                                    class="material-symbols-outlined">more_vert</span></button>
                        </td>
                    </tr>
                    <tr class="text-secondary">
                        <td>
                            <div class="text-decoration-line-through">#ORD-4890</div>
                            <div class="small text-secondary">Perishables</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1 opacity-50">
                                <div class="d-flex align-items-center gap-1 small"><span
                                        class="material-symbols-outlined">trip_origin</span>Farmer's Market</div>
                                <div class="d-flex align-items-center gap-1 small"><span
                                        class="material-symbols-outlined">location_on</span>Restaurant 5</div>
                            </div>
                        </td>
                        <td>Oct 18, 2023</td>
                        <td>$55.00</td>
                        <td><span class="badge bg-danger">Canceled</span></td>
                        <td class="text-end">
                            <button class="btn btn-link text-primary p-0 me-2">Re-Order</button>
                            <button class="btn btn-link text-secondary p-0"><span
                                    class="material-symbols-outlined">more_vert</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation" class="mt-3 d-flex justify-content-between align-items-center">
            <p class="mb-0 small text-secondary">Showing 1 to 5 of 24 results</p>
            <ul class="pagination mb-0">
                <li class="page-item">
                    <a class="page-link h-100" href="#"><span class="material-symbols-outlined">chevron_left</span></a>
                </li>
                <li class="page-item active"><a class="page-link h-100" href="#">1</a></li>
                <li class="page-item"><a class="page-link h-100" href="#">2</a></li>
                <li class="page-item"><a class="page-link h-100" href="#">3</a></li>
                <li class="page-item disabled"><a class="page-link h-100">...</a></li>
                <li class="page-item">
                    <a class="page-link h-100" href="#"><span class="material-symbols-outlined">chevron_right</span></a>
                </li>
            </ul>
        </nav>
        <div class="text-center text-secondary small mt-2 d-md-none">Swipe left to view more details</div>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>