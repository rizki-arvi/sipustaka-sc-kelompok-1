<?php

$conn = mysqli_connect("localhost", "root", "", "sipustaka");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
