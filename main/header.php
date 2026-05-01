<?php
session_start();
include "api/database.php";
$id = $_SESSION["user_id"] ?? "";

function getInitial($name)
{
  $words = explode(" ", trim($name));
  $initial = strtoupper(substr($words[0], 0, 1));
  if (count($words) > 1) {
    $initial .= strtoupper(substr($words[1], 0, 1));
  }
  return $initial;
}




?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feels Coffe</title>

  <link rel="stylesheet" href="api/style.css" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;500&family=Bebas+Neue&display=swap" rel="stylesheet" />

  <!-- Feather icons -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>


  <!-- Navbar Start -->
  <nav class="navbar">
    <a href="#" class="img"><img src="image/1.png" alt="logo"></a>
    <div class="navbar-nav">
      <a href="index.php">Home</a>
      <a href="#" class="nav-link" data-page="page/about.php">Tentang Kami</a>
      <a href="#" class="nav-link" data-page="page/menu.php">Menu</a>
      <!-- <a href="#" class="nav-link" data-page="page/product.php">Prodak</a> -->
      <a href="#" class="nav-link" data-page="page/galery.php">Galeri</a>
      <a href="#" class="nav-link" data-page="page/contact.php">Kontak</a>
    </div>

    <div class="navbar-extra">
      <!-- <a href="#" id="search"><i data-feather="search"></i></a> -->
      <a href="#" id="humburger-menu"><i data-feather="menu"></i></a>
      <?php if (!empty($id)): ?>
        <div class="user-wrapper">
          <a href="#" id="user-icon" class="user-box">
            <?= getInitial($_SESSION['nama']); ?>
          </a>

          <div class="user-dropdown">
            <a href="profile.php">👤 Profil</a>
            <a href="#" id="logoutBtn">🚪 Logout</a>
          </div>
        </div>
      <?php else: ?>
        <a href="#" id="user-icon" class="user-login"><i data-feather="user"></i></a>
      <?php endif; ?>
    </div>
  </nav>
  <!-- Navbar End -->