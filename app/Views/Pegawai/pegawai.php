<?= $this->extend('Layout/layout'); ?>
<?= $this->section('content') ?>
<form action="<?= base_url('/proses_edit_pegawai/' . $pegawai[0]->idUser) ?>" method="post" enctype="multipart/form-data">
  <?php if (session()->getFlashdata('msg_error')) { ?>
    <div class="alert alert-danger p-1 rounded-4 d-flex align-items-center gap-2">
      <i class="lni lni-warning"></i> <?= session()->getFlashdata('msg_error') ?>
    </div>
  <?php } else if (session()->getFlashdata('msg_success')) { ?>
    <div class="alert alert-success p-1 rounded-4 d-flex align-items-center gap-2">
      <i class="lni lni-thumbs-up"></i> <?= session()->getFlashdata('msg_success') ?>
    </div>
  <?php } ?>
  <div class="row">
    <div class="col-md-3">
      <div class="avatar-upload">
        <div class="avatar-edit">
          <input type="file" id="imageUpload" name="fotoProfil" />
          <label for="imageUpload">
            <i class="lni lni-camera" style="font-size: 1.5rem;"></i>
          </label>
        </div>
        <div class="avatar-preview">
          <?php if ($pegawai[0]->fotoProfil == NULL) { ?>
            <div id="imagePreview" style="background-image: url('<?= base_url('/account.png'); ?>');"></div>
          <?php } else { ?>
            <div id="imagePreview" style="background-image: url('<?= base_url('uploads/' . $pegawai[0]->fotoProfil) ?>');"></div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="mb-3">
        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="namaLengkap" placeholder="Nama Lengkap" value="<?= $pegawai[0]->namaLengkap ?>">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $pegawai[0]->email ?>" disabled>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $pegawai[0]->password ?>">
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <input type="text" class="form-control" name="role" placeholder="Role" value="<?= $pegawai[0]->role ?>" disabled>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success fw-bold px-5 py-2">Submit</button>
      </div>
    </div>
  </div>
</form>
<?= $this->endSection(); ?>