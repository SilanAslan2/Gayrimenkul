<?php
$host = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "emlak"; // senin mevcut veritabanı

$baglan = mysqli_connect($host, $kullanici, $sifre, $veritabani);

if (!$baglan) {
    die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}
?>
