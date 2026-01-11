<?php require '../includes/header_admin.php'; ?>
<div class="container-xl py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-black">Order Management</h1>
            <p class="text-secondary mb-0">View, edit, and manage all orders across the platform.</p>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <button class="btn btn-primary">Create New Order</button>
        </div>
    </div>
    <div class="card-dark p-4 mb-4">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Search Orders</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary">
                        <i class="bi bi-search"></i>
                    </span>
                    <input class="form-control bg-dark" placeholder="Order ID, Client, Deliverer">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Creation Date</label>
                <input class="form-control bg-dark" placeholder="Filter by date range">
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="text-secondary small">Quick Filters:</span>
            <button class="btn btn-primary btn-sm">Status: All</button>
            <button class="btn btn-outline-light btn-sm">Zone: All</button>
            <div class="vr bg-secondary"></div>
            <button class="btn btn-outline-light btn-sm">Pending</button>
            <button class="btn btn-outline-light btn-sm">In Progress</button>
            <button class="btn btn-outline-light btn-sm">Delivered</button>
            <a href="#" class="ms-auto text-primary text-decoration-none small">Clear all</a>
        </div>
    </div>
    <div class="card-dark overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark-custom table mb-0 align-middle">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client</th>
                    <th>Deliverer</th>
                    <th>Statu</th>
                    <th>Price</th>
                    <th>Vehicle</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['commandes'])): ?>
                        <?php foreach ($_SESSION['commandes'] as $order): ?>
                            <?php
                                if ($order['is_deleted'] === '1') continue;
                                $client = findUserById($_SESSION['users'], $order['user_id']);

                                $offer = findOfferByCommandeId($_SESSION['offers'] ?? [], $order['id']);

                                $deliverer = null;
                                $vehicle = '—';

                                if ($offer) {
                                    $deliverer = findUserById($_SESSION['users'], $offer['sender_id']);
                                    $vehicle = ucfirst($offer['vehicule']);
                                }
                            ?>
                            <tr>
                                <td>#ORD-<?= $order['id'] ?></td>

                                <td>
                                    <?= $client ? htmlspecialchars($client['first_name'].' '.$client['last_name']) : '<span class="text-danger">Unknown</span>' ?>
                                </td>

                                <td class="<?= $deliverer ? '' : 'text-secondary fst-italic' ?>">
                                    <?= $deliverer ? htmlspecialchars($deliverer['first_name'].' '.$deliverer['last_name']) : 'Unassigned' ?>
                                </td>

                                <td class="<?= $offer ? '' : 'text-secondary fst-italic' ?>">
                                    <?= $offer ? htmlspecialchars($offer['prix']) : '-' ?>
                                </td>

                                <td>
                                    <span class="badge text-dark badge-<?= strtolower(str_replace(' ', '-', $order['statu'])) ?>">
                                        <?= htmlspecialchars($order['statu']) ?>
                                    </span>
                                </td>

                                <td><?= $vehicle ?></td>

                                <td class="text-end">
                                    <button class="btn btn-link text-info"><i class="bi bi-pencil"></i></button>
                                    <a href="../../src/Controller/DeleteHandler.php?entityClass=Commande&id=<?php if(isset($order["id"])): echo $order["id"] ; endif; ?>"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No orders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3 border-top border-secondary">
            <small class="text-secondary">Showing 1–5 of 97</small>
            <ul class="pagination mb-0">
                <li class="page-item disabled"><a class="page-link">‹</a></li>
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
                <li class="page-item"><a class="page-link">›</a></li>
            </ul>
        </div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>