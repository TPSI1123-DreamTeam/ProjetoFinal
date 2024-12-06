document.addEventListener("DOMContentLoaded", function() {
    // Add click event listeners to all table headers
    document.querySelectorAll("th").forEach((header, index) => {
        header.addEventListener("click", function() {
            sortTable(header, index);
        });
    });
});

function sortTable(header, columnIndex) {
    const table = header.closest("table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const isNumeric = !isNaN(rows[0].children[columnIndex].textContent.trim());
    const isAscending = header.dataset.sortOrder !== "asc";

    rows.sort((rowA, rowB) => {
        const cellA = rowA.children[columnIndex].textContent.trim();
        const cellB = rowB.children[columnIndex].textContent.trim();

        if (isNumeric) {
            return isAscending ? cellA - cellB : cellB - cellA;
        } else {
            return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        }
    });

    rows.forEach(row => tbody.appendChild(row));
    header.dataset.sortOrder = isAscending ? "asc" : "desc";
}
