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
      <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-light shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <p class="text-muted small mb-0">Total Deliverers</p>
                <span class="material-symbols-outlined text-primary">groups</span>
              </div>
              <div class="d-flex align-items-end gap-2 mt-2">
                <h3 class="fw-bold mb-0">124</h3>
                <span class="text-success small d-flex align-items-center gap-1">
                  <span class="material-symbols-outlined fs-6">trending_up</span> 5%
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-light shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <p class="text-muted small mb-0">Active Now</p>
                <span class="material-symbols-outlined text-success">check_circle</span>
              </div>
              <div class="d-flex align-items-end gap-2 mt-2">
                <h3 class="fw-bold mb-0">86</h3>
                <span class="text-success small d-flex align-items-center gap-1">
                  <span class="material-symbols-outlined fs-6">trending_up</span> 12%
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-light shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <p class="text-muted small mb-0">On Leave</p>
                <span class="material-symbols-outlined text-warning">beach_access</span>
              </div>
              <div class="d-flex align-items-end gap-2 mt-2">
                <h3 class="fw-bold mb-0">12</h3>
                <span class="text-warning small d-flex align-items-center gap-1">
                  <span class="material-symbols-outlined fs-6">trending_down</span> 2%
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-light shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <p class="text-muted small mb-0">Suspended</p>
                <span class="material-symbols-outlined text-secondary">block</span>
              </div>
              <div class="d-flex align-items-end gap-2 mt-2">
                <h3 class="fw-bold mb-0">5</h3>
                <span class="text-muted small">0%</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters & Search -->
      <div class="card mb-4 p-3 border-light shadow-sm d-flex flex-column flex-md-row gap-2 align-items-start align-items-md-center">
        <div class="flex-fill position-relative mb-2 mb-md-0">
          <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-2 text-muted">search</span>
          <input type="text" class="form-control ps-5" placeholder="Search by name or email...">
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

      <!-- Data Table -->
      <div class="card border-light shadow-sm overflow-auto">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Vehicle</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Row example -->
            <tr>
              <td class="d-flex align-items-center gap-2">
                <div class="avatar" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuA4lLxTzThmzDLPd8TQU7NWenc-J-0hkErWeRlhjtkp9z6GCFaOH1MobgM_bwr_rhyaLlE7XiQr0bsSaUBtXXqFdfRJ_GuWMe0jG9zwx9zahWrwf-yGcSwMAYyVjLcToYlMavR31uQNy4kqq3jpdUr_xtnjTCVc98ed7eV3nH25p_3R9E47bOXKOlZF_xQZCG-RuU_EPtIQ6PitD9hdJo32TJL8NaUDxC8UBztfHMCFNClmNtO9cgYM-x1Le6UcKk-4xPUwvXTP-aQ');"></div>
                <div>
                  <div>John Doe</div>
                  <small class="text-muted">ID: #DL-8842</small>
                </div>
              </td>
              <td>
                <div>john.doe@example.com</div>
                <small class="text-muted">+1 (555) 123-4567</small>
              </td>
              <td class="d-flex align-items-center gap-2">
                <div class="p-1 bg-primary bg-opacity-10 rounded"><span class="material-symbols-outlined text-primary fs-5">local_shipping</span></div>
                <span>Van</span>
              </td>
              <td><span class="badge bg-success"><span class="status-dot bg-success me-1"></span>Active</span></td>
              <td class="text-end">
                <button class="btn btn-sm btn-light"><span class="material-symbols-outlined fs-5">edit</span></button>
                <button class="btn btn-sm btn-light"><span class="material-symbols-outlined fs-5">directions_car</span></button>
                <button class="btn btn-sm btn-light text-danger"><span class="material-symbols-outlined fs-5">delete</span></button>
              </td>
            </tr>
            <!-- Add other rows similarly -->
          </tbody>
        </table>

        <!-- Pagination -->
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
