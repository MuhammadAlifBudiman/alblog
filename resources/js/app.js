require("./bootstrap");

window.Vapor = require("laravel-vapor");

document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger input");
    const nav = document.querySelector("nav ul");

    hamburger.addEventListener("click", function () {
        nav.classList.toggle("translate-y-0");
        nav.classList.toggle("opacity-100");
    });
});
