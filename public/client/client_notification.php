<?php 
require "../includes/header_client.php";

if (!isset($_SESSION["notifications"]) || empty($_SESSION["notifications"])) {
    header("Location: ../../src/Controller/ReadNotificationHandler.php");
    exit();
}

$notifications = $_SESSION["notifications"];
?>

<style>
.notification-item {
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}
.notification-item:hover {
  border-color: rgba(19, 127, 236, 0.5);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.notification-dot {
  width: 10px;
  height: 10px;
  background-color: var(--primary);
  border-radius: 50%;
}
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.tab-badge {
  font-size: 10px;
  padding: 0.125rem 0.4rem;
}
</style>
</head>

<main class="container py-5" style="max-width:1000px;">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
      <div class="d-flex align-items-center gap-2 mb-1">
        <h1 class="fw-bold fs-2">Notification Center</h1>
        <span class="badge text-primary bg-primary bg-opacity-10 text-uppercase fw-bold"><?= count($notifications) ?> New</span>
      </div>
      <p class="text-secondary mb-0">Manage and view all your delivery alerts and system updates.</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-secondary d-flex align-items-center gap-1">
        <i class="bi bi-trash"></i>
        Clear all
      </button>
    </div>
  </div>

  <ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a class="nav-link active d-flex align-items-center gap-1" href="#">All
        <span class="badge bg-primary tab-badge text-white"><?= count($notifications) ?></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Unread</a>
    </li>
  </ul>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <button class="btn btn-outline-primary d-flex align-items-center gap-1">
      <i class="bi bi-check2-all"></i>
      Mark all as read
    </button>
    <div class="d-flex align-items-center text-secondary gap-1">
      <i class="bi bi-funnel"></i>
      Sort by: Newest
    </div>
  </div>

  <div class="d-flex flex-column gap-3">
    <?php foreach($notifications as $notification): ?>
      <?php
        $isSeen = $notification['statu'] === 'Seen';
        $bgClass = $isSeen ? 'bg-secondary bg-opacity-10 text-secondary' : 'bg-primary bg-opacity-10 text-primary';
        $opacityClass = $isSeen ? 'opacity-75' : '';
        $iconClass = 'bi-bell-fill';
        $timeAgo = $notification['created_at'];
      ?>
      <div class="d-flex align-items-start gap-3 p-3 border rounded-3 notification-item <?= $opacityClass ?>" role="button">
        <div class="flex-shrink-0 d-flex align-items-center justify-content-center <?= $bgClass ?> rounded-3" style="width:48px; height:48px;">
          <i class="bi <?= $iconClass ?> fs-4"></i>
        </div>
        <div class="flex-grow-1">
          <div class="d-flex justify-content-between mb-1">
            <h3 class="fw-bold mb-0 fs-6"><?= htmlspecialchars($notification['contenu']) ?></h3>
            <span class="text-secondary small"><?= $timeAgo ?></span>
          </div>
          <p class="text-secondary mb-0 small line-clamp-2">
            Notification ID: <?= $notification['id'] ?> | Sender ID: <?= $notification['sender_id'] ?>
          </p>
        </div>
        <?php if (!$isSeen): ?>
        <div class="d-flex align-items-center">
          <div class="notification-dot"></div>
        </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="text-center mt-4">
    <button class="btn btn-outline-secondary">Load previous notifications</button>
  </div>
</main>

<?php require "../includes/footer.php"; ?>
