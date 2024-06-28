<?= $this->extend('Layout/layout'); ?>
<?= $this->section('content') ?>
<div class="mt-1">
  <div class="d-flex p-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard-user') ?>" class="text-decoration-none fs-5 text-primary">Data User</a></li>
        <li class="breadcrumb-item fs-5 active" aria-current="page">Edit User</li>
      </ol>
    </nav>
  </div>
  <div class="bg-white rounded shadow p-3">
    <?php if (session()->getFlashdata('msg_error')) : ?>
      <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
        <i class="lni lni-warning"></i> <?= session()->getFlashdata('msg_error') ?>
      </div>
    <?php endif; ?>
    <form action="<?= base_url('/proses_edit_user/' . $user->idUser) ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="namaLengkap" placeholder="Nama Lengkap" value="<?= $user->namaLengkap ?>">
          </div>
          <?php if (isset($validation) && $validation->getError('namaLengkap')) { ?>
            <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
              <i class="lni lni-warning"></i> <?= $validation->getError('namaLengkap'); ?>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $user->email ?>">
          </div>
          <?php if (isset($validation) && $validation->getError('email')) { ?>
            <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
              <i class="lni lni-warning"></i> <?= $validation->getError('email'); ?>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $user->password ?>">
          </div>
          <?php if (isset($validation) && $validation->getError('password')) { ?>
            <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
              <i class="lni lni-warning"></i> <?= $validation->getError('password'); ?>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select form-select-md" name="role" id="year" required>
              <option selected hidden value="<?= $user->role ?>"><?= $user->role ?></option>
              <option value="Admin">Admin</option>
              <option value="Pegawai">Pegawai</option>
            </select>
          </div>
          <?php if (isset($validation) && $validation->getError('role')) { ?>
            <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
              <i class="lni lni-warning"></i> <?= $validation->getError('role'); ?>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="statusAkun" class="form-label">Status Akun</label>
            <select class="form-select form-select-md" name="statusAkun" required>
              <option selected hidden value="<?= $user->statusAkun ?>"><?= $user->statusAkun ?></option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="UNACTIVE">UNACTIVE</option>
            </select>
          </div>
          <?php if (isset($validation) && $validation->getError('statusAkun')) { ?>
            <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
              <i class="lni lni-warning"></i> <?= $validation->getError('statusAkun'); ?>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success fw-bold px-5 py-2">Submit</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>