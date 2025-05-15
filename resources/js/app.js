require("./bootstrap");
import Alpine from "alpinejs";
import "trix";
import feather from "feather-icons";

window.Vapor = require("laravel-vapor");

window.Alpine = Alpine;
Alpine.start();
feather.replace();

const html = document.documentElement;
const themeSelector = document.getElementById("theme-selector");
const storedTheme = localStorage.getItem("theme");
const name = document.querySelector("#name");
const slug = document.querySelector("#slug");
const title = document.querySelector("#title");

// Refactored theme handling logic
const applyTheme = (theme) => {
    html.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
};

if (storedTheme) {
    applyTheme(storedTheme);
    if (themeSelector) themeSelector.value = storedTheme;
} else if (themeSelector) {
    const defaultTheme = themeSelector.value;
    applyTheme(defaultTheme);
}

html.removeAttribute("hidden");

if (themeSelector) {
    themeSelector.addEventListener("change", (event) => {
        applyTheme(event.target.value);
    });
}

if (name) {
    name.addEventListener("change", function () {
        fetch("/dashboard/categories/checkSlug?name=" + name.value)
            .then((response) => response.json())
            .then((data) => (slug.value = data.slug));
    });
}

if (title) {
    title.addEventListener("change", function () {
        fetch("/dashboard/posts/checkSlug?title=" + title.value)
            .then((response) => response.json())
            .then((data) => (slug.value = data.slug));
    });
}

document.addEventListener("trix-file-accept", function (e) {
    e.preventDefault();
});

function priviewImage() {
    const image = document.querySelector("#image");
    const imgPriview = document.querySelector(".img-priview");

    imgPriview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPriview.src = oFREvent.target.result;
    };
}
