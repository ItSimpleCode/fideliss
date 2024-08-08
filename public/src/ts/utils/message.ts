window.addEventListener("load", () => {
    const messages = document.querySelectorAll(".error");
    const messagesCloseError = document.querySelectorAll(".error .close_error");

    messages.forEach((e) => e?.classList.add("show"));

    messagesCloseError.forEach((btn) => {
        btn.onclick = () => {
            messages.forEach((parent) => {
                if (parent.contains(btn)) parent.remove();
            });
        };
    });
});
