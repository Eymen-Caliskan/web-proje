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
            errors: [],
            fieldErrors: {
                ad: false,
                email: false,
                telefon: false,
                cinsiyet: false,
                konu: false,
                mesaj: false
            }
        }
    },
    methods: {
        clearErrors() {
            this.errors = [];
            this.resetFieldErrors();
        },
        resetFieldErrors() {
            Object.keys(this.fieldErrors).forEach(key => {
                this.fieldErrors[key] = false;
            });
        },
        vueKontrol() {
            this.errors = [];
            this.resetFieldErrors();
            let hasError = false;

            // Ad kontrolü
            if (this.formData.ad.trim().length < 3) {
                this.errors.push('Ad en az 3 karakter olmalıdır');
                this.fieldErrors.ad = true;
                hasError = true;
            }

            // Email kontrolü
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.formData.email)) {
                this.errors.push('Geçerli bir e-posta adresi giriniz');
                this.fieldErrors.email = true;
                hasError = true;
            }

            // Telefon kontrolü
            const telRegex = /^[0-9]{10,11}$/;
            if (!telRegex.test(this.formData.telefon)) {
                this.errors.push('Geçerli bir telefon numarası giriniz (10-11 rakam)');
                this.fieldErrors.telefon = true;
                hasError = true;
            }

            // Cinsiyet kontrolü
            if (!this.formData.cinsiyet) {
                this.errors.push('Lütfen cinsiyet seçiniz');
                this.fieldErrors.cinsiyet = true;
                hasError = true;
            }

            // Konu kontrolü
            if (!this.formData.konu) {
                this.errors.push('Lütfen bir konu seçiniz');
                this.fieldErrors.konu = true;
                hasError = true;
            }

            // Mesaj kontrolü
            if (this.formData.mesaj.trim().length < 10) {
                this.errors.push('Mesaj en az 10 karakter olmalıdır');
                this.fieldErrors.mesaj = true;
                hasError = true;
            }

            if (!hasError) {
                document.getElementById('iletisimForm').submit();
            }
        }
    }
}).mount('#app') 