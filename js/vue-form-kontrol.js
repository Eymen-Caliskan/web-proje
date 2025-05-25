const { createApp } = Vue

createApp({
    data() {
        return {
            formData: {
                ad: '',
                email: '',
                telefon: '',
                cinsiyet: '',
                konu: '',
                mesaj: ''
            },
            errors: {},
            fieldErrors: {},
            isSubmitted: false,
            successMessage: ''
        }
    },
    methods: {
        clearErrors() {
            this.errors = {};
            this.fieldErrors = {};
        },
        validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        },
        vueKontrol(e) {
            this.clearErrors();
            this.isSubmitted = false;
            let isValid = true;
            const errors = [];
            const fieldErrors = {};

            // Ad kontrolü
            if (this.formData.ad.length < 3) {
                errors.push('Ad en az 3 karakter olmalıdır');
                fieldErrors.ad = true;
                isValid = false;
            }

            // Email kontrolü
            if (!this.validateEmail(this.formData.email)) {
                errors.push('Geçerli bir e-posta adresi giriniz');
                fieldErrors.email = true;
                isValid = false;
            }

            // Telefon kontrolü
            if (!/^[0-9]{10,11}$/.test(this.formData.telefon)) {
                errors.push('Telefon numarası 10-11 haneli olmalıdır');
                fieldErrors.telefon = true;
                isValid = false;
            }

            // Cinsiyet kontrolü
            if (!this.formData.cinsiyet) {
                errors.push('Lütfen cinsiyet seçiniz');
                fieldErrors.cinsiyet = true;
                isValid = false;
            }

            // Konu kontrolü
            if (!this.formData.konu) {
                errors.push('Lütfen bir konu seçiniz');
                fieldErrors.konu = true;
                isValid = false;
            }

            // Mesaj kontrolü
            if (this.formData.mesaj.length < 10) {
                errors.push('Mesaj en az 10 karakter olmalıdır');
                fieldErrors.mesaj = true;
                isValid = false;
            }

            if (!isValid) {
                this.errors = errors;
                this.fieldErrors = fieldErrors;
                return;
            }

            // Form geçerliyse yeni sayfada göster
            const formHTML = `
                <!DOCTYPE html>
                <html lang="tr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Form Başarıyla Gönderildi</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body {
                            background: linear-gradient(135deg, #a8e6cf 0%, #3498db 100%);
                            min-height: 100vh;
                            padding: 40px 0;
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        }
                        .success-container {
                            background: white;
                            padding: 30px;
                            border-radius: 10px;
                            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                            max-width: 600px;
                            margin: 0 auto;
                        }
                        .details {
                            background: #f8f9fa;
                            padding: 20px;
                            border-radius: 8px;
                            margin: 20px 0;
                        }
                        .back-button {
                            background: #3498db;
                            color: white;
                            padding: 10px 20px;
                            border-radius: 5px;
                            text-decoration: none;
                            display: inline-block;
                            margin-top: 20px;
                            transition: background 0.3s;
                        }
                        .back-button:hover {
                            background: #2980b9;
                            color: white;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="success-container">
                            <h2 class="text-center mb-4">Form Başarıyla Gönderildi!</h2>
                            <div class="alert alert-success">
                                Mesajınız için teşekkür ederiz. En kısa sürede size dönüş yapılacaktır.
                            </div>
                            <div class="details">
                                <h4 class="mb-3">Gönderilen Bilgiler:</h4>
                                <p><strong>Ad Soyad:</strong> ${this.formData.ad}</p>
                                <p><strong>E-posta:</strong> ${this.formData.email}</p>
                                <p><strong>Telefon:</strong> ${this.formData.telefon}</p>
                                <p><strong>Cinsiyet:</strong> ${this.formData.cinsiyet}</p>
                                <p><strong>Konu:</strong> ${this.formData.konu}</p>
                                <p><strong>Mesaj:</strong> ${this.formData.mesaj}</p>
                            </div>
                            <div class="text-center">
                                <a href="iletisim.html" class="back-button">İletişim Sayfasına Dön</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `;

            // Yeni pencere aç ve HTML içeriğini yaz
            const newWindow = window.open();
            newWindow.document.write(formHTML);
            newWindow.document.close();

            // Ana formu temizle
            Object.keys(this.formData).forEach(key => {
                this.formData[key] = '';
            });
        }
    }
}).mount('#app') 