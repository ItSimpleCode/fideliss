window.addEventListener("DOMContentLoaded", () => {
    /* selection input */
    const selection = document.querySelectorAll(".selection-field");
    const frontInput = document.querySelectorAll(".selection-field .front");
    const backInput = document.querySelectorAll(".selection-field .back");
    const inputOptions = document.querySelectorAll(".selection-field .options");

    frontInput.forEach((f) => {
        f.addEventListener("click", () => {
            selection.forEach((con) => {
                if (con.contains(f)) {
                    inputOptions.forEach((opt) => {
                        if (con.contains(opt)) opt.classList.toggle("show");
                        else opt.classList.remove("show");
                    });
                }
            });
        });
    });
    inputOptions.forEach((opt) => {
        [...opt.children].forEach((chi) => {
            chi.onclick = () =>
                selection.forEach((con) => {
                    if (con.contains(chi)) {
                        frontInput.forEach((inp) => {
                            if (con.contains(inp)) inp.value = chi.textContent;
                        });
                        backInput.forEach((inp) => {
                            if (con.contains(inp))
                                inp.value = chi.dataset.hidden;
                        });
                        opt.classList.remove("show");
                    }
                });
        });
    });

    function preventDeletion(event) {
        const deletionKeys = [8, 46];
        if (deletionKeys.includes(event.keyCode)) event.preventDefault();
    }

    frontInput.forEach((inp) => {
        inp.addEventListener("keydown", preventDeletion);
        inp.addEventListener("input", (e) => {
            if (e.data) {
                inp.value = inp.value.slice(0, -1);
            } else inp.value = resetInput;
        });
    });

    /* fill input */
    const inputDate = document.querySelectorAll("input[name=birth_date]");
    const inputWallet = document.querySelectorAll("input[name=wallet]");

    const inputPattern = [
        {
            class: "input[name=cin]",
            pattern: /[^a-z0-9]/gi,
        },
        {
            class: "input[name=first_name],input[name=last_name],input[name=name]",
            pattern: /[^a-z\s]/gi,
        },
        {
            class: "input[name=phone_number]",
            pattern: /[^0-9]/gi,
        },
        {
            class: "input[name=email]",
            pattern: /[^a-zA-Z0-9._@-]/g,
        },
        {
            class: "input[name=address]",
            pattern: /[^a-zA-Z0-9 ,.-]/g,
        },
    ];

    inputPattern.forEach((obj) => {
        document.querySelectorAll(obj.class).forEach((inp) => {
            inp.addEventListener(
                "input",
                () => (inp.value = inp.value.replace(obj.pattern, ""))
            );
        });
    });

    inputWallet.forEach((inp) => {
        inp.addEventListener("input", () => {
            // Replace any character that isn't a digit or a decimal point
            inp.value = inp.value.replace(/[^\d.]/g, "");

            // Ensure only one decimal point is allowed
            const parts = inp.value.split(".");
            if (parts.length > 2) {
                inp.value = parts[0] + "." + parts.slice(1).join("");
            }

            // If a decimal point exists, ensure only two decimal places are allowed
            if (parts[1]?.length > 2) {
                inp.value = parts[0] + "." + parts[1].substring(0, 2);
            }

            // Prevent leading zeros (except in the case of '0.' for decimal numbers)
            if (/^0[0-9]/.test(inp.value)) {
                inp.value = inp.value.replace(/^0+/, "");
            }
        });
    });

    inputDate.forEach((inp) => {
        inp.addEventListener("input", () => {
            let value = inp.value;

            // Remove any character that is not a digit or a hyphen
            value = value.replace(/[^\d-]/g, "");

            // Limit the value to 10 characters to match the YYYY-MM-DD format
            if (value.length > 10) value = value.slice(0, 10);

            // Insert hyphen after the fourth character if not present
            if (value.length > 4 && value[4] !== "-")
                value = value.slice(0, 4) + "-" + value.slice(4);

            // Insert hyphen after the seventh character if not present
            if (value.length > 7 && value[7] !== "-")
                value = value.slice(0, 7) + "-" + value.slice(7);

            // Update the input field value
            inp.value = value;
        });
    });
});
