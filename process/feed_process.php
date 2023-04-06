<?php 
session_start();
require('../connection.php');

// mendapatkan semua value
$content = $_POST['content'];

$email = $_SESSION['email'];
$sql = "SELECT id FROM user WHERE email = '$email'";
$resultUser = $conn->query($sql);
$userid = $resultUser->fetch_assoc()['id'];

//cek semua data terisi
if (empty($email) || empty($userid)) {
  $msg = "Eror, tidak boleh kosong";
  header("Location: ../feed.php?msg=" . $msg);
  return;
}

//save to database
$sql = "INSERT INTO status(user_id, content) VALUES('$userid', '$content')";

if ($conn->query($sql) === TRUE) {
    $msg = "status berhasil ditambahkan";
  } else {
    $msg = "status gagal";
  }
  
header("Location: ../feed.php?msg=" . $msg);
?>