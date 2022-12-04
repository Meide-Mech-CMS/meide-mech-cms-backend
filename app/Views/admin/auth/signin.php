<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login</title>
  <link href="/css/admin.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <?php if (session()->getFlashdata('msg')) : ?>
                  <div class="alert alert-danger">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                  <?php endif; ?>
                  <form action="/signin" method="post">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="username" type="text" placeholder="name@example.com"
                        name="username" value="<?= old('username') ?>" />
                      <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password" type="password" placeholder="Password"
                        name="password" />
                      <label for="password">Password</label>
                    </div>
                    <div class="g-recaptcha mb-3" data-sitekey="6LeO0E4jAAAAAOOR5AZSLFpipt7qCxj2pEUW2UNp"></div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                      <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2022</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="/js/scripts.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>