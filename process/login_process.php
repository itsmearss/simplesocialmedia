<?php 
session_start();
require('../connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $msg = "Eror, tidak boleh kosong";
    header("Location: ../login.php?msg=" . $msg);
    return;
}

//cek email dan password
$sql = "SELECT email, password FROM user WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //menyimpan sesi
    $_SESSION['email'] = $email;
    $msg = "Login Berhasil";
    header('Location: ../feed.php?msg='.$msg);
} else {
    $msg = "Login gagal, pastikan email dan password sesuai";
    header('Location: ../login.php?msg='.$msg);
}
?>