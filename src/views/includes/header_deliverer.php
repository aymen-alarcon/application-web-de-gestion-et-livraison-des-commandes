<?php 
    session_start();
    
    if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "deliverer") {
        header("Location: ../logout.php");
    }

    if (!empty($_SESSION["flash"])) {
        echo '<div class="alert alert-danger">' . $_SESSION["flash"] . '</div>';
        unset($_SESSION["flash"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Available Orders — SwiftRoute</title>
    <link rel="shortcut icon" href="../../public/assets/images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

    <style>
        body {
            background:#0b131c;
            color:#e4edf5;
        }

        .card {
            background:#111c27;
            border:1px solid #1b2733;
            color:#e4edf5;
        }

        .badge-outline {
            border:1px solid #2c3a47;
            background:#0f1822;
            color:#6fb5ff;
        }
        .text-muted {
            color: #9ca3af !important;
        }
        .list-group-item {
            background: transparent;
            border-color: #1f2a37;
            color: #e5e7eb;
        }
    </style>
</head>
<body>
    <header class="sticky-top dark border-border-light shadow-sm">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2 text-white" href="#">
                    <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                        <i class="bi bi-truck text-white"></i>
                    </div>
                    <strong>SwiftRoute</strong>
                </a>
                <ul class="navbar-nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'deliverer_dashboard.php' ? 'active fw-semibold border-bottom border-2 border-primary text-white' : 'text-white' ?>" href="deliverer_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../src/Controller/ReadAllCommandesHandler.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'deliverer_orders.php' ? 'active fw-semibold border-bottom border-2 border-primary text-white' : 'text-white' ?>" href="deliverer_orders.php">Available Orders</a>
                    </li>
                    <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'deliverer_acitivity.php' ? 'active fw-semibold border-bottom border-2 border-primary text-white' : 'text-white' ?>" href="deliverer_acitivity.php">My Activity</a></li>
                    <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'deliverer_profile.php' ? 'active fw-semibold border-bottom border-2 border-primary text-white' : 'text-white' ?>" href="deliverer_profile.php">Profile</a></li>
                </ul>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-link text-secondary p-0"><i class="bi bi-bell"></i></button>
                        <a href="../logout.php"><i class="bi bi-box-arrow-right fs-5"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>