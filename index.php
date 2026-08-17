<?php
$pageTitle = 'Daftar Buku';
$active = 'daftar';

require_once __DIR__ . '/service/database.php';

$query = "SELECT * FROM buku ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$bukuList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bukuList[] = $row;
}
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
        <h3 class="page-title mb-0">Daftar Buku</h3>
        <div class="page-subtitle mb-0">Kelola data seluruh buku perpustakaan.</div>
      </div>
      <a href="tambah.php" class="btn-tambah"><i class="bi bi-plus-lg me-1"></i> Tambah Buku</a>
    </div>

    <div class="card-soft">
      <div class="table-toolbar align-items-center">
        <div class="search-pill" style="max-width:260px;">
          <i class="bi bi-search"></i>
          <input type="text" placeholder="Cari berdasarkan judul buku...">
        </div>
        <select><option>Semua Kategori</option></select>
        <select><option>Semua Tahun</option></select>
        <select><option>Semua Status</option></select>
        <select><option>Judul A-Z</option></select>
      </div>

      <div class="table-responsive">
        <table class="table-books">
          <thead>
            <tr>
              <th>No.</th>
              <th>Cover</th>
              <th>Judul Buku</th>
              <th>Penulis</th>
              <th>Kategori</th>
              <th>Tahun</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($bukuList)): ?>
              <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data buku.</td></tr>
            <?php endif; ?>
            <?php foreach ($bukuList as $i => $buku): ?>
              <?php
                $coverSrc = $buku['cover']
                  ? 'uploads/' . htmlspecialchars($buku['cover'])
                  : 'https://placehold.co/80x100?text=No+Cover';
              ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><img src="<?= $coverSrc ?>" alt="" style="width:34px;height:44px;object-fit:cover;border-radius:4px;"></td>
                <td class="fw-semibold"><?= htmlspecialchars($buku['judul']) ?></td>
                <td><?= htmlspecialchars($buku['penulis']) ?></td>
                <td><?= htmlspecialchars($buku['kategori'] ?? '-') ?></td>
                <td><?= htmlspecialchars($buku['tahun'] ?? '-') ?></td>
                <td>
                  <?php if ($buku['status'] === 'Tersedia'): ?>
                    <span class="badge-status available">Tersedia</span>
                  <?php else: ?>
                    <span class="badge-status unavailable">Tidak Tersedia</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="edit.php?id=<?= $buku['id'] ?>" class="action-icon edit" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                  <button type="button" class="action-icon delete" title="Hapus" data-bs-toggle="modal" data-bs-target="#modalHapus" data-id="<?= $buku['id'] ?>" data-judul="<?= htmlspecialchars($buku['judul']) ?>"><i class="bi bi-trash-fill"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:16px; border:none;">
      <div class="modal-body text-center p-4">
        <div class="mb-3" style="font-size:2.5rem; color:var(--accent-red);"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <h5 class="fw-bold mb-2">Hapus Buku Ini?</h5>
        <p class="text-muted mb-4">Buku "<span id="hapusJudul"></span>" akan dihapus dari daftar. Tindakan ini tidak bisa dibatalkan.</p>
        <form action="service/hapus.php" method="POST" class="d-flex justify-content-center gap-2">
          <input type="hidden" name="id" id="hapusId">
          <button type="button" class="btn-tambah" style="background:#E6E9F5; color:var(--text-dark);" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-tambah" style="background:var(--accent-red);">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('modalHapus').addEventListener('show.bs.modal', function (e) {
  const btn = e.relatedTarget;
  document.getElementById('hapusId').value = btn.getAttribute('data-id');
  document.getElementById('hapusJudul').textContent = btn.getAttribute('data-judul');
});
</script>
</body>
</html>
