<?= $this->extend('Layout/layout'); ?>
<?= $this->section('content') ?>
<div class="bg-white rounded shadow table-responsive p-3">
  <table class="datatables-keuangan table border-top">
    <h1><?= session()->get('email') ?></h1>
    <thead>
      <tr>
        <th>No</th>
        <th>Judul Dokumen</th>
        <th>Tahun Dokumen</th>
        <th>Tanggal Upload</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
  </table>
</div>
<?= $this->endSection() ?>