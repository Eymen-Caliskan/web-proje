function jsKontrol() {
  const ad = document.getElementById("ad").value.trim();
  const email = document.getElementById("email").value.trim();
  const tel = document.getElementById("telefon").value.trim();
  const mesaj = document.getElementById("mesaj").value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const telRegex = /^[0-9]{10,15}$/;

  if (ad === "" || email === "" || tel === "" || mesaj === "") {
    alert("Tüm alanlar doldurulmalıdır.");
    return false;
  }

  if (!emailRegex.test(email)) {
    alert("Geçerli bir e-posta giriniz.");
    return false;
  }

  if (!telRegex.test(tel)) {
    alert("Geçerli bir telefon numarası giriniz (sadece rakam, 10-15 hane).");
    return false;
  }

  alert("JS ile doğrulama başarılı!");
  return true;
}

function temizleForm() {
  document.getElementById("iletisimForm").reset();
}
