<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantı bilgileri
$host = "sql106.ezyro.com";
$veritabani = "ezyro_39034853_adsifre";
$kullanici = "ezyro_39034853";
$sifre = "73be988";

// MySQL bağlantısı
$baglanti = new mysqli($host, $kullanici, $sifre, $veritabani);
if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

// Türkçe karakter desteği
$baglanti->set_charset("utf8");

// Formdan gelen verileri al
$email = $_POST['email'] ?? '';
$sifre = $_POST['sifre'] ?? '';

// E-posta veya şifre boşsa hata ver
if (empty($email) || empty($sifre)) {
    die("Lütfen e-posta ve şifre alanlarını doldurun.");
}

// E-posta formatını kontrol et
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Lütfen geçerli bir e-posta adresi giriniz (ornek@domain.com).");
}

// Şifreyi güvenli şekilde hash'le
$hashliSifre = password_hash($sifre, PASSWORD_DEFAULT);

// SQL sorgusunu hazırla ve çalıştır
$sql = "INSERT INTO kullanıcılar(email, sifre) VALUES(?, ?)";
$stmt = $baglanti->prepare($sql);
if (!$stmt) {
    die("Sorgu hazırlanamadı: " . $baglanti->error);
}

$stmt->bind_param("ss", $email, $hashliSifre);

try {
    if ($stmt->execute()) {
        echo '
        <link rel="stylesheet" href="css/kayit.css">
        <div class="success-message">
            <p>✅ Kayıt başarıyla tamamlandı!</p>
            <a href="index.html" class="success-link">Giriş Yap</a>
        </div>';
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // Duplicate entry error code
        echo '
        <link rel="stylesheet" href="css/kayit.css">
        <div class="success-message" style="background-color: #fff0f0; border-color: #dc3545;">
            <p>❌ Bu e-posta adresi zaten kayıtlı!</p>
            <p>Lütfen farklı bir e-posta adresi deneyin veya giriş yapın.</p>
            <div style="margin-top: 15px;">
                <a href="javascript:history.back()" class="success-link" style="background-color: #dc3545; margin-right: 10px;">Geri Dön</a>
                <a href="index.html" class="success-link" style="background-color: #0d6efd;">Giriş Yap</a>
            </div>
        </div>';
    } else {
        echo '
        <link rel="stylesheet" href="css/kayit.css">
        <div class="success-message" style="background-color: #fff0f0; border-color: #dc3545;">
            <p>❌ Kayıt işlemi sırasında bir hata oluştu.</p>
            <a href="javascript:history.back()" class="success-link" style="background-color: #dc3545;">Geri Dön</a>
        </div>';
    }
}

$stmt->close();
$baglanti->close();
?>
