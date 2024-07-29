// window.addEventListener("load", () => {
//     const mainAside = document.getElementById("main_aside");
//     const asideToggle = document.getElementById("aside_toggle");

//     asideToggle?.addEventListener("click", () =>
//         mainAside?.classList.toggle("show-list")
//     );
// });
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
