function addEndpointBadges() {
    const ops = document.querySelectorAll(".opblock");
    if (!ops || ops.length === 0) return;

    ops.forEach((op) => {
        const txt = op.innerText.toLowerCase();
        const badge = document.createElement("span");

        badge.style.cssText = `
            margin-left:12px;
            padding:4px 8px;
            border-radius:999px;
            font-size:10px;
            font-weight:700;
        `;

        if (
            txt.includes("bearer") ||
            txt.includes("jwt")
        ) {
            badge.innerHTML = "JWT";
            badge.style.background = "#3b82f6";
            badge.style.color = "white";
        } else {
            badge.innerHTML = "PUBLIC";
            badge.style.background = "#22c55e";
            badge.style.color = "white";
        }

        op.querySelector(".opblock-summary-path")?.appendChild(badge);
    });
}
