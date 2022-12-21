<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Social Media</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Data Social Media</li>
      <li class="breadcrumb-item active">Add Social Media</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user me-1"></i>
        Create Social Media
      </div>
      <div class="card-body">
        <form action="/admin/social_media" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <div class="row d-flex align-items-center">
                  <div class="col-6">
                    <label for="icon" class="form-label">Icon</label>
                    <input class="form-control  <?= ($validation->hasError('icon')) ? 'is-invalid' : '' ?>" type="file"
                      id="icon" onchange="previewImg()" name="icon">
                    <div class="invalid-feedback">
                      <?= $validation->getError('icon') ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <img src="/img/default.png" alt="" style="width: 150px;" id="imgPreview">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control  <?= ($validation->hasError('url')) ? 'is-invalid' : '' ?>"
                  id=" url" placeholder="your url" name="url" value="<?= old('url') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('url') ?>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="active" value="1">
                  <label class="form-check-label" for="active">
                    Active
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="deactive" checked value="0">
                  <label class="form-check-label" for="deactive">
                    Deactive
                  </label>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
function previewImg() {
  const icon = document.querySelector('#icon');
  const imgPreview = document.querySelector('#imgPreview');

  const fileIcon = new FileReader();
  fileIcon.readAsDataURL(icon.files[0]);

  fileIcon.onload = function(e) {
    imgPreview.src = e.target.result;
  }
}
</script>