<?php 
  require '../includes/header_client.php';
  $offerId = (int)$_GET["offerId"];
  
  $offer = array_filter($_SESSION["offers"], fn($value) => $value["id"] ===  $offerId);
  $commande = array_filter($_SESSION["commandes"], fn($value) => $value["id"] === $offer[0]["commande_id"]);
  $commandeItems = array_filter($_SESSION["commande_items"], fn($value) => $value["commande_id"] === $offer[0]["commande_id"]);
  
  $totalPrice = 0;

  foreach ($commandeItems as $commandeItem) {
    $totalPrice += ($commandeItem["price"] * $commandeItem["quantity"]);
  }
?>
<main class="container py-4 py-lg-5">
  <div class="mx-auto" style="max-width:1200px">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
      <div>
        <h1 class="fw-black display-6 mb-2">Offer for Order <?= $offer["0"]["id"] ?></h1>
        <p class="mb-0">
          You have received a new delivery offer. Please review the details below.
        </p>
      </div>
      <span class="badge badge-pending d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill">
        <i class="bi bi-clock-history"></i>
        Pending Response
      </span>
    </div>
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card p-4 mb-4">
          <div class="d-flex flex-column flex-sm-row gap-4">
            <div class="flex-grow-1 text-white">
              <h4 class="fw-bold mb-1">Michael Stevenson</h4>
              <div class="text-warning mb-2">
                ★★★★☆ <small>(4.9 • 124 Reviews)</small>
              </div>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-secondary-subtle text-secondary border">
                  <i class="bi bi-patch-check-fill me-1"></i>
                  Verified ID
                </span>
                <span class="badge bg-secondary-subtle text-secondary border">
                  <i class="bi bi-truck me-1"></i>
                  500+ Deliveries
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card p-3 stat-card text-white">
              <i class="bi bi-clock stat-icon"></i>
              <small class=" fw-medium">Estimated Time</small>
              <div>
                <h3 class="fw-bold mb-0">15 min</h3>
                <small>Arrival by <?= $offer["0"]["durée_estimée"] ?></small>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 stat-card border-primary border-opacity-50 text-white">
              <i class="bi bi-cash-stack stat-icon"></i>
              <small class=" fw-medium">Offer Price</small>
              <div>
                <h3 class="fw-bold text-primary mb-0"><?= $offer["0"]["prix"] ?></h3>
                <small>Includes all fees</small>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 stat-card text-white">
              <?php if($offer["0"]["vehicule"] ===  "car"): ?>
                <i class="bi bi-car-front-fill stat-icon"></i>
              <?php elseif($offer["0"]["vehicule"] === "scooter"): ?>
                <i class="bi bi-scooter"></i>
              <?php elseif($offer["0"]["vehicule"] === "truck"): ?>
                <i class="bi bi-truck"></i>
              <?php elseif($offer["0"]["vehicule"] === "bicycle"): ?>
                <i class="bi bi-bicycle"></i>
              <?php endif; ?>
              <small class="fw-medium">Vehicle</small>
              <div>
                <h5 class="fw-bold mb-0"><?= $offer["0"]["vehicule"] ?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card p-4 sticky-top sticky-top-offset shadow-lg text-white">
          <h5 class="fw-bold mb-4">Respond to Offer</h5>
          <div class="d-flex justify-content-between mb-4">
            <span>Total Cost</span>
            <span class="fs-3 fw-black"><?= $totalPrice + $offer[0]["prix"] ?></span>
          </div>
          <div class="d-grid gap-3">
            <button class="btn btn-primary btn-lg fw-bold">Accept Offer</button>
            <button class="btn btn-outline-secondary btn-lg">Decline Offer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require '../includes/footer.php'; ?>