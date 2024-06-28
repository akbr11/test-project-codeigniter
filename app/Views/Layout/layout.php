<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap5.css">

  <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
  <script defer src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
  <script defer src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap5.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex">
        <div class="side-icon">
          <i class="lni lni-grid-alt"></i>
        </div>
        <div class="sidebar-logo">
          <a href="#" class="text-capitalize">test project</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link active">
            <i class="lni lni-user"></i>
            <span>Data User</span>
          </a>
        </li>
      </ul>
    </aside>
    <div class="main">
      <nav class="navbar navbar-expand px-3 py-3">
        <button class="toggle-btn btn " type="button">
          <i class="lni lni-text-align-left text-black"></i>
        </button>
        <div class="d-none d-sm-inline-block">
          <h5 class="text-capitalize">dashboard</h5>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                <img src="/account.png" class="avatar img-fluid" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-end rounded">
                <ul>
                  <li class="d-flex align-items-center">
                    <a href="<?= base_url('/logout') ?>" class="dropdown-item">
                      <i class="lni lni-exit"></i>
                      Keluar
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <main class="content px-1 py-1">
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div>
      </main>
    </div>
  </div>
  <script src="/assets/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>