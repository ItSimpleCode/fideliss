var Scrollbar = window.Scrollbar;

Scrollbar.initAll();

window.addEventListener("load", () => {
    let aside = document.getElementById("aside");
    let asideToggle = document.getElementById("aside_toggle");
    let aside_texts = document.querySelectorAll(".text");

    asideToggle?.addEventListener("click", () => {
        aside?.classList.toggle("active");
        if (aside?.classList.contains("active"))
            aside_texts.forEach((e, i) =>
                setTimeout(() => e.classList.add("active"), 100 * (i + 1))
            );
        else aside_texts.forEach((e) => e.classList.remove("active"));
    });
});

// Selection field

window.addEventListener("DOMContentLoaded", () => {
    const selectionCon = document.querySelectorAll(".selection-field");
    const selectionField = document.querySelectorAll(".selection-field .field");
    const selectionFieldInput = document.querySelectorAll(
        ".selection-field input"
    );
    const selectionFieldOptions = document.querySelectorAll(
        ".selection-field .options"
    );

    selectionField.forEach((fie) => {
        fie.addEventListener("click", (e) => {
            selectionCon.forEach((con) => {
                con.contains(fie) &&
                    selectionFieldOptions.forEach((opt) => {
                        con.contains(opt)
                            ? opt.classList.toggle("show")
                            : opt.classList.remove("show");
                    });
            });
        });
    });

    selectionFieldOptions.forEach((opt) => {
        [...opt.children].forEach((chi) => {
            chi.onclick = () =>
                selectionCon.forEach((con) => {
                    con.contains(chi) &&
                        selectionFieldInput.forEach((inp) => {
                            con.contains(inp) &&
                                (inp.value = chi.textContent) &&
                                opt.classList.remove("show");
                        });
                });
        });
    });
});
