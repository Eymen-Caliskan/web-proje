<?php
// Hata raporlama (geliştirme aşamasında faydalı)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantı bilgileri (bunları kendi bilgilerine göre güncelle!)
$host = "sql106.ezyro.com";         // ya da sana verilen MySQL host
$kullanici = "ezyro_39034853";    // veritabanı kullanıcı adın
$sifre = "73be988";        // veritabanı şifren
$veritabani = "ezyro_39034853_adsifre";  // veritabanı adı

// MySQL bağlantısı
$baglanti = new mysqli($host, $kullanici, $sifre, $veritabani);
if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

// Formdan gelen verileri al
$email = $_POST['email'] ?? '';
$sifre = $_POST['sifre'] ?? '';

// E-posta veya şifre boşsa hata ver
if (empty($email) || empty($sifre)) {
    die("Lütfen e-posta ve şifre alanlarını doldurun.");
}

// Şifreyi güvenli şekilde hash'le
$hashliSifre = password_hash($sifre, PASSWORD_DEFAULT);

// SQL sorgusunu hazırla ve çalıştır
$sql = "INSERT INTO kullanicilar (email, sifre) VALUES (?, ?)";
$stmt = $baglanti->prepare($sql);
if (!$stmt) {
    die("Sorgu hazırlanamadı: " . $baglanti->error);
}

$stmt->bind_param("ss", $email, $hashliSifre);

if ($stmt->execute()) {
    echo "Kayıt başarılı. <a href='index.html'>Giriş yapmak için tıklayın</a>";
} else {
    // Aynı e-posta zaten kayıtlıysa UNIQUE hatası verebilir
    echo "Kayıt başarısız: " . $stmt->error;
}

$stmt->close();
$baglanti->close();
?>
