<?php 
    require "../src/Database/DatabaseConnection.php" ;
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard: My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body>
    <header class="sticky-top dark border-border-light shadow-sm py-3 px-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded bg-primary text-white" style="width:40px; height:40px;">
                <i class="bi bi-truck"></i>
            </div>
            <h2 class="h5 m-0">QuickShip</h2>
        </div>
        <nav class="d-none d-md-flex gap-3">
            <a href="client_dashboard.php"
            class="text-decoration-none <?= basename($_SERVER['PHP_SELF']) === 'client_dashboard.php' ? 'text-primary' : 'text-secondary' ?>">
                Dashboard
            </a>

            <a href="client_order_dashboard.php"
            class="text-decoration-none <?= basename($_SERVER['PHP_SELF']) === 'client_order_dashboard.php' ? 'text-primary' : 'text-secondary' ?>">
                My Orders
            </a>

            <a href="../src/Controller/ReadHandler.php"
            class="text-decoration-none <?= basename($_SERVER['PHP_SELF']) === 'client_profile.php' ? 'text-primary' : 'text-secondary' ?>">
                Profile
            </a>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-link text-secondary p-0"><i class="bi bi-bell"></i></button>
            <a href="logout.php"><i class="bi bi-box-arrow-right fs-5"></i></a>
        </div>
    </header>
