<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Certificate</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Data Certificate</li>
      <li class="breadcrumb-item active">Add Certificate</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user me-1"></i>
        Create Certificate
      </div>
      <div class="card-body">
        <form action="/admin/certificate" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <div class="row d-flex align-items-center">
                  <div class="col-6">
                    <label for="images" class="form-label">images</label>
                    <input class="form-control  <?= ($validation->hasError('images')) ? 'is-invalid' : '' ?>"
                      type="file" id="images" onchange="previewImg()" name="images">
                    <div class="invalid-feedback">
                      <?= $validation->getError('images') ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <img src="/img/default.png" alt="" style="width: 150px;" id="imgPreview">
                  </div>
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
  const images = document.querySelector('#images');
  const imgPreview = document.querySelector('#imgPreview');

  const fileImages = new FileReader();
  fileImages.readAsDataURL(images.files[0]);

  fileImages.onload = function(e) {
    imgPreview.src = e.target.result;
  }
}
</script>