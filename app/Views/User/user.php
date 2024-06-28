<?= $this->extend('Layout/layout'); ?>
<?= $this->section('content') ?>
<div class="bg-white rounded shadow table-responsive p-3">
  <?php if (session()->getFlashdata('msg_success')) : ?>
    <div class="alert alert-success p-1 rounded-4 d-flex align-items-center gap-2">
      <i class="lni lni-thumbs-up"></i> <?= session()->getFlashdata('msg_success') ?>
    </div>
  <?php endif; ?>
  <div class="d-flex align-items-center justify-content-between">
    <h4 class="mb-3">Data User</h4>
    <a href="<?= base_url('tambah_user') ?>" class="btn btn-blue btn-sm rounded d-flex align-items-center"><i class="lni lni-plus me-2"></i>Tambah User</a>
  </div>
  <table class="datatables-pegawai table border-top">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status Akun</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
  </table>
</div>

<script>
  $(function() {
    var dt_pegawai = $('.datatables-pegawai');

    if (dt_pegawai.length) {
      var dt_pegawai = dt_pegawai.DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
          url: '<?= base_url('datatable_user') ?>',
          type: 'POST'
        },
        columns: [{
            data: "idUser"
          },
          {
            data: "namaLengkap"
          },
          {
            data: "email"
          },
          {
            data: "role"
          },
          {
            data: "statusAkun"
          },
        ],
        columnDefs: [{
          targets: 5,
          orderable: false,
          render: function(data, type, row, meta) {
            return (
              '<div class="text-center">' +
              '<div class="d-inline-block h-25 pe-2">' +
              '<a href="javascript:void(0);" class="btn btn-sm btn-primary dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="lni lni-radio-button"></i></a>' +
              '<ul class="dropdown-menu dropdown-menu-end">' +
              '<li><a href="<?= base_url('/detail_user/') ?>' + row['idUser'] + '" class="dropdown-item">Detail</a></li>' +
              '<div class="dropdown-divider"></div>' +
              '<li><a onclick="deleteRecord(' + row['idUser'] + ')" class="dropdown-item text-danger delete-record">Hapus</a></li>' +
              '</ul>' +
              '</div>' +
              '<a href="<?= base_url('/edit_user/') ?>' + row['idUser'] + '" class="btn btn-sm text-primary btn-warning item-edit"><i class="lni lni-pencil"></i></a>' +
              '</div>'
            );
          },
        }, ],
        language: {
          "decimal": "",
          "emptyTable": "Tidak ada data dalam tabel",
          "info": "Tertampil _START_ ke _END_ dari _TOTAL_ pilihan",
          "infoEmpty": "Tertampilkan 0 ke 0 dari 0 pilihan",
          "infoFiltered": "(filtered from _MAX_ total entries)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": " _MENU_ Pilih per halaman",
          "loadingRecords": "Memuat...",
          "processing": "",
          "search": "Cari:",
          "zeroRecords": "Tidak ada data yang tersedia",
          "paginate": {
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          },
          "aria": {
            "orderable": "Order by this column",
            "orderableReverse": "Reverse order this column"
          }
        }
      });
    }
  });

  const deleteRecord = (id) => {
    Swal.fire({
      title: "Hapus Data",
      text: "Apakah anda yakin ingin menghapus data ini?",
      icon: "warning",
      showCancelButton: true,
      cancelButtonText: "Batal",
      confirmButtonText: "Hapus",
      showLoaderOnConfirm: true,
      preConfirm: async () => {
        try {
          const response = await fetch('<?= base_url('/delete_user/') ?>' + id, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
            },
          });
          if (!response.ok) {
            throw new Error(response.statusText);
          }
          const verificationResult = await response.json();
          if (!verificationResult.status) {
            throw new Error(verificationResult.message);
          }
          Swal.fire("Berhasil!", verificationResult.message, "success");
          $('.datatables-keuangan').DataTable().ajax.reload();
        } catch (error) {
          Swal.showValidationMessage(error.message);
        }
      }
    })
  }
</script>
<?= $this->endSection() ?>