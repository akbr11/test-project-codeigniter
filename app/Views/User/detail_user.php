<?= $this->extend('Layout/layout'); ?>
<?= $this->section('content') ?>
<div class="mt-1">
  <div class="d-flex p-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard-user') ?>" class="text-decoration-none fs-5 text-primary">Data User</a></li>
        <li class="breadcrumb-item fs-5 active" aria-current="page">Detail User</li>
      </ol>
    </nav>
  </div>
  <div class="bg-white rounded shadow p-3">
    <div class="row">
      <div class="col-md-12">
        <div class="mb-3">
          <label for="fotoProfil" class="form-label">Foto Profil</label>
          <?php if (!empty($user->fotoProfil)) : ?>
            <div class="mb-3">
              <img src="<?= base_url('') ?>" alt="Foto Profil" style="width: 50px; height: 50px;">
            </div>
          <?php endif; ?>
          <div class="mb-3">
            <img src="/account.png" alt="Foto Profil" style="width: 50px; height: 50px;">
          </div>
        </div>
        <div class="mb-3">
          <label for="namaLengkap" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" name="namaLengkap" placeholder="Nama Lengkap" value="<?= $user->namaLengkap ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $user->email ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $user->password ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-select form-select-md" name="role" id="year" disabled>
            <option selected hidden value="<?= $user->role ?>"><?= $user->role ?></option>
            <option value="Admin">Admin</option>
            <option value="Pegawai">Pegawai</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="statusAkun" class="form-label">Status Akun</label>
          <select class="form-select form-select-md" name="statusAkun" disabled>
            <option selected hidden value="<?= $user->statusAkun ?>"><?= $user->statusAkun ?></option>
            <option value="ACTIVE">ACTIVE</option>
            <option value="UNACTIVE">UNACTIVE</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>