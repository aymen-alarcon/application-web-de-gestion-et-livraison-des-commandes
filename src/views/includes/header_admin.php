<?php 
    use App\Models\Offer;
    use App\Models\Commande;
    use App\Models\User;
    use App\Models\Role;
    use App\Database\DatabaseConnection;
    $db = new DatabaseConnection;
    $conn = $db->establishConnection();
    
    if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
        header("Location: /Logout");
    }
    
    if (!isset($_SESSION["offers"]) || empty($_SESSION["offers"])) {
        $handler = new Offer($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["commandes"]) || empty($_SESSION["commandes"])) {
        $handler = new Commande($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["users"]) || empty($_SESSION["users"])) {
        $handler = new User($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["roles"]) || empty($_SESSION["roles"])) {
        $handler = new Role($conn);
        $handler->readAll();
    }

    if (!empty($_SESSION["flash"])) {
        echo '<div class="alert alert-danger">' . $_SESSION["flash"] . '</div>';
        unset($_SESSION["flash"]);
    }

    function findUserById($users, $id) {
        foreach ($users as $user) {
            if ($user['id'] == $id && $user['is_deleted'] == '0') {
                return $user;
            }
        }
        return null;
    }

    function findOfferByCommandeId($offers, $commandeId) {
        foreach ($offers as $offer) {
            if ($offer['commande_id'] == $commandeId) {
                return $offer;
            }
        }
        return null;
    }


    function findRoleByUserId($roles, $userId) {
        foreach ($roles as $role) {
            if ($role['user_id'] == $userId) {
                return $role['role_name'];
            }
        }
        return null;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard: My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/assets/images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<style>
    .text-muted {
        color: #9ca3af !important;
    }
</style>
<body>
    <header class="sticky-top dark border-border-light shadow-sm py-3 px-4 d-flex justify-content-between align-items-center">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-2" style="width: 40px; height: 40px;">
                <i class="bi bi-truck"></i>
                </div>
                <span class="fw-bold fs-5 mb-0">Admin Portal</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <ul class="navbar-nav d-none d-md-flex flex-row gap-3">
                    <li class="nav-item"><a class="nav-link fw-bold text-primary" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_users_roles_management.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_admins_management.php">Admins</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_deliverer_management.php">Deliverers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_client_management.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_orders_management.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_offers_management.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="#">Settings</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-secondary p-0"><i class="bi bi-bell"></i></button>
                    <a href="/Logout"><i class="bi bi-box-arrow-right fs-5"></i></a>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="updateUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-light border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="../../src/Controller/UpdateUserHandler.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="user_id">

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">UserName</label>
                                <input type="text" name="username" id="username" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control bg-dark text-light" required>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control bg-dark text-light" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-light border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Update Offer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="../../src/Controller/UpdateOfferHandler.php" id="updateOrderForm">
                    <div class="modal-body">
                        <input type="hidden" id="offer_id" name="offer_id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Order ID</label>
                                <input type="text" id="commande_id" class="form-control bg-dark text-light" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" class="form-select bg-dark text-light">
                                    <option value="pending">Pending</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Vehicle</label>
                                <select id="vehicle" name="vehicle" class="form-select bg-dark text-light">
                                    <option value="bike">Bike</option>
                                    <option value="car">Car</option>
                                    <option value="truck">Truck</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Price (MAD)</label>
                                <input type="number" id="price" name="price" class="form-control bg-dark text-light">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateCommandeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-light border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Update Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="../../src/Controller/UpdateCommandHandler.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Order ID</label>
                            <input type="text" id="commande_ref" name="id" class="form-control bg-dark text-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" id="title" name="titre" class="form-control bg-dark text-light">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control bg-dark text-light">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control bg-dark text-light">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="commande_status" class="form-select bg-dark text-light" required>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>