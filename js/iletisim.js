function jsKontrol() {
  // Form elemanlarını al
  const ad = document.getElementById('ad').value;
  const email = document.getElementById('email').value;
  const telefon = document.getElementById('telefon').value;
  const cinsiyet = document.querySelector('input[name="cinsiyet"]:checked');
  const konu = document.querySelector('select[name="konu"]').value;
  const mesaj = document.getElementById('mesaj').value;

  // Hata mesajlarını sıfırla
  resetErrors();

  let hasError = false;

  // Ad kontrolü
  if (ad.trim().length < 3) {
    showError('ad', 'Ad en az 3 karakter olmalıdır');
    hasError = true;
  }

  // Email kontrolü
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    showError('email', 'Geçerli bir e-posta adresi giriniz');
    hasError = true;
  }

  // Telefon kontrolü
  const telRegex = /^[0-9]{10,11}$/;
  if (!telRegex.test(telefon)) {
    showError('telefon', 'Telefon numarası 10-11 haneli olmalıdır');
    hasError = true;
  }

  // Cinsiyet kontrolü
  if (!cinsiyet) {
    showError('cinsiyet', 'Lütfen cinsiyet seçiniz');
    hasError = true;
  }

  // Konu kontrolü
  if (!konu) {
    showError('konu', 'Lütfen bir konu seçiniz');
    hasError = true;
  }

  // Mesaj kontrolü
  if (mesaj.trim().length < 10) {
    showError('mesaj', 'Mesaj en az 10 karakter olmalıdır');
    hasError = true;
  }

  if (!hasError) {
    alert('Form başarıyla doğrulandı! Gönder butonuna tıklayarak formu gönderebilirsiniz.');
  }
}

function showError(elementId, message) {
  const element = document.getElementById(elementId);
  element.classList.add('is-invalid');

  // Mevcut hata mesajı div'i varsa kaldır
  const existingError = element.nextElementSibling;
  if (existingError && existingError.classList.contains('invalid-feedback')) {
    existingError.remove();
  }

  // Yeni hata mesajı div'i oluştur
  const errorDiv = document.createElement('div');
  errorDiv.className = 'invalid-feedback';
  errorDiv.textContent = message;
  element.parentNode.insertBefore(errorDiv, element.nextSibling);
}

function resetErrors() {
  const formElements = document.getElementById('iletisimForm').elements;
  for (let element of formElements) {
    element.classList.remove('is-invalid');
    const nextElement = element.nextElementSibling;
    if (nextElement && nextElement.classList.contains('invalid-feedback')) {
      nextElement.remove();
    }
  }
}

function temizleForm() {
  document.getElementById('iletisimForm').reset();
  resetErrors();
}
