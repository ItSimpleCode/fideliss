var __spreadArray = (this && this.__spreadArray) || function (to, from, pack) {
    if (pack || arguments.length === 2) for (var i = 0, l = from.length, ar; i < l; i++) {
        if (ar || !(i in from)) {
            if (!ar) ar = Array.prototype.slice.call(from, 0, i);
            ar[i] = from[i];
        }
    }
    return to.concat(ar || Array.prototype.slice.call(from));
};
var Scrollbar = window.Scrollbar;
Scrollbar.initAll();
window.addEventListener("load", function () {
    var aside = document.getElementById("aside");
    var asideToggle = document.getElementById("aside_toggle");
    var aside_texts = document.querySelectorAll(".text");
    asideToggle === null || asideToggle === void 0 ? void 0 : asideToggle.addEventListener("click", function () {
        aside === null || aside === void 0 ? void 0 : aside.classList.toggle("active");
        if (aside === null || aside === void 0 ? void 0 : aside.classList.contains("active"))
            aside_texts.forEach(function (e, i) {
                return setTimeout(function () { return e.classList.add("active"); }, 100 * (i + 1));
            });
        else
            aside_texts.forEach(function (e) { return e.classList.remove("active"); });
    });
});
// Selection field
window.addEventListener("DOMContentLoaded", function () {
    /* selection input */
    var selectionCon = document.querySelectorAll(".selection-field");
    var selectionField = document.querySelectorAll(".selection-field .field");
    var selectionFieldInputF = document.querySelectorAll(".selection-field .front");
    var selectionFieldInputB = document.querySelectorAll(".selection-field .back");
    var selectionFieldOptions = document.querySelectorAll(".selection-field .options");
    selectionField.forEach(function (fie) {
        fie.addEventListener("click", function (e) {
            selectionCon.forEach(function (con) {
                con.contains(fie) &&
                    selectionFieldOptions.forEach(function (opt) {
                        con.contains(opt)
                            ? opt.classList.toggle("show")
                            : opt.classList.remove("show");
                    });
            });
        });
    });
    selectionFieldOptions.forEach(function (opt) {
        __spreadArray([], opt.children, true).forEach(function (chi) {
            chi.onclick = function () {
                return selectionCon.forEach(function (con) {
                    if (con.contains(chi)) {
                        selectionFieldInputF.forEach(function (inp) {
                            if (con.contains(inp))
                                inp.value = chi.textContent;
                        });
                        selectionFieldInputB.forEach(function (inp) {
                            if (con.contains(inp))
                                inp.value = chi.dataset.hidden;
                        });
                        opt.classList.remove("show");
                    }
                });
            };
        });
    });
    /* fill input */
    var inputName = document.querySelectorAll("input[name=first_name],input[name=last_name]");
    var inputNumber = document.querySelectorAll("input[name=phone_number]");
    var inputEmail = document.querySelectorAll("input[name=email]");
    var inputDate = document.querySelectorAll("input[name=birth_date]");
    var inputaddress = document.querySelectorAll("input[name=address]");
    inputName.forEach(function (inp) {
        inp.addEventListener("input", function () { return (inp.value = inp.value.replace(/[^a-z]/gi, "")); });
    });
    inputNumber.forEach(function (inp) {
        inp.addEventListener("input", function () { return (inp.value = inp.value.replace(/[^0-9]/gi, "")); });
    });
    inputEmail.forEach(function (inp) {
        inp.addEventListener("input", function () { return (inp.value = inp.value.replace(/[^a-zA-Z0-9._@-]/g, "")); });
    });
    inputDate.forEach(function (inp) {
        inp.addEventListener("input", function () {
            var value = inp.value;
            value = value.replace(/[^\d-]/g, "");
            if (value.length > 10)
                value = value.slice(0, 10);
            if (value.length > 2 && value[2] !== "-")
                value = value.slice(0, 2) + "-" + value.slice(2);
            if (value.length > 5 && value[5] !== "-")
                value = value.slice(0, 5) + "-" + value.slice(5);
            inp.value = value;
        });
    });
    inputAddress.forEach(function (inp) {
        inp.addEventListener("input", function () {
            var value = inp.value;
            value = value.replace(/[^a-zA-Z0-9 ,.-]/g, "");
            inp.value = value;
        });
    });
});
