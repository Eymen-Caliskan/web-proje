<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = htmlspecialchars($_POST["ad"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $cinsiyet = htmlspecialchars($_POST["cinsiyet"]);
    $konu = htmlspecialchars($_POST["konu"]);
    $mesaj = htmlspecialchars($_POST["mesaj"]);

    echo "<!DOCTYPE html>";
    echo "<html lang='tr'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <title>Mesaj Alındı</title>";
    echo "    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
    echo "</head>";
    echo "<body class='bg-light'>";
    echo "    <div class='container mt-5'>";
    echo "        <div class='card shadow p-4'>";
    echo "            <h2 class='mb-4 text-success'>Mesajınız alınmıştır!</h2>";
    echo "            <p><strong>Ad Soyad:</strong> $ad</p>";
    echo "            <p><strong>E-posta:</strong> $email</p>";
    echo "            <p><strong>Telefon:</strong> $telefon</p>";
    echo "            <p><strong>Cinsiyet:</strong> $cinsiyet</p>";
    echo "            <p><strong>Konu:</strong> $konu</p>";
    echo "            <p><strong>Mesaj:</strong><br>" . nl2br($mesaj) . "</p>";
    echo "            <a href='anasayfa.html' class='btn btn-primary mt-3'>Geri Dön</a>";
    echo "        </div>";
    echo "    </div>";
    echo "</body>";
    echo "</html>";
} else {
    echo "Form verisi alınamadı.";
}
?>
