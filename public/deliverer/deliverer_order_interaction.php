<?php require "../includes/header_deliverer.php"; ?>
    <style>

        .status-badge {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .vehicle-option {
            border: 2px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .vehicle-option input {
            display: none;
        }

        .vehicle-option.checked {
            border-color: #137fec;
            background-color: rgba(19, 127, 236, 0.05);
        }

        .route-marker {
            position: absolute;
            top: 0;
            left: 0;
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
                    <h1 class="fw-bold display-6 mt-1">Review Order #12345</h1>
                    <p class="text-muted">Review the route and details below before accepting.</p>
                </div>
                <div class="d-flex align-items-center gap-2 px-3 py-1 rounded-pill status-badge">
                    <span class="position-relative d-flex" style="width:10px; height:10px;">
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-circle bg-success opacity-50 animate-ping"></span>
                        <span class="rounded-circle bg-success" style="width:10px; height:10px;"></span>
                    </span>
                    <span class="fw-bold small">Status: Available</span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8 d-flex flex-column gap-4">
                    <div class="card shadow-sm rounded-xl overflow-hidden">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0 fw-bold">Route & Item Details</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="d-flex gap-3 p-3 align-items-start hover-bg">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <div class="flex-grow-1" style="width:2px; background:#dee2e6; margin:0.5rem 0;"></div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-uppercase small fw-bold text-muted mb-1">Pick-up • 1.2 mi away</p>
                                    <p class="fw-bold mb-1">TechWorld Electronics</p>
                                    <p class="small text-muted">123 Main St, Downtown (Business District)</p>
                                </div>
                                <div>
                                    <button class="btn btn-link p-0 text-primary small">Get Directions</button>
                                </div>
                            </div>
                            <div class="d-flex gap-3 p-3 align-items-start hover-bg">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-uppercase small fw-bold text-muted mb-1">Drop-off • 4.5 mi total</p>
                                    <p class="fw-bold mb-1">Private Residence</p>
                                    <p class="small text-muted">456 Oak Ln, Suburbia, Apt 4B</p>
                                    <div class="mt-2 d-flex gap-2 flex-wrap">
                                        <span class="badge bg-secondary text-dark"><i class="bi bi-elevator" style="font-size:14px;"></i> Elevator Building</span>
                                        <span class="badge bg-secondary text-dark"><i class="bi bi-bell" style="font-size:14px;"></i> Ring Bell</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Specs Grid -->
                            <div class="p-3 bg-transparent bg-opacity-50 dark-bg p-3 d-flex gap-3 flex-wrap">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-box-seam text-primary"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Large Package</p>
                                        <small class="text-muted">Electronics (Fragile)</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-clock text-primary"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Deliver By</p>
                                        <small class="text-muted">4:00 PM Today</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4 d-flex flex-column gap-4">
                    <div class="card shadow-lg  rounded-xl p-4 sticky-top" style="top:96px;">
                        <h5 class="fw-bold">Select Delivery Vehicle</h5>
                        <p class="small text-muted mb-3">Choose the vehicle you are using for this trip.</p>

                        <div class="row g-2 mb-3">
                            <!-- Vehicles -->
                            <div class="col-6">
                                <label class="vehicle-option w-100">
                                    <input type="radio" name="vehicle">
                                    <i class="bi bi-bicycle" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                    Bicycle
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="vehicle-option checked w-100">
                                    <input type="radio" name="vehicle" checked>
                                    <i class="bi bi-scooter " style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                    Motorbike
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="vehicle-option w-100">
                                    <input type="radio" name="vehicle">
                                    <i class="bi bi-car-front" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                    Car
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="vehicle-option w-100">
                                    <input type="radio" name="vehicle">
                                    <i class="bi bi-truck" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                    Van
                                </label>
                            </div>
                        </div>

                        <!-- Earnings -->
                        <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-transparent rounded">
                            <span class="small text-muted">Estimated Earnings</span>
                            <span class="fw-bold fs-5">$24.50</span>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2">
                                Accept Order <i class="bi bi-arrow-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">Cancel & Go Back</button>
                        </div>

                        <p class="small text-center text-muted mt-3">By accepting this order, you agree to the <a href="#" class="text-decoration-underline text-primary">Terms of Service</a>. You are expected to arrive at the pick-up location within 20 minutes.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Vehicle selection script
        document.querySelectorAll('.vehicle-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.vehicle-option').forEach(o => o.classList.remove('checked'));
                option.classList.add('checked');
                option.querySelector('input').checked = true;
            });
        });
    </script>
<?php require "../includes/footer.php"; ?>
