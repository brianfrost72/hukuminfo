// m.in-reports
// ============================================ INPUT RUPIAH ======================================
let data = [];
let currentPage = 1;

function formatRupiah(angka) {
  return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",-";
}

function formatInputRupiah(el) {
  let angka = el.value.replace(/[^0-9]/g, "");

  if (angka === "") {
    el.value = "";
    return;
  }

  let formatted = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  el.value = "Rp. " + formatted + ",-";
}

// ========================================= PAGINATION =========================================

  // ================= TOTAL =================
  let totalFiltered = filtered.reduce((a, b) => a + b.jumlah, 0);
  animateTotal(totalFiltered);

  // ================= PAGINATION =================
  renderPagination(totalPage);
}

function renderPagination(totalPage) {
  let container = document.getElementById("pagination");

  if (totalPage <= 1) {
    container.innerHTML = "";
    return;
  }

  let html = `<ul class="pagination justify-content-center">`;

  // PREV
  html += `
    <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
        <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Prev</a>
    </li>`;

  // LOOP PAGE (biar tidak kepanjangan)
  let start = Math.max(1, currentPage - 2);
  let end = Math.min(totalPage, currentPage + 2);

  if (start > 1) {
    html += `<li class="page-item"><a class="page-link" onclick="changePage(1)">1</a></li>`;
    if (start > 2)
      html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
  }

  for (let i = start; i <= end; i++) {
    html += `
        <li class="page-item ${i === currentPage ? "active" : ""}">
            <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
        </li>`;
  }

  if (end < totalPage) {
    if (end < totalPage - 1)
      html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;

    html += `<li class="page-item"><a class="page-link" onclick="changePage(${totalPage})">${totalPage}</a></li>`;
  }

  // NEXT
  html += `
    <li class="page-item ${currentPage === totalPage ? "disabled" : ""}">
        <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
    </li>`;

  html += `</ul>`;

  container.innerHTML = html;
}

function changePage(page) {
  let show = parseInt(document.getElementById("showEntries").value);
  let totalPage = Math.ceil(data.length / show);

  if (page < 1) page = 1;
  if (page > totalPage) page = totalPage;

  currentPage = page;
  renderTable();
}

// =========================================== ANIMASI ANGKA ===========================================
function animateTotal(target) {
  let el = document.getElementById("totalText");
  let current = 0;
  let increment = target / 50;

  let interval = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(interval);
    }
    el.innerText = formatRupiah(Math.floor(current));
  }, 20);
}

// ================================================ INIT ================================================
// INIT TAHUN
(function initYear() {
  let select = document.getElementById("filterTahun");
  let now = new Date().getFullYear();

  for (let i = now; i >= 2020; i--) {
    let opt = document.createElement("option");
    opt.value = i;
    opt.text = i;
    select.appendChild(opt);
  }
})();

// =============================================== FILTER ===============================================
document.getElementById("searchInput").addEventListener("keyup", function () {
  currentPage = 1;
  renderTable();
});

document.getElementById("showEntries").addEventListener("change", function () {
  currentPage = 1;
  renderTable();
});

