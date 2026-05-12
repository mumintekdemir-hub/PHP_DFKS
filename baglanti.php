<?php
$conn = new mysqli("localhost", "root", "", "fiyat_karsilastirma");

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>