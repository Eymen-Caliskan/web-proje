<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$baglanti = new mysqli("sql106.ezyro.com", "ezyro_39034853", "73be988", "ezyro_39034853_adsifre");

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

$baglanti->set_charset("utf8");

// Login işlemi
$email = $_POST['email'] ?? '';
$sifre = $_POST['sifre'] ?? '';

$sql = "SELECT sifre FROM kullanıcılar WHERE email = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($hashliSifre);
$stmt->fetch();
$stmt->close();

if ($hashliSifre && password_verify($sifre, $hashliSifre)) {
    echo '
    <link rel="stylesheet" href="css/login.css">
    <div class="success-message">
        <p>✅ Giriş başarılı! Yönlendiriliyorsunuz...</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "anasayfa.html";
        }, 2000);
    </script>';
} else {
    echo '
    <link rel="stylesheet" href="css/login.css">
    <div class="success-message" style="background-color: #fff0f0; border-color: #dc3545;">
        <p>❌ Hatalı e-posta veya şifre.</p>
        <a href="javascript:history.back()" class="success-link" style="background-color: #dc3545;">Geri Dön</a>
    </div>';
}

$baglanti->close();
?>
