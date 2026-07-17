function createExpandButtons() {
    const expandAllBtn = document.getElementById("expandAll");
    if (expandAllBtn) {
        expandAllBtn.onclick = () => {
            document.querySelectorAll(".opblock-summary").forEach((x) => {
                if (!x.parentElement.classList.contains("is-open")) x.click();
            });
        };
    }

    const collapseAllBtn = document.getElementById("collapseAll");
    if (collapseAllBtn) {
        collapseAllBtn.onclick = () => {
            document.querySelectorAll(".opblock-summary").forEach((x) => {
                if (x.parentElement.classList.contains("is-open")) x.click();
            });
        };
    }
}
