<?php require __DIR__ . '/includes/header.php'; ?>
  <main class="container py-4">
    <div class="mb-3 text-secondary-custom">
      Dashboard / <span class="text-white">Create New Order</span>
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
                <span class="icon">pedal_bike</span><br>Bike
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="scooter">
              <label for="scooter" class="p-3 rounded w-100 d-block text-white">
                <span class="icon">two_wheeler</span><br>Scooter
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="car">
              <label for="car" class="p-3 rounded w-100 d-block text-white">
                <span class="icon">directions_car</span><br>Car
              </label>
            </div>
            <div class="col-6 col-sm-3 text-center">
              <input type="radio" name="vehicle" id="van">
              <label for="van" class="p-3 rounded w-100 d-block text-white">
                <span class="icon">local_shipping</span><br>Van
              </label>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label text-white">Item Category</label>
              <select class="form-select bg-black text-white">
                <option class="text-white">Documents</option>
                <option class="text-white">Food / Groceries</option>
                <option class="text-white">Electronics</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label text-white">Approx. Weight (kg)</label>
              <input type="number" class="form-control bg-black">
            </div>
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
            <span>$4.50</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-secondary-custom">Distance</span>
            <span>$5.20</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary-custom">Taxes</span>
            <span>$1.00</span>
          </div>

          <hr>

          <div class="d-flex justify-content-between align-items-end mb-4">
            <strong>Total</strong>
            <span class="text-primary fs-3 fw-bold">$12.50</span>
          </div>

          <button class="btn btn-primary w-100 mb-2">Submit Order</button>
          <button class="btn btn-outline-secondary w-100">Save Draft</button>
        </div>
      </div>

    </div>
  </main>
<?php require __DIR__ . '/includes/footer.php'; ?>