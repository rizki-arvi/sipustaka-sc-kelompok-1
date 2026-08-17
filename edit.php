<?php
$pageTitle = 'Edit Buku';
$active = 'daftar';

require_once __DIR__ . '/service/database.php';

$id = $_GET['id'];
$query = "SELECT * FROM buku WHERE id='$id'";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

if (!$buku) {
    header('Location: index.php');
    exit;
}

$coverSrc = $buku['cover'] ? 'uploads/' . htmlspecialchars($buku['cover']) : '';
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
        <h3 class="page-title mb-0">Edit Buku</h3>
        <div class="page-subtitle mb-0">Perbarui data buku "<?= htmlspecialchars($buku['judul']) ?>".</div>
      </div>
      <img src="assets/img/logo.png" alt="SIPUSTAKA" class="topbar-logo-img">
    </div>

    <form action="service/update.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $buku['id'] ?>">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="text-muted small fw-semibold mb-2">PREVIEW COVER</div>
          <label class="cover-drop" for="coverInput" style="cursor:pointer; <?= $coverSrc ? "background-image:url('{$coverSrc}');background-size:cover;background-position:center;" : '' ?>">
            <div class="plus" style="<?= $coverSrc ? 'display:none;' : '' ?>"><i class="bi bi-plus-lg"></i></div>
            <span><?= $coverSrc ? '' : 'Ganti Cover' ?></span>
          </label>
          <input type="file" id="coverInput" name="cover" accept="image/*" class="d-none">
        </div>

        <div class="col-lg-8">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label-soft">Judul Buku</label>
              <input type="text" name="judul" class="form-control form-control-soft" value="<?= htmlspecialchars($buku['judul']) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label-soft">Penulis</label>
              <input type="text" name="penulis" class="form-control form-control-soft" value="<?= htmlspecialchars($buku['penulis']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label-soft">Penerbit</label>
              <input type="text" name="penerbit" class="form-control form-control-soft" value="<?= htmlspecialchars($buku['penerbit'] ?? '') ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label-soft">Tahun Terbit</label>
              <input type="number" name="tahun" class="form-control form-control-soft" value="<?= htmlspecialchars($buku['tahun'] ?? '') ?>" min="1900" max="2100">
            </div>
            <div class="col-12">
              <label class="form-label-soft">Kategori</label>
              <?php $kategoriOptions = ['Sains', 'Matematika', 'Informatika', 'Biologi', 'Kimia']; ?>
              <select name="kategori" class="form-select form-control-soft">
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategoriOptions as $opt): ?>
                  <option <?= $buku['kategori'] === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-soft d-block">Status Buku</label>
              <div class="status-radio">
                <label><input type="radio" name="status" value="Tersedia" <?= $buku['status'] === 'Tersedia' ? 'checked' : '' ?>> Tersedia</label>
                <label><input type="radio" name="status" value="Tidak Tersedia" <?= $buku['status'] === 'Tidak Tersedia' ? 'checked' : '' ?>> Tidak Tersedia</label>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="index.php" class="btn-batal">Batal</a>
            <button type="submit" class="btn-simpan">Simpan Perubahan</button>
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
