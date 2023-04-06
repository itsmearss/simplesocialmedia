<?php 
require('../connection.php');

// mendapatkan semua value
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

//cek semua data terisi
if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
  $msg = "Eror, tidak boleh kosong";
  header("Location: ../register.php?msg=" . $msg);
  return;
}

//cek confirm password
if ($password !== $confirmPassword) {
  $msg = "Password tidak sama";
  header("Location: ../register.php?msg=" . $msg);
  return;
}

//save to database
$sql = "INSERT INTO user(username, email, password) VALUES('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    $msg = "registrasi berhasil";
  } else {
    $msg = "registrasi gagal";
  }
  
header("Location: ../login.php?msg=" . $msg);
?>