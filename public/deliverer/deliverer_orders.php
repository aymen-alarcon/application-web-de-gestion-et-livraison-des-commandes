<?php require "../includes/header_deliverer.php"; ?>
<main class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h4 fw-bold">Available Orders</h1>
            <div class="text-white small">12 orders available near your current location.</div>
        </div>
        <div class="d-flex w-75 gap-2">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control" placeholder="Search ID or Location">
            </div>
            <select class="form-select">
                <option selected>All Vehicle Types</option>
                <option>Bike</option>
                <option>Car</option>
                <option>Van</option>
            </select>
            <button class="btn btn-outline-secondary d-flex align-items-center w-100">
                <i class="bi bi-sort-down me-1"></i>
                Sort by Price
            </button>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge badge-outline">#ORD-8921</span>
                    <span class="small text-white d-flex align-items-center">
                        <i class="bi bi-clock me-1"></i>
                        2 mins ago
                    </span>
                </div>
                <div class="text-end">
                    <div class="fs-4 fw-bold">$15.00</div>
                    <div class="price-label">Starting Bid</div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-sm-8 timeline-line">
                    <div class="mb-3">
                        <div class="small text-white text-uppercase fw-semibold">Pickup</div>
                        <div class="fw-semibold">123 Main St, Downtown</div>
                        <div class="small text-white">Ready by 2:30 PM</div>
                    </div>
                    <div>
                        <div class="small text-white text-uppercase fw-semibold">Drop-off (Client)</div>
                        <div class="fw-semibold">456 Elm St, Suburbs</div>
                        <div class="small text-white">Deliver before 3:15 PM</div>
                    </div>
                </div>
                <div class="col-sm-4 border-start">
                    <div class="mb-2">
                        <span class="badge bg-success-subtle text-success">Open for Bids</span>
                    </div>
                    <div class="small mb-2 d-flex gap-2">
                        <i class="bi bi-box-seam"></i>
                        Electronics — Laptop & Accessories
                    </div>
                    <div class="small mb-3 d-flex gap-2">
                        <i class="bi bi-bicycle"></i>
                        5.2 km • Bike
                    </div>
                    <button class="btn btn-primary w-100">View Details</button>
                </div>
            </div>
        </div>
    </div>
</main>