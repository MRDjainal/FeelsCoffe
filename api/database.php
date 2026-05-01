<?php
$host_name = "localhost";
$user = "root";
$password = "";
$db = "feelscoffe";


$conn = mysqli_connect($host_name, $user, $password, $db);

if (!$conn) {
  die("koneksi gagal." . mysqli_connect_error());
}
