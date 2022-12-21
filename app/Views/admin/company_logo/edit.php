<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Edit Company Logo</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Data Company Logo</li>
      <li class="breadcrumb-item active">Edit Company Logo</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user me-1"></i>
        Edit Company Logo
      </div>
      <div class="card-body">
        <form action="/admin/company_logo/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="oldImages" value="<?= $data['images'] ?>">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <div class="row d-flex align-items-center">
                  <div class="col-6">
                    <label for="images" class="form-label">Images</label>
                    <input class="form-control  <?= ($validation->hasError('images')) ? 'is-invalid' : '' ?>" type="file"
                      id="images" onchange="previewImg()" name="images">
                    <div class="invalid-feedback">
                      <?= $validation->getError('images') ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <img src="/img/<?= $data['images'] ?>" alt="" style="width: 150px; height: 150px; object-fit: cover;"
                      id="imgPreview">
                  </div>
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