function createScrollButton() {
    const button = document.getElementById("scrollTop");
    if (!button) return;

    window.addEventListener("scroll", () => {
        button.style.display = window.scrollY > 500 ? "block" : "none";
    });

    button.onclick = () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
}
