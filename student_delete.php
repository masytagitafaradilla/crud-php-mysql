<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    die();
}
include("connection.php");

if (isset($_GET["nim"])) {
    $nim = htmlentities(strip_tags(trim($_GET["nim"])));
    $nim = mysqli_real_escape_string($connection, $nim);

    $result = mysqli_query($connection, "DELETE FROM student WHERE nim='$nim'");
    if ($result && mysqli_affected_rows($connection) > 0) {
        $message = "Data mahasiswa dengan NIM = \"<b>$nim</b>\" sudah berhasil dihapus";
    } else {
        $message = "Data mahasiswa gagal dihapus atau tidak ditemukan";
    }
    mysqli_close($connection);
    header("Location: student_view.php?message=".urlencode($message));
    die();
}

mysqli_close($connection);
header("Location: student_view.php");
die();
?>
