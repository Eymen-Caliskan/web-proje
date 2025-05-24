<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header('Content-Type: text/html; charset=utf-8');

// Form verilerini al
$ad = isset($_POST['ad']) ? trim($_POST['ad']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefon = isset($_POST['telefon']) ? trim($_POST['telefon']) : '';
$cinsiyet = isset($_POST['cinsiyet']) ? $_POST['cinsiyet'] : '';
$konu = isset($_POST['konu']) ? $_POST['konu'] : '';
$mesaj = isset($_POST['mesaj']) ? trim($_POST['mesaj']) : '';

// Hata mesajları için dizi
$errors = array();

// Validasyon
if (strlen($ad) < 3) {
    $errors[] = "Ad en az 3 karakter olmalıdır.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Geçerli bir e-posta adresi giriniz.";
}

if (!preg_match("/^[0-9]{10,11}$/", $telefon)) {
    $errors[] = "Geçerli bir telefon numarası giriniz (10-11 rakam).";
}

if (empty($cinsiyet)) {
    $errors[] = "Lütfen cinsiyet seçiniz.";
}

if (empty($konu)) {
    $errors[] = "Lütfen bir konu seçiniz.";
}

if (strlen($mesaj) < 10) {
    $errors[] = "Mesaj en az 10 karakter olmalıdır.";
}

// Hata varsa göster
if (!empty($errors)) {
    echo "<html><head><meta charset='utf-8'></head><body>";
    echo "<h2>Form Hataları:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "<br><a href='javascript:history.back()'>Geri Dön</a>";
    echo "</body></html>";
    exit;
}

// Başarılı mesajı
echo "<html>
<head>
    <meta charset='utf-8'>
    <title>Form Başarıyla Gönderildi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
            background: linear-gradient(135deg, #a8e6cf 0%, #3498db 100%);
            min-height: 100vh;
        }
        .success-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 40px auto;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class='success-container'>
        <h2>Form Başarıyla Gönderildi!</h2>
        <p>Mesajınız için teşekkür ederiz. En kısa sürede size dönüş yapılacaktır.</p>
        
        <div class='details'>
            <h3>Gönderilen Bilgiler:</h3>
            <p><strong>Ad Soyad:</strong> " . htmlspecialchars($ad) . "</p>
            <p><strong>E-posta:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Telefon:</strong> " . htmlspecialchars($telefon) . "</p>
            <p><strong>Cinsiyet:</strong> " . htmlspecialchars($cinsiyet) . "</p>
            <p><strong>Konu:</strong> " . htmlspecialchars($konu) . "</p>
            <p><strong>Mesaj:</strong> " . htmlspecialchars($mesaj) . "</p>
        </div>

        <a href='iletisim.php' class='back-button'>İletişim Sayfasına Dön</a>
    </div>
</body>
</html>";
?> 