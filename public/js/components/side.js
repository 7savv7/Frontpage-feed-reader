const categories = document.querySelectorAll(".category");

categories.forEach((category) =>
    category.addEventListener("click", (e) => {
        category.nextElementSibling.classList.toggle("open");
    }),
);
