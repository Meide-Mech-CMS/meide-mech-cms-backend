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


<body>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-5">

        <h2>Login in</h2>

        <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-warning">
          <?= session()->getFlashdata('msg') ?>
        </div>
        <?php endif; ?>
        <form action="/signin" method="post">
          <div class="form-group mb-3">
            <input type="text" name="username" placeholder="Username" class="form-control">
          </div>
          <div class="form-group mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control">
          </div>

          <div class="g-recaptcha mb-3" data-sitekey="6LeO0E4jAAAAAOOR5AZSLFpipt7qCxj2pEUW2UNp"></div>

          <div class="d-grid">
            <button type="submit" class="btn btn-success">Signin</button>
          </div>
        </form>
      </div>

    </div>
  </div>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>