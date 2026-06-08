const avatar = document.querySelector(".avatar > img");
const dropdown = document.querySelector(".dropdown");

avatar.addEventListener("click", () => {
    if (getComputedStyle(dropdown).display === "none") {
        dropdown.style.display = "flex";
    } else {
        dropdown.style.display = "none";
    }
});

const popup = document.querySelector(".feed-url");

if (popup) {
    popup.addEventListener("click", (e) => {
        if (e.target === popup) {
            window.location.href = window.location.pathname;
        }
    });
}
