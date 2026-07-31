function addCounters() {
    const sections = document.querySelectorAll(".opblock-tag-section");
    if (!sections || sections.length === 0) return;

    sections.forEach((section) => {
        const total = section.querySelectorAll(".opblock").length;

        const tag = section.querySelector(".opblock-tag");
        if (!tag) return;

        const badge = document.createElement("span");
        badge.innerHTML = total + " endpoints";

        badge.style.cssText = `
            margin-left:auto;
            background:#f97316;
            color:white;
            padding:4px 10px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
        `;

        tag.appendChild(badge);
    });
}
