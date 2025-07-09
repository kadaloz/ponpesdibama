export default function ppdbForm() {
    return {
        step: 1,

        nextStep() {
            if (this.validateStep()) {
                this.step++;
                this.toggleHalaqoh();
            }
        },

        prevStep() {
            this.step--;
        },

        toggleHalaqoh() {
            const asrama = document.querySelector(
                'input[name="ppdb_type"][value="Asrama"]'
            );
            const group = document.getElementById("halaqoh-period-group");
            if (asrama && group) {
                group.classList.toggle("hidden", asrama.checked);
            }
        },

        validateStep() {
            const current = document.querySelector(`#step-${this.step}`);
            const required = current.querySelectorAll("[required]");
            let valid = true;

            required.forEach((field) => {
                const value = field.value.trim();
                const isValid =
                    field.name === "parent_email"
                        ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
                        : field.name === "parent_phone"
                        ? /^\+?[0-9]{10,15}$/.test(value)
                        : field.name === "nisn"
                        ? /^[0-9]{10}$/.test(value)
                        : !!value;

                field.classList.toggle("border-red-500", !isValid);
                if (!isValid) valid = false;
            });

            if (!valid) alert("Mohon lengkapi semua data yang wajib diisi.");
            return valid;
        },

        handleSubmit() {
            grecaptcha.ready(() => {
                grecaptcha
                    .execute(window.recaptchaSiteKey || "", {
                        action: "ppdb_form",
                    })
                    .then((token) => {
                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "g-recaptcha-response";
                        input.value = token;
                        document.getElementById("ppdbForm").appendChild(input);
                        document.getElementById("ppdbForm").submit();
                    });
            });
        },
    };
}
