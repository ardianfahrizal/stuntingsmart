<?php
include './koneksi.php';
session_start();
if ($_SESSION['status'] != "login") {
  header("location:./login.php");
  exit;
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
  mysqli_query($koneksi, "DELETE FROM tb_diagnosis WHERE id=$id");
}
header("location:./data_diagnosis.php");
exit;
