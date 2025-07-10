export default function ppdbForm() {
    return {
        step: 1,
        ppdbType: "", // <-- model binding langsung ke input radio
        isSubmitting: false,

        nextStep() {
            if (this.validateStep()) this.step++;
        },

        prevStep() {
            this.step--;
        },

        validateStep() {
            const current = document.querySelector(`#step-${this.step}`);
            const required = current.querySelectorAll(
                "[required], [data-required-if]"
            );
            let valid = true;

            required.forEach((field) => {
                let isRequired = field.hasAttribute("required");

                const condition = field.dataset.requiredIf;
                if (condition) {
                    const [targetName, expectedValue] = condition.split(":");
                    const target = document.querySelector(
                        `[name="${targetName}"]:checked`
                    );
                    isRequired = target?.value === expectedValue;
                }

                const value = field.value?.trim?.() || "";
                const isValid =
                    !isRequired ||
                    (field.name === "parent_email"
                        ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
                        : field.name === "parent_phone"
                        ? /^\+?[0-9]{10,15}$/.test(value)
                        : field.name === "nisn"
                        ? /^[0-9]{10}$/.test(value)
                        : !!value);

                field.classList.toggle("border-red-500", !isValid);
                if (!isValid) valid = false;
            });

            if (!valid) alert("Mohon lengkapi semua data yang wajib diisi.");
            return valid;
        },

        handleSubmit() {
            if (!this.validateStep()) return;
            this.isSubmitting = true;

            grecaptcha.ready(() => {
                const siteKey = window.recaptchaSiteKey || "";
                if (!siteKey) {
                    alert("reCAPTCHA gagal dimuat. Coba lagi nanti.");
                    this.isSubmitting = false;
                    return;
                }

                grecaptcha
                    .execute(siteKey, { action: "ppdb_form" })
                    .then((token) => {
                        const form = document.getElementById("ppdbForm");

                        let input = form.querySelector(
                            'input[name="g-recaptcha-response"]'
                        );
                        if (!input) {
                            input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "g-recaptcha-response";
                            form.appendChild(input);
                        }

                        input.value = token;
                        this.isSubmitting = false;
                        form.submit();
                    })
                    .catch((err) => {
                        console.error("reCAPTCHA error:", err);
                        this.isSubmitting = false;
                        alert("Verifikasi reCAPTCHA gagal. Silakan coba lagi.");
                    });
            });
        },
    };
}
