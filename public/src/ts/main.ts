const bars = document.querySelector(".aside-toggle");
const aside = document.getElementById("aside");

const user = document.querySelector(".user");
const userPic = document.querySelector(".user .user-pic");
const userSubList = document.querySelector(".user .sub-list");

const date = document.querySelector(".date");
const dateBtn = document.querySelector(".date .date-btn");
const subDate = document.querySelector(".date .sub-list");

const showToggle = [
    {
        trigger: bars,
        area: aside,
        show: aside,
    },
    {
        trigger: userPic,
        area: user,
        show: userSubList,
    },
    {
        trigger: dateBtn,
        area: date,
        show: subDate,
    },
];

showToggle.forEach((obj) =>
    obj.trigger?.addEventListener("click", () =>
        obj.show?.classList.toggle("show")
    )
);

window.addEventListener("click", (e) => {
    showToggle.forEach((obj) => {
        if (
            !obj.area?.contains(e.target as HTMLElement) &&
            !obj.trigger?.contains(e.target as HTMLElement)
        )
            obj.show?.classList.remove("show");
    });
});

window.addEventListener("resize", (e) => console.log(innerWidth));
window.addEventListener("load", (e) => console.log(innerWidth));
