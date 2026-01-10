<?php 
    require "../../src/Database/DatabaseConnection.php" ;
    require '../../src/Repositories/CommandeRepository.php'; 
    require '../../src/Repositories/OfferRepository.php'; 
    require '../../src/Repositories/UserRepository.php'; 
    require '../../src/Repositories/RoleRepository.php'; 

    session_start();

    if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
        header("Location: ../logout.php");
    }

    $db = new DatabaseConnection();
    $conn = $db->connect();
    
    if (!isset($_SESSION["offers"])) {
        $handler = new OfferRepository($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["commandes"])) {
        $handler = new CommandeRepository($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["users"])) {
        $handler = new UserRepository($conn);
        $handler->readAll();
    }

    if (!isset($_SESSION["roles"])) {
        $handler = new RoleRepository($conn);
        $handler->readAll();
    }

    if (!empty($_SESSION["flash"])) {
        echo '<div class="alert alert-danger">' . $_SESSION["flash"] . '</div>';
        unset($_SESSION["flash"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard: My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_admins_management.php.php">Admins</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_deliverer_management.php">Deliverers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_user_management.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_orders_management.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="admin_orders_management.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="#">Settings</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-secondary p-0"><i class="bi bi-bell"></i></button>
                    <a href="../logout.php"><i class="bi bi-box-arrow-right fs-5"></i></a>
                </div>
            </div>
        </div>
    </header>