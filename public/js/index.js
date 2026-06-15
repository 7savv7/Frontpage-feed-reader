const layouts = document.querySelectorAll(".layout-option");
const articles = document.querySelector(".articles");

layouts.forEach((layout) =>
    layout.addEventListener("click", () => {
        layouts.forEach((lay) => lay.classList.remove("layout-selected"));
        layout.classList.add("layout-selected");

        switch (Number(layout.id)) {
            case 1:
                articles.classList.add("first");
                articles.classList.remove("second", "third");
                break;
            case 2:
                articles.classList.add("second");
                articles.classList.remove("first", "third");
                break;
            case 3:
                articles.classList.add("third");
                articles.classList.remove("first", "second");
                break;
        }
    }),
);
