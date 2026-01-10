  <?php require '../includes/header_admin.php'; ?>
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h1 class="h3 fw-bold">User Management</h1>
            <p class="text-muted">Manage access, roles, and statuses for all platform users.</p>
        </div>
        <button class="btn btn-primary btn-primary-custom d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Add New User
        </button>
    </div>
    <div class="card card-light mb-4 p-3 d-flex flex-column flex-md-row gap-2 align-items-md-center">
        <div class="input-group" style="max-width:300px;">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control bg-dark" placeholder="Search user">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Alice Freeman</td>
                        <td>alice@example.com</td>
                        <td><span class="badge badge-role">Deliverer</span></td>
                        <td>
                            <span class="d-flex align-items-center gap-1">
                                <span class="rounded-circle bg-success" style="width:8px;height:8px;"></span>
                                Active
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
