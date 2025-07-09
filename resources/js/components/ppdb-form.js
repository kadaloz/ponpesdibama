export default function ppdbForm() {
    return {
        step: 1,
        showHalaqoh: false,

        init() {
            this.updateHalaqohVisibility();

            document
                .querySelectorAll('input[name="ppdb_type"]')
                .forEach((el) => {
                    el.addEventListener("change", () => {
                        this.updateHalaqohVisibility();
                    });
                });
        },

        nextStep() {
            if (this.validateStep()) {
                this.step++;
                this.updateHalaqohVisibility();
            }
        },

        prevStep() {
            this.step--;
        },

        updateHalaqohVisibility() {
            const selected = document.querySelector(
                'input[name="ppdb_type"]:checked'
            );
            this.showHalaqoh = selected?.value === "Pulang-Pergi";
        },
        validateStep() {
            const current = document.querySelector(`#step-${this.step}`);
            const required = current.querySelectorAll(
                "[required], [data-required-if]"
            );
            let valid = true;

            required.forEach((field) => {
                let isRequired = field.hasAttribute("required");

                // Cek kondisi dinamis
                const condition = field.dataset.requiredIf;
                if (condition) {
                    const [targetName, expectedValue] = condition.split(":");
                    const target = document.querySelector(
                        `[name="${targetName}"]:checked`
                    );
                    isRequired = target?.value === expectedValue;
                }

                const value = field.value.trim();
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
