<?php
include "../api/database.php";
$data = null;
$id = $_POST['id'] ?? null;

if (!empty($id)) {
  $query = mysqli_query($conn, "SELECT * FROM menu WHERE id = '$id' ");
  $data = mysqli_fetch_assoc($query);
}
?>

<section class="modal modal-add-menu">
  <div class="modal-content">
    <span class="close" id="closeModal"><i data-feather="x"></i></span>
    <h2><?= $id ? 'Update' : 'Tambahkan' ?> Menu FeelsCoffe</h2>
    <form method="POST" id="menuForm" enctype="multipart/form-data">
      <input type="hidden" id="id" value="<?= $id ?? '' ?>">
      <input type="hidden" id="old_image" value="<?= $data['imagecoffee'] ?? '' ?>">
      <div class="form-group">
        <label for="nameCoffee">Nama Coffee:</label>
        <input type="text" id="nameCoffee" value="<?= $data['coffeename'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label for="category">Kategori:</label>
        <select id="category" name="category" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Hot Coffee" <?= ($data['category'] ?? '') == 'Hot Coffee' ? 'selected' : '' ?>>Hot Coffee </option>
          <option value="Ice Coffee" <?= ($data['category'] ?? '') == 'Ice Coffee' ? 'selected' : '' ?>>Ice Coffee</option>
          <option value="Non Coffee" <?= ($data['category'] ?? '') == 'Non Coffee' ? 'selected' : '' ?>>Non Coffee</option>
        </select>
      </div>
      <div class="form-group">
        <label for="descCoffee">Deskripsi Coffee:</label>
        <textarea id="descCoffee" rows="4" required><?= $data['desccoffee'] ?? '' ?></textarea>
      </div>
      <div class="form-group">
        <label for="strength">Kekuatan: </label>
        <input type="number" id="strength" min="10" max="100" step="1" value="<?= $data['strength'] ?? '' ?>" placeholder="%" required>
      </div>
      <div class="form-group">
        <label for="price">harga:</label>
        <input type="number" id="price" placeholder="IDR" value="<?= $data['price'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label for="visualcoffee">Unggulan Visual:</label>
        <input type="text" id="visualcoffee" value="<?= $data['visualcoffee'] ?? '' ?>" placeholder="smoot, bold, arts..." required>
      </div>
      <div class="form-group">
        <label for="imagecoffee">Gambar Coffee</label>
        <?php if (!empty($data['imagecoffee'])): ?>
          <img src="image/menu/<?= $data['imagecoffee'] ?>" width="100">
          <input type="file" id="imagecoffee" accept="image/*">
          <small>Abaikan jika tidak ingin mengganti gambar</small>
        <?php else: ?>
          <input type="file" id="imagecoffee" accept="image/*">
        <?php endif; ?>
      </div>

      <button type="button" class="btn-save-menu"><?= $id ? 'Update Menu' : 'Tambahkan Menu' ?></button>
    </form>
  </div>
</section>