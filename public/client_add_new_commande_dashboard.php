<?php require __DIR__ . '/includes/header.php'; ?>
  <main class="container py-4">
    <div class="mb-3 text-secondary-custom">
      My Orders / <span class="text-white">Create New Order</span>
    </div>
    <div class="mb-5">
      <h1 class="fw-black">Create New Order</h1>
      <p class="text-secondary-custom col-lg-6">
        Fill in the details below to request a new delivery.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card card-dark mb-4 p-4">
          <h5 class="text-white fw-bold mb-3">
            <span class="icon text-primary me-2">map</span> Route Details
          </h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label text-white">Delivery Address</label>
              <input class="form-control bg-black" placeholder="Enter drop-off location">
            </div>
            <div class="col-md-6">
              <label class="form-label text-white">Contact Person</label>
              <input class="form-control bg-black mb-2" placeholder="Name">
              <input class="form-control bg-black" placeholder="Phone">
            </div>
          </div>
        </div>
        <div class="card card-dark mb-4 p-4">
          <h5 class="text-white fw-bold mb-3">
            <span class="icon text-primary me-2">inventory_2</span> Package Details
          </h5>
          <div class="row g-3 mb-3 vehicle-option">
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="bike" checked>
              <label for="bike" class="p-3 rounded w-100 d-block text-white">
                <i class="fw-bold fs-4 bi bi-bicycle"></i>
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="scooter">
              <label for="scooter" class="p-3 rounded w-100 d-block text-white">
                <i class="fw-bold fs-4 bi bi-scooter"></i>
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="car">
              <label for="car" class="p-3 rounded w-100 d-block text-white">
                <i class="fw-bold fs-4 bi bi-car-front"></i>
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="van">
              <label for="van" class="p-3 rounded w-100 d-block text-white">
                <i class="fw-bold fs-4 bi bi-truck"></i>
              </label>
            </div>
          </div>

          <div class="row g-3" id="itemsContainer">
            <div class="col-md-6">
              <label class="form-label text-white">What do you want?</label>
              <input type="text" class="form-control bg-black text-white" placeholder="e.g. Apples">
            </div>

            <div class="col-md-6">
              <label class="form-label text-white">Quantity</label>
              <input type="number" class="form-control bg-black text-white" placeholder="e.g. 2">
            </div>
          </div>
          <div class="mt-3">
            <button type="button" class="btn btn-success w-100 add-product">+</button>
          </div>

          <div class="mt-3">
            <label class="form-label text-white">Item Description</label>
            <textarea class="form-control bg-black" rows="3"></textarea>
          </div>
        </div>
        <div class="card card-dark p-4">
          <h5 class="text-white fw-bold mb-3">
            <span class="icon text-primary me-2">schedule</span> Schedule
          </h5>
          <input type="datetime-local" class="form-control bg-black">
        </div>

      </div>
      <div class="col-lg-4">
        <div class="card card-dark p-4 position-sticky sticky-summary">
          <h5 class="text-white fw-bold mb-3">Order Summary</h5>

          <div class="d-flex justify-content-between mb-2">
            <span class="text-secondary-custom">Base Fare</span>
            <span class="text-white">$4.50</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-secondary-custom">Distance</span>
            <span class="text-white">$5.20</span>
          </div>
          <hr>

          <div class="d-flex justify-content-between align-items-end mb-4">
            <strong>Total</strong>
            <span class="text-primary fs-3 fw-bold">$12.50</span>
          </div>

          <button class="btn btn-primary w-100 mb-2">Submit Order</button>
        </div>
      </div>

    </div>
  </main>
<?php require __DIR__ . '/includes/footer.php'; ?>