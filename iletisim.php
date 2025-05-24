<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <title>İletişim</title>
  <link rel="stylesheet" href="css/iletisim.css<?php echo '?v=' . filemtime('css/iletisim.css'); ?>">
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="anasayfa.php">Kişisel Web Sitem</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="anasayfa.html">Hakkımda</a></li>
          <li class="nav-item"><a class="nav-link" href="cv.html">Özgeçmiş</a></li>
          <li class="nav-item"><a class="nav-link" href="sehrim.html">Şehrim</a></li>
          <li class="nav-item"><a class="nav-link" href="ilgi.html">İlgi Alanlarım</a></li>
          <li class="nav-item"><a class="nav-link active" href="iletisim.php">İletişim</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="app" class="container">
    <div class="form-container">
      <h2 class="text-center">İletişim Formu</h2>
      <div v-if="Object.keys(errors).length > 0" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Lütfen aşağıdaki hataları düzeltin:</strong>
        <ul class="mb-0 mt-2">
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
        <button type="button" class="btn-close" @click="clearErrors" aria-label="Close"></button>
      </div>
      <form id="iletisimForm" @submit.prevent="vueKontrol" action="iletisim_post.php" method="post">
        <input type="text" class="form-control" :class="{ 'is-invalid': fieldErrors.ad }" id="ad" name="ad" v-model="formData.ad" placeholder="Ad Soyad">
        
        <input type="email" class="form-control" :class="{ 'is-invalid': fieldErrors.email }" id="email" name="email" v-model="formData.email" placeholder="E-posta">
        
        <input type="text" class="form-control" :class="{ 'is-invalid': fieldErrors.telefon }" id="telefon" name="telefon" v-model="formData.telefon" placeholder="Telefon (örn: 5551234567)">
        
        <div class="gender-group" :class="{ 'is-invalid': fieldErrors.cinsiyet }">
          <label>Cinsiyet:</label>
          <input type="radio" name="cinsiyet" value="Erkek" v-model="formData.cinsiyet" id="erkek">
          <label for="erkek">Erkek</label>
          <input type="radio" name="cinsiyet" value="Kadın" v-model="formData.cinsiyet" id="kadin">
          <label for="kadin">Kadın</label>
        </div>

        <select class="form-select" :class="{ 'is-invalid': fieldErrors.konu }" name="konu" v-model="formData.konu">
          <option value="">Konu Seçiniz</option>
          <option value="Genel">Genel</option>
          <option value="Öneri">Öneri</option>
          <option value="Şikayet">Şikayet</option>
        </select>

        <textarea class="form-control" :class="{ 'is-invalid': fieldErrors.mesaj }" id="mesaj" name="mesaj" rows="4" v-model="formData.mesaj" placeholder="Mesajınız..."></textarea>

        <button type="button" class="btn btn-primary" onclick="jsKontrol()">Kontrol Et</button>
        <button type="submit" class="btn btn-success">Gönder(Vue.js ile Kontrol Et)</button>
        <button type="button" class="btn btn-secondary" onclick="temizleForm()">Temizle</button>
      </form>
    </div>
  </div>

  <script src="js/iletisim.js<?php echo '?v=' . filemtime('js/iletisim.js'); ?>"></script>
  <script src="js/vue-form-kontrol.js<?php echo '?v=' . filemtime('js/vue-form-kontrol.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
