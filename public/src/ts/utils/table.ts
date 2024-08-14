// window.addEventListener("DOMContentLoaded", () => {
//     const navSearcher = document.getElementById("nav-searcher");
//     const tableBodytr = document.querySelectorAll(".main-table tbody tr");

//     navSearcher.addEventListener("input", () => {
//         let keyWord = navSearcher.value.toLowerCase();
//         outerLoop: for (const tr of tableBodytr) {
//             let trChildren = [...tr.children].slice(1, -1);
//             tr.style.display = "";
//             for (let th of trChildren) {
//                 if (th.textContent.toLowerCase().includes(keyWord))
//                     continue outerLoop;
//             }
//             tr.style.display = "none";
//         }
//     });
// });
