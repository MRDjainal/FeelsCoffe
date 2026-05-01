<?php
include "../api/database.php";

if (isset($_POST['role'])) {

  $role = $_POST['role'];

  // TAMBAH MENU
  if ($role == "tambah_menu") {

    $nama = strtolower(trim($_POST['namecoffee']));
    $kategori = $_POST['category'];
    $deskripsi = $_POST['desccoffee'];
    $strength = $_POST['strength'];
    $price = $_POST['price'];
    $visualcoffee = $_POST['visualcoffee'];

    $cek = mysqli_query($conn, "SELECT * FROM menu WHERE LOWER(coffeename) = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
      echo "error | Nama coffee sudah ada";
      exit;
    }

    // upload gambar menu
    $file_name = time() . "_" . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../image/menu/";
    move_uploaded_file($tmp, $folder . $file_name);

    $query = "INSERT INTO menu (coffeename, category, desccoffee, strength, price, visualcoffee, imagecoffee) 
                  VALUES ('$nama', '$kategori', '$deskripsi', '$strength', '$price', '$visualcoffee', '$file_name')";

    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error: " . mysqli_error($conn);
    }
  }

  // HAPUS MENU
  if ($role == "hapus_menu") {

    $id = $_POST['id'];

    $query = "DELETE FROM menu WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error" . mysqli_error($conn);
    }
  }

  // EDIT MENU
  if ($role == "edit_menu") {

    $id = $_POST['id'];
    $nama = $_POST['namecoffee'];
    $kategori = $_POST['category'];
    $deskripsi = $_POST['desccoffee'];
    $strength = $_POST['strength'];
    $price = $_POST['price'];
    $visual = $_POST['visualcoffee'];
    $old_image = $_POST['old_image'];

    // HANDLE IMAGE MENU
    if (!empty($_FILES['image']['name'])) {

      $file_name = time() . "_" . $_FILES['image']['name'];
      $tmp = $_FILES['image']['tmp_name'];
      $folder = "../image/menu/";

      move_uploaded_file($tmp, $folder . $file_name);

      // hapus lama
      if ($old_image && file_exists($folder . $old_image)) {
        unlink($folder . $old_image);
      }
    } else {
      $file_name = $old_image;
    }

    // UPDATE DATA
    $query = "UPDATE menu SET 
                coffeename='$nama',
                category='$kategori',
                desccoffee='$deskripsi',
                strength='$strength',
                price='$price',
                visualcoffee='$visual',
                imagecoffee='$file_name'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error|" . mysqli_error($conn);
    }
  }

  if ($role == "tambah_gallery") {


    $title = strtolower(trim($_POST["titleimage"]));
    $category = $_POST["categoryimage"];
    $descimage = $_POST["descimage"];
    $titlecategory = $_POST["titlecategory"];

    $cektitle = mysqli_query($conn, "SELECT * FROM galery WHERE LOWER(galery_title) = '$title'");
    if (mysqli_num_rows($cektitle) > 0) {
      echo "error | Title udah ada kawan";
      exit;
    }

    // mengupload Gambar Galery
    $file_name = time() . "_" . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../image/galery/";
    move_uploaded_file($tmp, $folder . $file_name);


    $query = "INSERT INTO galery (galery_title, galery_category, galery_title_category, galery_desc, galery_file) 
                          VALUES ('$title', '$category', '$titlecategory', '$descimage', '$file_name')";
    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error: " . mysqli_error($conn);
    }
  }

  if ($role == "edit_gallery") {
    $id = $_POST['id'];
    $title = strtolower(trim($_POST["titleimage"]));
    $category = $_POST["categoryimage"];
    $descimage = $_POST["descimage"];
    $titlecategory = $_POST["titlecategory"];
    $old_image = $_POST["old_image"];



    // HEANDLE IMAGE GALLERY
    if (!empty($_FILES['image']['name'])) {
      $file_name = time() . "_" . $_FILES['image']['name'];
      $tmp = $_FILES['image']['tmp_name'];
      $folder = "../image/galery/";

      move_uploaded_file($tmp, $folder . $file_name);

      // hapus yang lama
      if ($old_image && file_exists($folder . $old_image)) {
        unlink($folder . $old_image);
      } else {
        echo "upload gagal";
        exit;
      }
    } else {
      $file_name = $old_image;
    }

    $query = "UPDATE galery SET 
                  galery_title='$title',
                  galery_category='$category',
                  galery_desc='$descimage',
                  galery_title_category='$titlecategory',
                  galery_file='$file_name'
                  WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error" . mysqli_error($conn);
    }
  }

  if ($role == "delete_gallery") {
    $id = $_POST['id'];

    $query = "DELETE FROM galery WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
      echo "success";
    } else {
      echo "error" . mysqli_error($conn);
    }
  }
}
