function createSearch() {
    const input = document.getElementById("swaggerSearch");
    if (!input) return;

    const endpoints = document.querySelectorAll(".opblock");
    if (!endpoints || endpoints.length === 0) return;

    input.addEventListener("input", (e) => {
        const text = e.target.value.toLowerCase();

        endpoints.forEach((endpoint) => {
            endpoint.style.display =
                endpoint.innerText.toLowerCase().includes(text)
                    ? ""
                    : "none";
        });
    });
}
