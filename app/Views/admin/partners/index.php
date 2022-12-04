<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Data Partners</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Partners</li>
    </ol>
    <a href="partners/add" class="btn btn-primary mb-4">Add Partners</a>
    <?php if (session()->getFlashdata('msg')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('msg') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Partners List
      </div>
      <div class="card-body">
        <table id="datatablesSimple">
          <thead>
            <tr>
              <th>No</th>
              <th>Images</th>
              <th>Link</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Images</th>
              <th>Link</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($data as $key => $d) : ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><img src="/img/<?= $d['images'] ?>" alt="" width="70"></td>
              <td><a href="http://<?= $d['link'] ?>" target="_blank"><?= $d['link'] ?></a></td>
              <td>
                <?= $d['status'] == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Deactive</span>' ?>
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  <a href="partners/edit/<?= $d['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> |
                  <form action="/admin/partners/<?= $d['id'] ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="all: unset; cursor: pointer; color: #dc3545;"
                      onclick="return confirm('Want to delete this item?')"><i class="fa-solid fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>