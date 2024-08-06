var __spreadArray = (this && this.__spreadArray) || function (to, from, pack) {
    if (pack || arguments.length === 2) for (var i = 0, l = from.length, ar; i < l; i++) {
        if (ar || !(i in from)) {
            if (!ar) ar = Array.prototype.slice.call(from, 0, i);
            ar[i] = from[i];
        }
    }
    return to.concat(ar || Array.prototype.slice.call(from));
};
export function selectionField() {
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
}
// function field() {
//     window.addEventListener("DOMContentLoaded", () => {
//         /* selection input */
//         const selectionCon = document.querySelectorAll(".selection-field");
//         const selectionField = document.querySelectorAll(
//             ".selection-field .field"
//         );
//         const selectionFieldInputF = document.querySelectorAll(
//             ".selection-field .front"
//         );
//         const selectionFieldInputB = document.querySelectorAll(
//             ".selection-field .back"
//         );
//         const selectionFieldOptions = document.querySelectorAll(
//             ".selection-field .options"
//         );
//         selectionField.forEach((fie) => {
//             fie.addEventListener("click", (e) => {
//                 selectionCon.forEach((con) => {
//                     con.contains(fie) &&
//                         selectionFieldOptions.forEach((opt) => {
//                             con.contains(opt)
//                                 ? opt.classList.toggle("show")
//                                 : opt.classList.remove("show");
//                         });
//                 });
//             });
//         });
//         selectionFieldOptions.forEach((opt) => {
//             [...opt.children].forEach((chi) => {
//                 chi.onclick = () =>
//                     selectionCon.forEach((con) => {
//                         if (con.contains(chi)) {
//                             selectionFieldInputF.forEach((inp) => {
//                                 if (con.contains(inp))
//                                     inp.value = chi.textContent;
//                             });
//                             selectionFieldInputB.forEach((inp) => {
//                                 if (con.contains(inp))
//                                     inp.value = chi.dataset.hidden;
//                             });
//                             opt.classList.remove("show");
//                         }
//                     });
//             });
//         });
//         /* fill input */
//         const inputName = document.querySelectorAll(
//             "input[name=first_name],input[name=last_name]"
//         );
//         const inputNumber = document.querySelectorAll(
//             "input[name=phone_number]"
//         );
//         const inputEmail = document.querySelectorAll("input[name=email]");
//         const inputDate = document.querySelectorAll("input[name=birth_date]");
//         const inputAddress = document.querySelectorAll("input[name=address]");
//         inputName.forEach((inp) => {
//             inp.addEventListener(
//                 "input",
//                 () => (inp.value = inp.value.replace(/[^a-z]/gi, ""))
//             );
//         });
//         inputNumber.forEach((inp) => {
//             inp.addEventListener(
//                 "input",
//                 () => (inp.value = inp.value.replace(/[^0-9]/gi, ""))
//             );
//         });
//         inputEmail.forEach((inp) => {
//             inp.addEventListener(
//                 "input",
//                 () => (inp.value = inp.value.replace(/[^a-zA-Z0-9._@-]/g, ""))
//             );
//         });
//         inputDate.forEach((inp) => {
//             inp.addEventListener("input", () => {
//                 let value = inp.value;
//                 value = value.replace(/[^\d-]/g, "");
//                 if (value.length > 10) value = value.slice(0, 10);
//                 if (value.length > 2 && value[2] !== "-")
//                     value = value.slice(0, 2) + "-" + value.slice(2);
//                 if (value.length > 5 && value[5] !== "-")
//                     value = value.slice(0, 5) + "-" + value.slice(5);
//                 inp.value = value;
//             });
//         });
//         inputAddress.forEach((inp) => {
//             inp.addEventListener("input", function () {
//                 let value = inp.value;
//                 value = value.replace(/[^a-zA-Z0-9 ,.-]/g, "");
//                 inp.value = value;
//             });
//         });
//     });
// }
