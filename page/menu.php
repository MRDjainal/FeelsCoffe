<?php
session_start();
include "../api/database.php";

// menu data
$query = "SELECT * FROM menu";
$result = mysqli_query($conn, $query);

// user role
$id = $_SESSION['user_id'] ?? "";
$queryuser = "SELECT * FROM users WHERE id='$id'";
$resultuser = mysqli_query($conn, $queryuser);
$user = mysqli_fetch_assoc($resultuser);
$role = $user["status"] ?? "";
?>

<section class="hero-page">
  <div class="hero-bg"></div>
  <div class="hero-line"></div>
  <div class="hero-bg-letter">F</div>

  <div class="hero-content">
    <div class="hero-tag"><span>Menu Kami</span></div>
    <h1 class="hero-title">
      FeelsCoffee<br>
      <em>Menu.</em>
    </h1>
    <p class="hero-desc">
      FeelsCoffee mempunyai beberbagai banyak menu yang di sediakan untuk pelanggan yang pecinta coffe.
    </p>
    <a href="#story" class="hero-cta">
      <span>Kenali Kami</span>
      <span>→</span>
    </a>
  </div>

  <div class="scroll-indicator">
    <p>Scroll</p>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- Menu Section Start -->
<section id="menu" class="menu">
  <!-- Featured -->
  <div class="featured-banner">
    <div>
      <p class="featured-label">☕ Pilihan Bulan Ini</p>
      <h2 class="featured-title">Dark Velvet<em>Espresso Tonic</em></h2>
      <p class="featured-desc">
        Perpaduan espresso single origin Ethiopia Yirgacheffe dengan tonic water premium dan siraman jeruk yuzu segar. Dingin, bold, dan tak terlupakan.
      </p>
      <div class="featured-price">Rp 52.000</div>
    </div>
    <div class="featured-visual">☕</div>
  </div>

  <!-- Header -->
  <div class="section-header">
    <span class="section-label">— Our Menu —</span>
    <h2 class="section-title">Pilih <em>Favoritmu</em></h2>
  </div>

  <!-- Tabs -->
  <div class="tabs">
    <button class="tab active" data-cat="all">Semua</button>
    <button class="tab" data-cat="Hot Coffee">Hot Coffee</button>
    <button class="tab" data-cat="Ice Coffee">Ice Coffee</button>
    <button class="tab" data-cat="Non Coffee">Non Coffee</button>
  </div>
  <?php if ($role === "ADMIN"): ?>
    <div class="add-menu-section">
      <a href="#" class="add-menu-btn">Tambah Menu</a>
    </div>
  <?php endif; ?>

  <!-- Grid -->
  <div class="menu-grid" id="menuGrid">
    <!-- Menu card -->
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="menu-card visible" data-cat="<?= $row["category"]; ?>" data-id="<?= $row["id"]; ?>">
        <?php if ($role === 'ADMIN'): ?>
          <div class="menu-card-crud">
            <a href="#" class="edit" data-id="<?= $row["id"]; ?>"><i data-feather="edit"></i> <span>Edit</span></a>
            <a href="#" class="delete" data-id="<?= $row["id"]; ?>"><i data-feather="trash"></i> <span>hapus</span></a>
          </div>
        <?php endif; ?>
        <div class="card-corner-section"></div>
        <div class="card-corner"></div>
        <p class="card-category"><?= $row["category"]; ?></p>
        <div class="image-menu">
          <img src="image/menu/<?= $row["imagecoffee"]; ?>" class="preview-image" alt="FeelsCoffe">
        </div>
        <h3 class="card-name"><?= $row["coffeename"]; ?></h3>
        <p class="card-desc"><?= $row["desccoffee"]; ?></p>
        <div class="strength">
          <span class="strength-label">Kekuatan</span>
          <div class="strength-bar">
            <div class="strength-fill" style="width:<?= $row["strength"]; ?>%"></div>
          </div>
        </div>
        <div class="card-footer" style="margin-top:1.2rem">
          <div class="card-price">Rp <?= number_format($row["price"]); ?> </div>
          <div class="card-badge"><?= $row["visualcoffee"]; ?></div>
        </div>
      </div>
    <?php endwhile; ?>

  </div><!-- /menu-grid -->

</section>

<!-- Menu Section End -->

<div id="imagePreviewModal" class="image-preview-modal">
  <span class="close-preview">&times;</span>
  <img class="preview-content" id="previewImg">
</div>