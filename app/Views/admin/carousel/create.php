<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Add Carousel</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Data Carousel</li>
      <li class="breadcrumb-item active">Add Carousel</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user me-1"></i>
        Create Carousel
      </div>
      <div class="card-body">
        <form action="/admin/carousel" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <div class="row d-flex align-items-center">
                  <div class="col-6">
                    <label for="images" class="form-label">Images</label>
                    <input class="form-control  <?= ($validation->hasError('images')) ? 'is-invalid' : '' ?>"
                      type="file" id="images" onchange="previewImg()" name="images">
                    <div class="invalid-feedback">
                      <?= $validation->getError('images') ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <img src="/img/default.png" alt="" style="width: 200px;" id="imgPreview">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control  <?= ($validation->hasError('link')) ? 'is-invalid' : '' ?>"
                  id="link" placeholder="link to" name="link" value="<?= old('link') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('link') ?>
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
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>"
                  id="title" placeholder="carousel title" name="title" value="<?= old('title') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('title') ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control  <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>"
                  id="description" placeholder="carousel description" name="description" cols="30"
                  rows="10"><?= old('description') ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('description') ?>
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