<?php

include "database.php";

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$kategori = $_POST['kategori'];
$status = $_POST['status'];

$cover = "";

$query = "INSERT INTO buku (judul, penulis, penerbit, tahun, kategori, status, cover)
          VALUES ('$judul', '$penulis', '$penerbit', '$tahun', '$kategori', '$status', '$cover')";

mysqli_query($conn, $query);

header("Location: ../index.php");
