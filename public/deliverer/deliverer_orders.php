<?php 
    require "../includes/header_deliverer.php"; 
    $commandes = $_SESSION["commandes"];
    $offer = $_SESSION["offer"];
?>
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
    <?php if(!empty($commandes)): foreach($commandes as $commande): if($commande["statu"] === "Pending"):?>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge badge-outline"><?= $commande["id"] ?></span>
                        <span class="small text-white d-flex align-items-center">
                            <i class="bi bi-clock me-1"></i>
                            <?php
                                $creationDate = DateTime::createFromFormat('Y-m-d H:i:s', $commande["created_at"]);
                                $now = new DateTime;
                                $diff = $creationDate->diff($now);
                                echo $diff->format("%d days %h hours %m minutes");
                            ?>
                        </span>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-sm-8 timeline-line">
                        <div>
                            <div class="small text-white text-uppercase fw-semibold">Drop-off (Client)</div>
                            <div class="fw-semibold"><?= $commande["address"] ?></div>
                            <div class="small text-white">Deliver before 3:15 PM</div>
                        </div>
                    </div>
                    <div class="col-sm-4 border-start">
                        <div class="mb-2">
                            <span class="badge bg-success-subtle text-success"><?= $commande["statu"] ?></span>
                        </div>
                        <div class="fw-semibold my-2">Order By <?= $commande["username"] ?></div>
                        <div class="fw-semibold my-2">Phone Number: <?= $commande["phone"] ?></div>
                        <a href="../../src/Controller/ReadCommandeItemHandler.php?commande_id=<?= $commande['id'] ?>" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; endforeach; endif;?>
</main>