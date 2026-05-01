<?php
include "../api/database.php";

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// validasi sederhana
if ($password !== $confirm) {
  echo "Password tidak sama!";
  exit;
}

// hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// simpan ke database
$sql = "INSERT INTO users (nama, email, password) 
        VALUES ('$nama', '$email', '$hash')";

if ($conn->query($sql) === TRUE) {
  echo "Registrasi berhasil!";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
