<?php
$pageTitle = 'Tambah Buku';
$active = 'tambah';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include 'includes/head.php'; ?>
</head>
<body>
<div class="app-shell">
  <?php include 'includes/sidebar.php'; ?>

  <main class="main-content">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
      <div>
        <h3 class="page-title mb-0">Tambah Buku</h3>
        <div class="page-subtitle mb-0">Lengkapi data buku untuk menambah koleksi baru.</div>
      </div>
      <img src="assets/img/logo.png" alt="SIPUSTAKA" class="topbar-logo-img">
    </div>

    <form action="service/action.php" method="POST" enctype="multipart/form-data">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="text-muted small fw-semibold mb-2">PREVIEW COVER</div>
          <label class="cover-drop" for="coverInput" style="cursor:pointer;">
            <div class="plus"><i class="bi bi-plus-lg"></i></div>
            <span>Tambah Cover</span>
          </label>
          <input type="file" id="coverInput" name="cover" accept="image/*" class="d-none">

          <div class="d-flex align-items-center gap-2">
            <span class="badge-status available">Tersedia</span>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label-soft">Judul Buku</label>
              <input type="text" name="judul" class="form-control form-control-soft" placeholder="Masukkan judul buku" required>
            </div>
            <div class="col-12">
              <label class="form-label-soft">Penulis</label>
              <input type="text" name="penulis" class="form-control form-control-soft" placeholder="Masukkan nama penulis" required>
            </div>
            <div class="col-md-6">
              <label class="form-label-soft">Penerbit</label>
              <input type="text" name="penerbit" class="form-control form-control-soft" placeholder="Masukkan nama penerbit">
            </div>
            <div class="col-md-6">
              <label class="form-label-soft">Tahun Terbit</label>
              <input type="number" name="tahun" class="form-control form-control-soft" placeholder="cth: 2025" min="1900" max="2100">
            </div>
            <div class="col-12">
              <label class="form-label-soft">Kategori</label>
              <select name="kategori" class="form-select form-control-soft">
                <option value="">Pilih Kategori</option>
                <option>Sains</option>
                <option>Matematika</option>
                <option>Informatika</option>
                <option>Biologi</option>
                <option>Kimia</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-soft d-block">Status Buku</label>
              <div class="status-radio">
                <label><input type="radio" name="status" value="Tersedia" checked> Tersedia</label>
                <label><input type="radio" name="status" value="Tidak Tersedia"> Tidak Tersedia</label>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="index.php" class="btn-batal">Batal</a>
            <button type="submit" class="btn-simpan">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </main>
</div>

<script>
document.getElementById('coverInput').addEventListener('change', function(e){
  const file = e.target.files[0];
  const drop = document.querySelector('.cover-drop');
  if(file){
    const url = URL.createObjectURL(file);
    drop.style.backgroundImage = `url(${url})`;
    drop.style.backgroundSize = 'cover';
    drop.style.backgroundPosition = 'center';
    drop.querySelector('.plus').style.display = 'none';
    drop.querySelector('span').textContent = '';
  }
});
</script>
</body>
</html>
