<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Activity Log</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Activity Log</li>
    </ol>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-user me-1"></i>
        Last Activity
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3">
              <label for="full_name" class="form-label">Last Login</label>
              <input type="text" class="form-control" value="<?= $data['last_login'] ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="full_name" class="form-label">User IP</label>
              <input type="text" class="form-control" value="<?= $data['last_login_ip'] ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="full_name" class="form-label">User Agent</label>
              <input type="text" class="form-control" value="<?= $data['last_login_agent'] ?>" disabled>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3">
              <label for="full_name" class="form-label">Browser</label>
              <input type="text" class="form-control" value="<?= $data['browser_name'] ?>" disabled>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>