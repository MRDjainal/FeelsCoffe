<?php
session_start();

include "../api/database.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();

  if (password_verify($password, $user['password'])) {

    // simpan ke session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];

    echo json_encode([
      "status" => "success",
      "message" => "Login berhasil"
    ]);
  } else {
    echo json_encode([
      "status" => "error",
      "message" => "Password salah"
    ]);
  }
} else {
  echo json_encode([
    "status" => "error",
    "message" => "Email tidak ditemukan"
  ]);
}
