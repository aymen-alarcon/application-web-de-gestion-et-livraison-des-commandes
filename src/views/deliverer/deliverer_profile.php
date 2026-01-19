<?php require "src/Views/includes/header_deliverer.php"; ?>
<div class="container-fluid min-vh-100 pb-5">
  <main class="container py-4" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold text-white">Account Settings</h1>
    </div>

    <div class="card card-dark shadow-sm mb-4 text-white">
      <div class="card-body d-flex flex-column flex-sm-row gap-4 align-items-center">

        <div class="position-relative">
          <div class="rounded-circle border border-4"
               style="width:96px;height:96px;background:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAxzQQa4emB3FPTf7FcsHRiWtT0q6LZIS3_tp02juukCmsQZFKYPU0Ns5dNxJekP8jmDlPZbpLW_5dWRSpK-oiczBzGPzxgQOLmluQwuQw0o-R48Ek-uMkt0n1NEgjVVODfKY8q09ahefWfbhR3J1oZL25uZAbK5RF4C89WZ44fYX6gACL6fMuR7wsn5-jhemCiV9_z0XfTmwuOqPhtlkNqSrk7oRVhAGlYQ8wbNWmCtZKvP7CIMcz4UDo9kES03ZMJzmVNg6oI6Hc') center/cover">
          </div>
          <button class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0">
            <i class="bi bi-pencil"></i>
          </button>
        </div>

        <div class="flex-fill">
          <h5 class="fw-bold text-white mb-1"><?= htmlspecialchars($_COOKIE["first_name"] . " " . $_COOKIE["last_name"])  ?></h5>
          <p class="text-muted-dark mb-2">Member since September 2023</p>
          <span class="badge bg-success bg-opacity-25 text-success">Client</span>
        </div>

        <button class="btn btn-outline-secondary text-white">
          Change Password
        </button>

      </div>
    </div>

    <form action="../../src/Controller/UpdateUserHandler.php" method="post">
    <h5 class="fw-bold text-white mb-3">Personal Information</h5>
    <div class="card card-dark mb-4 text-white">
      <div class="card-body">
        <div class="row g-4">
          <input type="number" name="id" hidden value="<?= htmlspecialchars($_SESSION["id"]) ?>">
          <div class="col-md-6">
            <label class="form-label text-white">First Name</label>
            <input class="form-control bg-dark text-white border-secondary" name = "first_name" value="<?= htmlspecialchars($_COOKIE["first_name"]) ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-white">Last Name</label>
            <input class="form-control bg-dark text-white border-secondary" name = "last_name" value="<?= htmlspecialchars($_COOKIE["last_name"]) ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-white">Username</label>
            <input class="form-control bg-dark text-white border-secondary" name = "username" value="<?= htmlspecialchars($_COOKIE["username"]) ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-white">Email</label>
            <input class="form-control bg-secondary bg-opacity-25 text-white" disabled value="<?= htmlspecialchars($_COOKIE["email"]) ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-white">Phone</label>
            <input class="form-control bg-dark text-white border-secondary" name = "phone" value="<?= htmlspecialchars($_COOKIE["phone"]) ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-white">address</label>
            <input class="form-control bg-dark text-white border-secondary" name = "address" value="<?= htmlspecialchars($_COOKIE["address"]) ?>">
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<div class="footer-bar position-fixed bottom-0 start-0 end-0 z-3 bg-opacity-75 py-3">
  <div class="container d-flex justify-content-end gap-3">
    <button class="btn btn-outline-secondary text-white">
      Cancel
    </button>
    <button type="submit" class="btn btn-primary fw-bold px-4">
      Save Changes
    </button>
  </div>
</div>
</form>
<?php require '../includes/footer.php'; ?>