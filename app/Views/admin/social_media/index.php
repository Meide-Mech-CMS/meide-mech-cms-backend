<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Data Social Media</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Data Social Media</li>
    </ol>
    <a href="social_media/add" class="btn btn-primary mb-4">Add Social Media</a>
    <?php if (session()->getFlashdata('msg')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('msg') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Social Media List
      </div>
      <div class="card-body">
        <table id="datatablesSimple">
          <thead>
            <tr>
              <th>No</th>
              <th>Icon</th>
              <th>URL</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Icon</th>
              <th>URL</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($data as $key => $d) : ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><img src="/img/<?= $d['icon'] ?>" alt="" width="70"></td>
              <td><a href="http://<?= $d['url'] ?>" target="_blank"><?= $d['url'] ?></a></td>
              <td>
                <?= $d['status'] == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Deactive</span>' ?>
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  <a href="social_media/edit/<?= $d['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> |
                  <form action="/admin/social_media/<?= $d['id'] ?>" method="POST">
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