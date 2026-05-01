<?php
include "../api/database.php";

header('Content-Type: application/json');
$query = "SELECT * FROM galery";
$result = mysqli_query($conn, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
  $data[] = [
    "image" => "image/galery/" . $row['galery_file'],
    "title" => $row['galery_title'],
    "cat"   => $row['galery_category'],
    "titlecategory" => $row['galery_title_category'],
    "desc"  => $row['galery_desc']
  ];
}

echo json_encode($data);
