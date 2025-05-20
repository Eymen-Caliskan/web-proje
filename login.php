<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı doğrudan bu dosyada
$baglanti = new mysqli("sql106.ezyro.com", "ezyro_39034853", "73be988", "ezyro_39034853_adsifre");

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

// Login işlemi
$email = $_POST['email'] ?? '';
$sifre = $_POST['sifre'] ?? '';

$sql = "SELECT sifre FROM kullanicilar WHERE email = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($hashliSifre);
$stmt->fetch();
$stmt->close();

if ($hashliSifre && password_verify($sifre, $hashliSifre)) {
    header("Location: anasayfa.html");
    exit();
} else {
    echo "Hatalı e-posta veya şifre.";
}

$baglanti->close();
?>
