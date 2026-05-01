<?php
include "../api/database.php";
$data = null;

$id = $_POST['id'] ?? null;

if (!empty($id)) {
  $query = mysqli_query($conn, "SELECT * FROM galery WHERE id = '$id' ");
  $data = mysqli_fetch_assoc($query);
}
?>


<section class="modal modal-add-galery">
  <div class="modal-content">
    <span class="close" id="closeModal"><i data-feather="x"></i></span>
    <h2><?= $id ? 'Update' : 'Tambahkan' ?> Galery FeelsCoffe</h2>
    <form method="POST" id="galeryForm" enctype="multipart/form-data">
      <input type="hidden" id="id" value="<?= $id ?? '' ?>">
      <input type="hidden" id="old_image" value="<?= $data["galery_file"] ?? '' ?>">
      <div class="form-group">
        <label for="titleImage">Title Gambar</label>
        <input type="text" id="titleImage" value="<?= $data['galery_title'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label for="categoryImage">Kategori Gambar:</label>
        <select id="categoryImage" name="categoryImage" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Kopi" <?= ($data['galery_category'] ?? '') == 'Kopi' ? 'selected' : '' ?>>Kopi</option>
          <option value="Suasana" <?= ($data['galery_category'] ?? '') == 'Suasana' ? 'selected' : '' ?>>Suasana</option>
          <option value="Proses" <?= ($data['galery_category'] ?? '') == 'Proses' ? 'selected' : '' ?>>Proses</option>
        </select>
      </div>
      <div class="form-group">
        <label for="titleImagekategori">Title Kategori</label>
        <input type="text" id="titleImagekategory" value="<?= $data['galery_title_category'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label for="descImage">Deskripsi Gambar:</label>
        <textarea id="descImage" rows="4" required><?= $data['galery_desc'] ?? '' ?></textarea>
      </div>
      <div class="form-group">
        <label for="imageCoffee">Gambar</label>
        <?php if (!empty($data['galery_file'])): ?>
          <img src="image/galery/<?= $data['galery_file'] ?>" alt="galleryFeelsCoffee" width="100">
          <input type="file" id="imageCoffee" name="imageCoffee" accept="image/*">
          <small>Abaikan jika tidak ingin mengganti gambar</small>
        <?php else: ?>
          <input type="file" id="imageCoffee" name="imageCoffee" accept="image/*">
        <?php endif; ?>
      </div>

      <button type="button" class="btn-save-galery"><?= $id ? 'Update' : 'Tambah' ?> Gambar</button>
    </form>
  </div>
</section>