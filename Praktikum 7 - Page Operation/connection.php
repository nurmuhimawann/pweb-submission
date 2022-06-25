<?php

$db_host = "localhost";
$db_user = "202410101070";
$db_pass = "secret";

$conn = mysqli_connect($db_host, $db_user, $db_pass, "uas202410101070");

if (!$conn) {
  die("Koneksi Gagal: " . mysqli_connect_error());
}
