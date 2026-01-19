<?php 
    require 'src/Views/includes/header_client.php'; 
    $commandes = $_SESSION['commandes'] ?? []; 
    
    $commandeItems = $_SESSION["commande_items"] ?? [];

    $offers = $_SESSION["offers"] ?? [];
    $filterOffers = array_filter($offers, fn($value) => $value["status"] == "pending");
    $acceptedOffers = array_filter($offers, fn($value) => $value["status"] == "accepted");
    $offersCount = count($filterOffers);

    if (!empty($commandeItems)) {        
        foreach ($commandes as $c) {
            if ($c['id'] == $commandeItems[0]["commande_id"]) {
                $commande = $c;
                break;
            }
        }
    }
?>
<style>
    .timeline-icon.border {
        background: transparent;
    }

    .timeline-icon.active {
        box-shadow: 0 0 0 4px rgba(13,110,253,.25);
    }
</style>
<?php if(!empty($commandeItems)):?>
    <div class="container-fluid py-4">
        <div class="container-xl">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <h1 class="fw-black">Order <?php if(!empty($commande["id"])) : echo htmlspecialchars($commande["id"]); endif; ?></h1>
                    <span class="badge badge-statuss"><?php if(!empty($commande["status"])) : echo htmlspecialchars($commande["status"]); endif; ?></span>
                    <div class="text-white mt-1">
                        Created on <?php if(!empty($commande["created_at"])) : echo htmlspecialchars($commande["created_at"]); endif; ?>
                    </div>
                </div>
                <?php if($commande["status"] === "Pending"): ?>
                    <div class="d-flex gap-2">
                        <a href="client_update_commande.php" class="btn btn-outline-light text-decoration-none btn-sm">Edit</a>
                    </div>
                <?php elseif($commande["status"] === "In Progress"): ?>
                    <div class="d-flex gap-2">
                        <a href="../../src//Controller//UpdateCommandHandler.php?status=Completed" class="btn btn-outline-light text-decoration-none btn-sm">Declare as Completed</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row g-4">
                <div class="col-xl-8">
                    <div class="card bg-surface mb-4 p-2">
                        <div class="card-header d-flex justify-content-between text-white">
                            <strong>Products Ordered</strong>
                            <small class="text-white">3 items</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark align-middle">
                                <thead class="text-white small">
                                    <tr>
                                        <th>Product</th>
                                        <th>Notes</th>
                                        <th class="text-end">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($commandeItems as $commandeItem): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <?php if(!empty($commandeItem["name"])) : echo htmlspecialchars($commandeItem["name"]); endif; ?>
                                            </div>
                                        </td>
                                        <td class="text-white fst-italic"><?php if(!empty($commandeItem["description"])) : echo htmlspecialchars($commandeItem["description"]); endif; ?></td>
                                        <td class="text-end"><?php if(!empty($commandeItem["quantity"])) : echo htmlspecialchars($commandeItem["quantity"]); endif; ?></td>
                                        <td class="text-end text-white"><?php if(!empty($commandeItem["price"])) : echo htmlspecialchars($commandeItem["price"]); endif; ?></td>
                                        <td class="text-end fw-bold totalPrice">
                                            <?php if(!empty($commandeItem["price"]) && !empty($commandeItem["quantity"])): echo $commandeItem["price"] * $commandeItem["quantity"]; endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="px-4 py-3 text-end">
                                <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                    <span>Subtotal</span>
                                    <span class="Subtotal"></span>
                                </div>
                                <div class="d-flex justify-content-end gap-5 text-white mb-1">
                                    <span>Delivery Fee</span>
                                    <span>$5.00</span>
                                </div>
                                <div class="d-flex justify-content-end gap-5 fw-bold fs-5">
                                    <span class="text-primary finalPrice"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($_SESSION["commandes"])): ?>
                        <div class="card bg-surface p-4 text-white">
                            <strong class="mb-4 d-block">Order Status Timeline</strong>
                            <?php if ($commande['status'] !== "Canceled"): ?>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="timeline-icon bg-primary text-white active">
                                        <i class="bi bi-cart-fill fs-4"></i>
                                    </div>
                                    <div>
                                        <strong <?= $commande['status'] === "Pending" ? 'class="text-primary"' : '' ?>>
                                            Order Placed
                                        </strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="timeline-icon
                                        <?= $commande['status'] === "Pending" ? 'border border-primary text-primary' : 'bg-primary text-white active' ?>">
                                        <i class="bi bi-fire fs-4"></i>
                                    </div>
                                    <div>
                                        <strong <?= $commande['status'] === "In Progress" ? 'class="text-primary"' : '' ?>>
                                            Prepared
                                        </strong>
                                    </div>
                                </div>
                                <?php if ($commande['status'] === "In Progress" || $commande['status'] === "Completed"): ?>
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="timeline-icon
                                            <?= $commande['status'] === "In Progress" ? 'border border-primary text-primary' : 'bg-primary text-white active' ?>">
                                            <i class="bi bi-truck fs-4"></i>
                                        </div>
                                        <div>
                                            <strong>Out for Delivery</strong>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($commande['status'] === "Completed"): ?>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="timeline-icon bg-success text-white active">
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <strong class="text-success">Delivered</strong>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($commande["status"] === "In Progress"): ?>
                                    <div class="d-flex gap-2">
                                        <a href="../../src/Controller/UpdateCommandHandler.php?status=Completed&id=<?= $acceptedOffers[0]["commande_id"] ?>&offerId=<?= $acceptedOffers[0]["id"] ?>" class="btn btn-outline-light text-decoration-none btn-sm">Declare as Completed</a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($commande['status'] === "Canceled"): ?>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="timeline-icon bg-danger text-white active">
                                        <i class="bi bi-cart-fill fs-4"></i>
                                    </div>
                                    <div>
                                        <strong class="text-danger">
                                            Canceled
                                        </strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-xl-4">
                    <div class="card bg-surface mb-4 text-white">
                        <div class="card-header">
                            <strong>Client Information</strong>
                        </div>
                        <div class="card-body d-flex flex-column gap-3">
                            <div>
                                <strong class="fs-5"><?php if(!empty($_COOKIE["username"])) : echo htmlspecialchars($_COOKIE["username"]); endif; ?></strong>
                                <div class="text-muted-dark">
                                    <?php if(!empty($_COOKIE["first_name"]) && !empty($_COOKIE["last_name"])) : echo htmlspecialchars($_COOKIE["first_name"]) . " " . $_COOKIE["last_name"]; endif; ?>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 text-muted-dark">
                                <i class="bi bi-envelope fs-5"></i>
                                <span><?php if(!empty($_COOKIE["email"])) : echo htmlspecialchars($_COOKIE["email"]); endif; ?></span>
                            </div>
                            <div class="d-flex align-items-start gap-2 text-muted-dark">
                                <i class="bi bi-geo-alt fs-5 mt-1"></i>
                                <span><?php if(!empty($_COOKIE["address"])) : echo htmlspecialchars($_COOKIE["address"]); endif; ?></span>
                            </div>
                            <div class="d-flex align-items-center gap-2 text-muted-dark">
                                <i class="bi bi-telephone fs-5"></i>
                                <span><?php if(!empty($_COOKIE["phone"])) : echo htmlspecialchars($_COOKIE["phone"]); endif; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if($commande["status"] === "Pending"): ?>
                        <div class="card bg-surface">
                            <div class="card-header d-flex justify-content-between text-white">
                                <strong>Offers Section</strong>
                                <small><?= $offersCount ?></small>
                            </div>
                            <?php if($offersCount == 0): ?>
                                <small class="text-white p-3">There is No offers For your order Yet !</small>
                            <?php endif; ?>
                            <?php foreach($filterOffers as $offer): ?>
                                <a href="client_order_offer.php?offerId=<?= $offer["id"] ?>" class="card-body text-white text-decoration-none">
                                    <strong>Would be there in <?= $offer["estimated_duration"] ?></strong>
                                    <div class="text-white d-flex justify-content-between"><span><?= $offer["vehicle"] ?></span><span>$ <?= $offer["prix"] ?></span></div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($commande["status"] === "Pending"): ?>
                <div class="action-bar d-flex justify-content-end m-2">
                    <a href="../../src/Controller/UpdateCommandHandler.php?id=<?= $commande["id"]?>&status=Canceled" class="text-decoration-none rounded p-2 action-btn cancel-btn">
                        <i class="bi bi-x-circle pe-2"></i>Cancel Order
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="container d-flex align-items-center justify-content-center vh-100 fw-bolder fs-20">
        There is no product in this order
    </div>
<?php endif; ?>
<?php require 'src/Views/includes/footer.php'; ?>