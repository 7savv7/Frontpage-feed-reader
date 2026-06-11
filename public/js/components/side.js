const categories = document.querySelectorAll(".category");

categories.forEach((category) =>
    category.addEventListener("click", (e) => {
        category.nextElementSibling.classList.toggle("open");
    }),
);

document.querySelectorAll(".feed").forEach((link) => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const id = this.dataset.id;

        const params = new URLSearchParams(window.location.search);

        let selected = params.getAll("feed[]");

        if (selected.includes(id)) {
            selected = selected.filter((x) => x !== id);
        } else {
            selected.push(id);
        }

        params.delete("feed[]");
        selected.forEach((v) => params.append("feed[]", v));

        window.location.search = params.toString();
    });
});
