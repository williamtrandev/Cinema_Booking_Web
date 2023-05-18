const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// SHOW SIDEBAR
menuBtn.addEventListener("click", () => {
    sideMenu.style.display = "block";
});

// CLOSE SIDEBAR
closeBtn.addEventListener("click", () => {
    sideMenu.style.display = "none";
});

// CHANGE THEME
themeToggler.addEventListener("click", () => {
    const isDark = document.body.classList.contains("dark-theme-variables");
    if (isDark) {
        localStorage.setItem("theme", "light");
    } else {
        console.log("set light");
        localStorage.setItem("theme", "dark");
    }
    document.body.classList.toggle("dark-theme-variables");
    themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
    themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});

// LOAD THEME
const loadTheme = () => {
    const oldTheme = localStorage.getItem("theme");
    console.log(oldTheme);
    if (oldTheme == "dark") {
        document.body.classList.toggle("dark-theme-variables");
        themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
        themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
    }
};

loadTheme();


// const openEdit = () => {
//     document.getElementById("button-edit").click();
// };
$("li").click(function () {
    $(this).addClass("active").siblings().removeClass("active");
});