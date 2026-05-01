<?php
session_start();
include "../api/database.php";
$id = $_SESSION['user_id'] ?? "";
$query = "SELECT * FROM galery";
$result = mysqli_query($conn, $query);

$total = mysqli_num_rows($result);

$queryuser = "SELECT * FROM users WHERE id='$id'";
$resultuser = mysqli_query($conn, $queryuser);

$user = mysqli_fetch_assoc($resultuser);

$role = $user["status"] ?? "";
?>
<style>
  /* Count row */
  .hero-stats {
    display: flex;
    gap: 2.5rem;
    opacity: 0;
    animation: slideUp 1s 0.9s forwards;
  }

  .hero-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--gold-light);
    display: block;
    line-height: 1;
  }

  .hero-stat-lbl {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.25em;
    font-size: 0.65rem;
    color: var(--text-soft);
    margin-top: 0.3rem;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* ── FILTER STRIP ── */
  .filter-strip {
    position: sticky;
    top: 0;
    z-index: 400;
    background: rgba(17, 9, 0, 0.96);
    border-bottom: 1px solid rgba(194, 132, 58, 0.1);
    backdrop-filter: blur(16px);
    padding: 1rem 3.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
  }

  .filter-tabs {
    display: flex;
    gap: 0.4rem;
    flex-wrap: wrap;
  }

  .ftab {
    background: none;
    border: 1px solid rgba(194, 132, 58, 0.15);
    color: var(--text-soft);
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.28em;
    font-size: 0.72rem;
    padding: 0.5rem 1.3rem;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
  }

  .ftab::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s;
    z-index: -1;
  }

  .ftab.active,
  .ftab:hover {
    color: var(--espresso);
    border-color: var(--gold);
  }

  .ftab.active::before,
  .ftab:hover::before {
    transform: scaleX(1);
  }

  .view-btns {
    display: flex;
    gap: 0.4rem;
  }

  .view-btn {
    background: none;
    border: 1px solid rgba(194, 132, 58, 0.15);
    color: var(--text-soft);
    width: 34px;
    height: 34px;
    cursor: pointer;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }

  .view-btn.active,
  .view-btn:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  /* ── GALLERY ── */
  .gallery-section {
    padding: 4rem 3.5rem 7rem;
    max-width: 1500px;
    margin: 0 auto;
  }

  /* MASONRY GRID */
  .masonry-grid {
    columns: 4;
    column-gap: 4px;
  }

  .masonry-grid.cols-2 {
    columns: 2;
  }

  .masonry-grid.cols-3 {
    columns: 3;
  }

  .image-galery,
  .lightbox .img-feelscoffee {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* GRID VIEW */
  .grid-view {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 4px;
  }

  .grid-view.cols-2 {
    grid-template-columns: repeat(2, 1fr);
  }

  .grid-view.cols-3 {
    grid-template-columns: repeat(3, 1fr);
  }

  .grid-view .gallery-item {
    break-inside: unset;
    margin-bottom: 0;
  }

  .grid-view .photo-frame {
    aspect-ratio: 1 !important;
  }

  /* GALLERY ITEM */
  .gallery-item {
    break-inside: avoid;
    margin-bottom: 4px;
    position: relative;
    cursor: pointer;
  }

  .gallery-item.hidden {
    display: none;
  }

  .photo-frame {
    width: 100%;
    background: var(--dark-roast);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    transition: transform 0.4s;
  }

  /* Different heights for masonry feel */
  .gallery-item:nth-child(3n+1) .photo-frame {
    aspect-ratio: 3/4;
  }

  .gallery-item:nth-child(3n+2) .photo-frame {
    aspect-ratio: 4/5;
  }

  .gallery-item:nth-child(3n) .photo-frame {
    aspect-ratio: 1;
  }

  .gallery-item:nth-child(5) .photo-frame {
    aspect-ratio: 16/9;
  }

  .gallery-item:nth-child(9) .photo-frame {
    aspect-ratio: 2/1;
  }

  .gallery-item:nth-child(13) .photo-frame {
    aspect-ratio: 16/9;
  }

  /* background gradient per item */
  .photo-frame::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--bg-grad, linear-gradient(145deg, #2a1500, #110900));
    z-index: 0;
  }

  .photo-emoji {
    font-size: clamp(3.5rem, 8vw, 6rem);
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 15px 40px rgba(194, 132, 58, 0.3));
    transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    user-select: none;
  }

  .gallery-item:hover .photo-emoji {
    transform: scale(1.15) translateY(-4px);
  }

  /* HOVER OVERLAY */
  .photo-overlay {
    position: absolute;
    inset: 0;
    z-index: 2;
    background: linear-gradient(to top, rgba(17, 9, 0, 0.92) 0%, rgba(17, 9, 0, 0.1) 50%, transparent 100%);
    opacity: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.5rem;
    transition: opacity 0.4s;
  }

  .gallery-item:hover .photo-overlay {
    opacity: 1;
  }

  .photo-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--cream);
    line-height: 1.2;
    margin-bottom: 0.3rem;
  }

  .photo-cat {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.3em;
    font-size: 0.62rem;
    color: var(--gold);
  }

  .photo-expand {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 32px;
    height: 32px;
    border: 1px solid rgba(194, 132, 58, 0.5);
    background: rgba(17, 9, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 0.8rem;
    opacity: 0;
    transition: opacity 0.3s, transform 0.3s;
    transform: scale(0.8);
  }

  .gallery-item:hover .photo-expand {
    opacity: 1;
    transform: scale(1);
  }

  /* LIKE BTN */
  .photo-like {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    z-index: 3;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.1rem;
    transition: transform 0.3s;
    color: var(--text-soft);
  }

  .photo-like.liked {
    color: #e87a5a;
  }

  .photo-like:hover {
    transform: scale(1.3);
  }

  /* TALL/WIDE labels */
  .photo-badge {
    position: absolute;
    top: 0.8rem;
    left: 0.8rem;
    z-index: 3;
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.2em;
    font-size: 0.58rem;
    padding: 0.25rem 0.65rem;
  }

  .pb-featured {
    background: var(--gold);
    color: var(--espresso);
  }

  .pb-new {
    background: rgba(194, 132, 58, 0.15);
    border: 1px solid rgba(194, 132, 58, 0.4);
    color: var(--gold);
  }

  .pb-series {
    background: rgba(120, 60, 20, 0.3);
    border: 1px solid rgba(150, 80, 30, 0.4);
    color: var(--latte);
  }

  /* ── LIGHTBOX ── */
  .lightbox {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(10, 5, 0, 0.97);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s;
  }

  .lightbox.open {
    opacity: 1;
    pointer-events: all;
  }

  .lb-inner {
    max-width: 800px;
    width: 90%;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
  }

  .lb-frame {
    width: 100%;
    aspect-ratio: 4/3;
    background: var(--dark-roast);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(194, 132, 58, 0.15);
    transform: scale(0.9);
    transition: transform 0.4s cubic-bezier(0.34, 1.3, 0.64, 1);
  }

  .lightbox.open .lb-frame {
    transform: scale(1);
  }

  .lb-frame::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--bg-grad, linear-gradient(145deg, #2a1500, #110900));
  }

  .lb-emoji {
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 30px 60px rgba(194, 132, 58, 0.35));
  }

  .lb-info {
    width: 100%;
    padding: 1.5rem 0;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
  }

  .lb-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--cream);
  }

  .lb-meta {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.3em;
    font-size: 0.65rem;
    color: var(--gold);
    margin-top: 0.3rem;
  }

  .lb-desc {
    font-size: 0.92rem;
    font-weight: 300;
    color: var(--text-soft);
    line-height: 1.8;
    margin-top: 0.4rem;
    max-width: 60%;
  }

  .lb-close {
    position: absolute;
    top: -3rem;
    right: 0;
    background: none;
    border: 1px solid rgba(194, 132, 58, 0.3);
    color: var(--text-soft);
    width: 40px;
    height: 40px;
    cursor: pointer;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }

  .lb-close:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  .lb-nav {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(28, 15, 0, 0.8);
    border: 1px solid rgba(194, 132, 58, 0.2);
    color: var(--text-soft);
    width: 50px;
    height: 50px;
    cursor: pointer;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 1;
  }

  .lb-nav:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(54, 32, 0, 0.9);
  }

  .lb-prev {
    left: 1.5rem;
  }

  .lb-next {
    right: 1.5rem;
  }

  /* LB COUNTER */
  .lb-counter {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 0.3em;
    font-size: 0.75rem;
    color: var(--text-soft);
    margin-top: 0.5rem;
  }

  .lb-counter em {
    color: var(--gold);
    font-style: normal;
  }
</style>


<section class="hero-page">
  <div class="hero-bg"></div>
  <div class="hero-line"></div>
  <div class="hero-bg-letter">F</div>

  <div class="hero-content">
    <div class="hero-tag"><span>Galeri Kami</span></div>
    <h1 class="hero-title">
      FeelsCoffe<br>
      <em>Galeri.</em>
    </h1>
    <p class="hero-desc">
      Galeri feelscoffe dengan berbagai dokomentasi pembuatan coffe sampai penyajian coffe dengan berbagai macam pelanggan.
    </p>

    <div class="hero-stats">
      <div>
        <span class="hero-stat-num" id="statPhotos"><?= $total; ?></span>
        <div class="hero-stat-lbl">Foto</div>
      </div>
      <!-- <div>
        <span class="hero-stat-num" id="statLikes">0</span>
        <div class="hero-stat-lbl">Disukai</div>
      </div> -->
      <div>
        <span class="hero-stat-num">3</span>
        <div class="hero-stat-lbl">Kategori</div>
      </div>
    </div>
  </div>

  <div class="scroll-indicator">
    <p>Scroll</p>
    <div class="scroll-line"></div>
  </div>

</section>

<!-- FILTER STRIP -->
<div class="filter-strip">
  <div class="filter-tabs">
    <button class="ftab active" data-cat="all">Semua</button>
    <button class="ftab" data-cat="Kopi">Kopi</button>
    <button class="ftab" data-cat="Suasana">Suasana</button>
    <button class="ftab" data-cat="Proses">Proses</button>
  </div>
  <div class="view-btns">
    <button class="view-btn active" data-mode="masonry" title="Masonry">⊞</button>
    <button class="view-btn" data-mode="grid" title="Grid">⊟</button>
  </div>
</div>

<?php if ($role === "ADMIN"): ?>
  <div class="galery-section-add">
    <a href="#" class="btn-add-galery">Tambah Galery</a>
  </div>
<?php endif; ?>
<!-- GALLERY -->
<section class="gallery-section">
  <div class="masonry-grid" id="galleryGrid">

    <?php $no = 0; ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="gallery-item reveal"
        data-cat="<?= $row['galery_category']; ?>" data-id="<?= $row['id']; ?>">
        <?php if ($role === 'ADMIN'): ?>
          <a href="#" class="edit" data-id="<?= $row["id"]; ?>"><i data-feather="edit"></i> <span>Edit</span></a>
          <a href="#" class="delete" data-id="<?= $row["id"]; ?>"><i data-feather="trash"></i> <span>hapus</span></a>
        <?php endif; ?>
        <div class="open-lb photo-frame" data-idx="<?= $no; ?>">
          <img src="image/galery/<?= $row['galery_file'] ?>" class="image-galery">
          <div class="photo-overlay">
            <div class="photo-title"><?= $row['galery_title'] ?></div>
            <div class="photo-cat">
              <?= $row['galery_category']; ?> · <?= $row['galery_title_category']; ?>
            </div>
            <div class="open-lb photo-expand">⤢</div>
          </div>
          <div class="descimage" style="display:none;">
            <?= $row['galery_desc'] ?>
          </div>
        </div>
      </div>
      <?php $no++; ?>
    <?php endwhile; ?>

  </div><!-- /gallery -->
</section>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
  <button class="lb-nav lb-prev" data-lbnav="-1">←</button>
  <button class="lb-nav lb-next" data-lbnav="1">→</button>
  <div class="lb-inner">
    <button class="lb-close">✕</button>
    <div class="lb-frame" id="lbFrame">
      <img src="" alt="imagephotos" class="img-feelscoffee">
    </div>
    <div class="lb-counter"><em id="lbCurr">1</em> / <em id="lbTotal">20</em></div>
    <div class="lb-info">
      <div>
        <div class="lb-title" id="lbTitle"></div>
        <div class="lb-meta" id="lbMeta"></div>
        <div class="lb-desc" id="lbDesc"></div>
      </div>
      <!-- <button class="photo-like" id="lbLike" onclick="toggleLbLike()" style="position:static;font-size:1.4rem">🤍</button> -->
    </div>
  </div>
</div>