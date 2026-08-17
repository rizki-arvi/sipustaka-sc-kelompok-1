<?php
// $active harus di-set di halaman pemanggil sebelum include ini,
// nilainya salah satu dari: dashboard, koleksi, daftar, tambah
$active = $active ?? '';
function nav_active($key, $active){ return $key === $active ? 'active' : ''; }
?>
<aside class="sidebar">
  <div class="avatar"><i class="bi bi-person-fill"></i></div>
  <nav>
    <a href="index.php" class="nav-link <?= nav_active('daftar', $active) ?>">
      <i class="bi bi-journal-bookmark-fill"></i> Daftar Buku
    </a>
    <a href="tambah.php" class="nav-link <?= nav_active('tambah', $active) ?>">
      <i class="bi bi-file-earmark-post-fill"></i> Buku Saya
    </a>
  </nav>
  <div class="footer-links">
    <a href="#" class="btn"><i class="bi bi-gear-fill me-1"></i> Setelan</a>
    <a href="#" class="btn"><i class="bi bi-person-circle me-1"></i> Profile</a>
  </div>
  <div class="sidebar-bottom-block"></div>
</aside>
