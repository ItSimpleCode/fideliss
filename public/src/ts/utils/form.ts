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

    /* fill input */
    const inputName = document.querySelectorAll(
        "input[name=first_name],input[name=last_name],input[name=name]"
    );
    const inputNumber = document.querySelectorAll("input[name=phone_number]");
    const inputEmail = document.querySelectorAll("input[name=email]");
    const inputDate = document.querySelectorAll("input[name=birth_date]");
    const inputAddress = document.querySelectorAll("input[name=address]");

    inputName.forEach((inp) => {
        inp.addEventListener(
            "input",
            () => (inp.value = inp.value.replace(/[^a-z\s]/gi, ""))
        );
    });
    inputNumber.forEach((inp) => {
        inp.addEventListener(
            "input",
            () => (inp.value = inp.value.replace(/[^0-9]/gi, ""))
        );
    });
    inputEmail.forEach((inp) => {
        inp.addEventListener(
            "input",
            () => (inp.value = inp.value.replace(/[^a-zA-Z0-9._@-]/g, ""))
        );
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

    inputAddress.forEach((inp) => {
        inp.addEventListener("input", function () {
            let value = inp.value;
            value = value.replace(/[^a-zA-Z0-9 ,.-]/g, "");
            inp.value = value;
        });
    });
});
