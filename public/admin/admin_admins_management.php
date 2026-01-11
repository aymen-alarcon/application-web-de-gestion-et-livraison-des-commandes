  <?php require '../includes/header_admin.php'; ?>
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h1 class="h3 fw-bold">Admin Management</h1>
            <p class="text-muted">Manage access, roles, and statuses for all platform Admins.</p>
        </div>
        <button class="btn btn-primary btn-primary-custom d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Add New Admin
        </button>
    </div>
    <div class="card card-light mb-4 p-3 d-flex flex-column flex-md-row gap-2 align-items-md-center">
        <div class="input-group" style="max-width:300px;">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control bg-dark" placeholder="Search Admin">
        </div>
        <div class="d-flex justify-content-between gap-2 w-100">
            <select class="form-select  w-100">
                <option>All Roles</option>
                <option>Admin</option>
                <option>Deliverer</option>
                <option>Client</option>
            </select>
            <select class="form-select  w-100">
                <option>Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
            <button class="btn btn-outline-secondary w-100" >
                <i class="bi bi-funnel-fill"></i> Filters
            </button>
        </div>
    </div>
    <div class="card card-light shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['users'] as $user): ?>
                        <?php
                            if ($user['is_deleted'] === '1') continue;

                            $role = findRoleByUserId($_SESSION['roles'], $user['id']);
                            if ($role !== 'admin') continue;
                        ?>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>ADM #<?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <span class="d-flex align-items-center gap-1">
                                    <span class="rounded-circle bg-success" style="width:8px;height:8px;"></span>
                                    Active
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <a href="../../src/Controller/DeleteHandler.php?entityClass=User&id=<?php if(isset($user["id"])): echo $user["id"] ; endif; ?>"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3">
            <small class="text-muted">Showing 1–5 of 1248</small>
            <ul class="pagination mb-0">
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
            </ul>
        </div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>