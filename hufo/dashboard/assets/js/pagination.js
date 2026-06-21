// ==================================== PAGINATION ====================================
function renderPagination(total) {
  let pageCount = Math.ceil(total / rowsPerPage);
  let pagination = document.getElementById("pagination");
  pagination.innerHTML = "";

  if (pageCount <= 1) return;

  // PREV BUTTON
  pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
            <a class="page-link" onclick="changePage(${currentPage - 1})">Prev</a>
        </li>
    `;

  let maxVisible = 5;
  let start = Math.max(1, currentPage - 2);
  let end = Math.min(pageCount, currentPage + 2);

  // FIX kalau di awal
  if (currentPage <= 3) {
    start = 1;
    end = Math.min(pageCount, maxVisible);
  }

  // FIX kalau di akhir
  if (currentPage >= pageCount - 2) {
    start = Math.max(1, pageCount - (maxVisible - 1));
    end = pageCount;
  }

  // FIRST PAGE + DOTS
  if (start > 1) {
    pagination.innerHTML += `
            <li class="page-item"><a class="page-link" onclick="changePage(1)">1</a></li>
        `;
    if (start > 2) {
      pagination.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
  }

  // PAGE NUMBERS
  for (let i = start; i <= end; i++) {
    pagination.innerHTML += `
            <li class="page-item ${i === currentPage ? "active" : ""}">
                <a class="page-link" onclick="changePage(${i})">${i}</a>
            </li>
        `;
  }

  // LAST PAGE + DOTS
  if (end < pageCount) {
    if (end < pageCount - 1) {
      pagination.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
    pagination.innerHTML += `
            <li class="page-item"><a class="page-link" onclick="changePage(${pageCount})">${pageCount}</a></li>
        `;
  }

  // NEXT BUTTON
  pagination.innerHTML += `
        <li class="page-item ${currentPage === pageCount ? "disabled" : ""}">
            <a class="page-link" onclick="changePage(${currentPage + 1})">Next</a>
        </li>
    `;
}

// ===================================== PERGANTIAN HALAMAN PAGINATION =================================
function changePage(page) {
  currentPage = page;
  renderTable();
}
