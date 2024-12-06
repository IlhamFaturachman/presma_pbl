document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const rankingBody = document.getElementById("rankingBody");
  const pagination = document.getElementById("pagination");

  // Data Mockup
  const data = [
      { lomba: "Lomba Menembak", juara: "Juara 1", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Menunggu Validasi" },
      { lomba: "XXL Freshman Cypher", juara: "Juara Harapan 3", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Terverifikasi" },
      { lomba: "Complexcon Best Suite", juara: "Juara 2", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Internasional", status: "Ditolak" },
      { lomba: "Hackathon 2024", juara: "Juara 3", pembimbing: "Dr. Taufiq R.", tingkat: "Internasional", status: "Terverifikasi" },
      { lomba: "Essay Competition", juara: "Juara Harapan 1", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Menunggu Validasi" },
      { lomba: "Startup Expo", juara: "Juara 2", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Terverifikasi" },
      { lomba: "Lomba Menembak", juara: "Juara 1", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Menunggu Validasi" },
      { lomba: "XXL Freshman Cypher", juara: "Juara Harapan 3", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Terverifikasi" },
      { lomba: "Complexcon Best Suite", juara: "Juara 2", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Internasional", status: "Ditolak" },
      { lomba: "Hackathon 2024", juara: "Juara 3", pembimbing: "Dr. Taufiq R.", tingkat: "Internasional", status: "Terverifikasi" },
      { lomba: "Essay Competition", juara: "Juara Harapan 1", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Menunggu Validasi" },
      { lomba: "Startup Expo", juara: "Juara 2", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Terverifikasi" },
  ];

  const rowsPerPage = 10;
  let currentPage = 1;
  let totalRows = data.length;
  let totalPages = Math.ceil(totalRows / rowsPerPage);

  // Render Table Rows
  function renderRows(page = 1) {
    rankingBody.innerHTML = "";

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    const visibleRows = data.slice(start, end);

    visibleRows.forEach(item => {
        const statusClass = `status ${item.status.replace(" ", "")}`; // Adjust class to match new status
        const actionClass = item.status === "Ditolak" ? "btn btn-info" : "btn btn-primary"; // Update button class for "Ditolak"
        const actionText = item.status === "Ditolak" ? "Info" : "Detail";

        rankingBody.innerHTML += `
            <tr>
                <td>${item.lomba}</td>
                <td>${item.juara}</td>
                <td>${item.pembimbing}</td>
                <td>${item.tingkat}</td>
                <td><span class="${statusClass}">${item.status}</span></td>
                <td>
                    <button class="${actionClass}">${actionText}</button>
                </td>
            </tr>`;
    });
  }

  // Render Pagination
  function renderPagination() {
      pagination.innerHTML = "";

      // Previous Button
      pagination.innerHTML += `
          <li class="${currentPage === 1 ? "disabled" : ""}">
              <a href="#" data-page="${currentPage - 1}">Prev</a>
          </li>`;

      // Page Numbers
      for (let i = 1; i <= totalPages; i++) {
          pagination.innerHTML += `
              <li class="${currentPage === i ? "active" : ""}">
                  <a href="#" data-page="${i}">${i}</a>
              </li>`;
      }

      // Next Button
      pagination.innerHTML += `
          <li class="${currentPage === totalPages ? "disabled" : ""}">
              <a href="#" data-page="${currentPage + 1}">Next</a>
          </li>`;
  }

  // Update Table and Pagination
  function updateTable(page) {
      currentPage = page;
      renderRows(page);
      renderPagination();
  }

  // Search Functionality
  searchInput.addEventListener("input", () => {
      const searchTerm = searchInput.value.toLowerCase();

      const filteredData = data.filter(item => {
          return Object.values(item).some(value => 
              String(value).toLowerCase().includes(searchTerm)
          );
      });

      totalRows = filteredData.length;
      totalPages = Math.ceil(totalRows / rowsPerPage);
      updateTable(1); // Reset to first page
  });

  // Handle Pagination Click
  pagination.addEventListener("click", (e) => {
      e.preventDefault();
      const target = e.target;

      if (target.tagName === "A") {
          const page = parseInt(target.dataset.page, 10);

          if (!isNaN(page) && page >= 1 && page <= totalPages) {
              updateTable(page);
          }
      }
  });

  // Initial Render
  updateTable(currentPage);
});
