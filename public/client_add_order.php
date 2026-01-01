<?php
  require __DIR__ . '/includes/header.php';
?>

<main class="container py-4">
  <div class="mb-3 text-secondary-custom">My Orders / <span class="text-white">Finalize Order</span></div>

  <form action="../src/Controller/InsertCommandeHandler.php" method="post" class="row g-4">
    <div class="col-lg-8">
      <div class="card card-dark mb-4 p-4">
        <h5 class="text-white fw-bold mb-3">
          <i class="bi bi-map text-primary fs-4"></i> Route Details
        </h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label text-white">Delivery Address</label>
            <input class="form-control bg-black" name="address" placeholder="Enter drop-off location" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-white">Contact Person</label>
            <input class="form-control bg-black mb-2" name="titre" placeholder="Name" required>
            <input class="form-control bg-black" name="phone" placeholder="Phone" required>
          </div>
        </div>
      </div>

      <div class="card card-dark p-4">
        <h5 class="text-white fw-bold mb-3">
          <span class="icon text-primary me-2">schedule</span> Schedule
        </h5>
        <input type="datetime-local" class="form-control bg-black" name="schedule">
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
        <button type="submit" class="btn btn-primary w-100 mb-2">Submit Order</button>
      </div>
    </div>
  </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
