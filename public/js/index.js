const layouts = document.querySelectorAll(".layout-option");

layouts.forEach((layout) =>
    layout.addEventListener("click", () => {
        layouts.forEach((lay) => lay.classList.remove("layout-selected"));
        layout.classList.add("layout-selected");
    }),
);
