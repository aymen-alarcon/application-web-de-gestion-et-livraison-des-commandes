  <?php require '../includes/header_admin.php'; ?>
  <main class="flex-fill py-4 bg-transparent">
    <div class="container-lg">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end gap-3 mb-4">
        <div>
          <h1 class="fw-bold display-6">Deliverer Management</h1>
          <p class="text-muted">Manage your delivery fleet accounts, vehicle assignments, and status.</p>
        </div>
        <button class="btn btn-primary d-flex align-items-center gap-2">
          <span class="material-symbols-outlined">add</span>
          Add New Deliverer
        </button>
      </div>
      <div class="card mb-4 p-3 shadow d-flex flex-column flex-md-row gap-2">
        <div class="flex-fill position-relative mb-2 mb-md-0">
          <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-2 text-muted">search</span>
          <input type="text" class="form-control bg-dark ps-5" placeholder="Search by name or email...">
        </div>
        <div class="d-flex gap-2 overflow-auto w-100 w-md-auto">
          <div class="position-relative">
            <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-2 text-muted">filter_list</span>
            <select class="form-select ps-5 pe-4">
              <option value="">All Statuses</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <option value="suspended">Suspended</option>
            </select>
          </div>
          <div class="position-relative">
            <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-2 text-muted">directions_car</span>
            <select class="form-select ps-5 pe-4">
              <option value="">All Vehicles</option>
              <option value="van">Van</option>
              <option value="bike">Bike</option>
              <option value="scooter">Scooter</option>
            </select>
          </div>
        </div>
      </div>
      <div class="card shadow-sm overflow-auto">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th><input type="checkbox"></th>
              <th>ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>email</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['users'] as $user): ?>
                <?php
                    if ($user['is_deleted'] === '1') continue;

                    $role = findRoleByUserId($_SESSION['roles'], $user['id']);
                    if ($role !== 'client') continue;
                ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>CLT #<?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['address']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td>
                        <span class="d-flex align-items-center gap-1">
                            <span class="rounded-circle bg-success" style="width:8px;height:8px;"></span>
                            Active
                        </span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary edit-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal"
                            data-id="<?= $user['id'] ?>"
                            data-username="<?= htmlspecialchars($user['username']) ?>"
                            data-first-name="<?= htmlspecialchars($user['first_name']) ?>"
                            data-last-name="<?= htmlspecialchars($user['last_name']) ?>"
                            data-email="<?= htmlspecialchars($user['email']) ?>"
                            data-address="<?= htmlspecialchars($user['address']) ?>"
                            data-phone="<?= htmlspecialchars($user['phone']) ?>"
                        >
                          <i class="bi bi-pencil"></i>
                        </button>
                        <a href="../../src/Controller/DeleteHandler.php?entityClass=User&id=<?php if(isset($user["id"])): echo $user["id"] ; endif; ?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center p-3 border-top">
          <div class="small text-muted">
            Showing <span class="fw-bold text-dark">1</span> to <span class="fw-bold text-dark">5</span> of <span class="fw-bold text-dark">124</span> results
          </div>
          <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" disabled>Previous</button>
            <button class="btn btn-outline-secondary btn-sm">Next</button>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php require '../includes/footer.php'; ?>