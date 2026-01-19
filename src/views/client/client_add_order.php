<?php
  require 'src/Views/includes/header_client.php';
?>

<main class="container py-4">
  <form action="../../src/Controller/InsertCommandeHandler.php" method="post" class="row g-4">
    <div class="col-lg-12">
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
        <button type="submit" class="btn btn-primary w-100 my-4">Submit Order</button>
    </div>

  </form>
</main>

<?php require 'src/Views/includes/footer.php'; ?>
