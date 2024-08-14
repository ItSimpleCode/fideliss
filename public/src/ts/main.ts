const user = document.querySelector(".user");
const userPic = document.querySelector(".user .user-pic");
const userSubList = document.querySelector(".user .sub-list");

const date = document.querySelector(".date");
const dateBtn = document.querySelector(".date .date-btn");
const subDate = document.querySelector(".date .sub-list");

userPic?.addEventListener("click", () => userSubList.classList.toggle("show"));
dateBtn?.addEventListener("click", () => subDate.classList.toggle("show"));

window.addEventListener("click", (e) => {
    [
        {
            area: user,
            show: userSubList,
        },
        {
            area: date,
            show: subDate,
        },
    ].forEach(
        (obj) =>
            !obj.area.contains(e.target) && obj.show.classList.remove("show")
    );
});
