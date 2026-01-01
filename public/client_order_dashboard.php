<?php 
    require __DIR__ . '/includes/header.php'; 
    $commandes = $_SESSION['commandes'] ?? [];
    $countOrders = count($commandes);
    $pagination = ceil($countOrders / 5);
?>
<main class="container pt-5 vh-100">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h1 class="h3">My Orders</h1>
            <p class="text-secondary">Track, manage and create new delivery requests.</p>
        </div>
        <a href="client_add_order.php" class="btn btn-primary text-white text-decoration-none"> + Add Create New Order</a>
    </div>

    <div class="row mb-4 g-2">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search text-secondary"></i></span>
                <input type="text" class="form-control bg-dark" placeholder="Search by Order ID, Item, or Location...">
            </div>
        </div>
        <div class="col-md-6 d-flex flex-wrap gap-2">
            <button class="btn btn-primary rounded-pill">All Orders</button>
            <button class="btn btn-outline-secondary rounded-pill position-relative">
                Active
                <span class="badge bg-primary rounded-circle position-absolute top-0 start-100 translate-middle p-1">3</span>
            </button>
            <button class="btn btn-outline-secondary rounded-pill">Completed</button>
            <button class="btn btn-outline-secondary rounded-pill">Canceled</button>
        </div>
    </div>

    <div class="table-responsive rounded shadow-sm border border-border-light bg-surface-light">
        <table class="table table-hover mb-0 dark">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>title</th>
                    <th>Route</th>
                    <th>Date Created</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                <?php
                    $date = new DateTime($commande['created_at']);
                    $datePart = $date->format('d m Y');
                    $timePart = $date->format('H:i');
                ?>
                <tr>
                    <td><?= htmlspecialchars($commande['id']) ?></td>
                    <td><?= htmlspecialchars($commande['titre']) ?></td>
                    <td><?= htmlspecialchars($commande['address']) ?></td>
                    <td>
                        <div><?= $datePart ?></div>
                        <div class="small text-secondary"><?= $timePart ?></div>
                    </td>
                    <td>--</td>
                    <td>
                        <?php if ($commande['statu'] === 'In Progress'): ?>
                            <span class="badge bg-success">In Progress</span>
                        <?php elseif ($commande['statu'] === 'Canceled'): ?>
                            <span class="badge bg-danger">Canceled</span>
                        <?php elseif ($commande['statu'] === 'Completed'): ?>
                            <span class="badge bg-primary">Completed</span>
                        <?php elseif ($commande['statu'] === 'Pending'): ?>
                            <span class="badge bg-warning text-dark">Waiting for offers</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="" class="text-decoration-none">
                            <span class="kpi-icon bg-success bg-opacity-25 text-success">
                                <i class="bi bi-pencil"></i>
                            </span>
                        </a>
                        <a href="../src/Controller/DeleteCommandHandler.php?id=<?= $commande["id"] ?>" class="text-decoration-none">
                            <span class="kpi-icon bg-danger bg-opacity-25 text-danger">
                                <i class="bi bi-trash3"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation" class="mt-3 d-flex justify-content-between align-items-center">
        <p class="mb-0 small text-secondary">Showing 1 to 5 of <?= $countOrders ?> results</p>
        <ul class="pagination mb-0">
            <li class="page-item">
                <a class="page-link h-100" href="#"><i class="bi bi-chevron-left"></i></a>
            </li>
            <?php 
                for ($i=1; $i <= $pagination ; $i++) { 
                    echo '<li class="page-item"><a class="page-link h-100" href="#">' . $i .'</a></li>';
                }
            ?>
            <li class="page-item">
                <a class="page-link h-100" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
        </ul>
    </nav>
    <div class="text-center text-secondary small mt-2 d-md-none">Swipe left to view more details</div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
