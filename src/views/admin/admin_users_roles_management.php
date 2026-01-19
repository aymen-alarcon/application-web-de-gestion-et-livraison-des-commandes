<?php require 'src/Views/includes/header_admin.php'; ?>

<div class="container-xl py-5">
    <h1 class="fw-black mb-4">User Management</h1>
    <p class="text-secondary mb-4">View all users and update their roles.</p>

    <div class="card shadow-sm overflow-auto">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['users'] as $user): ?>
                    <?php
                        if ($user['is_deleted'] === '1') continue;

                        $role = findRoleByUserId($_SESSION['roles'], $user['id']);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <form method="POST" action="../../src/Controller/UpdateRoleHandler.php" class="d-flex gap-2 align-items-center justify-content-end">
                            <td>
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <select name="role_name" class="form-select form-select-sm" style="width:150px;">
                                    <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="deliverer" <?= $role === 'deliverer' ? 'selected' : '' ?>>Deliverer</option>
                                    <option value="client" <?= $role === 'client' ? 'selected' : '' ?>>Client</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'src/Views/includes/footer.php'; ?>
