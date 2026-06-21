// m.dep-rep
// ===================================== DOM JS + JUMLAHAN =====================================
// ================= STATE =================
let pageMasuk = 1;
let pageKeluar = 1;

// ================= DATA =================
let pemasukan = [
  {
    tanggal: "2024-05-02",
    kategori: "Penjualan",
    sumber: "PT A",
    jumlah: 25000000,
    metode: "Transfer",
    bukti: "file.jpg",
  },
  {
    tanggal: "2024-05-10",
    kategori: "Lain-lain",
    sumber: "CV B",
    jumlah: 15000000,
    metode: "Cash",
    bukti: "file.pdf",
  },
];

let pengeluaran = [
  {
    tanggal: "2024-05-03",
    type: "Opex",
    judul: "ATK",
    jumlah: 750000,
    deskripsi: "Beli alat",
    bukti: "file.jpg",
  },
  {
    tanggal: "2024-05-08",
    type: "Non-Opex",
    judul: "Laptop",
    jumlah: 10000000,
    deskripsi: "Pembelian asset",
    bukti: "file.pdf",
  },
];

// ================= HELPER =================
function rupiah(angka) {
  return "Rp. " + angka.toLocaleString("id-ID");
}

// ================= ANIMATION =================
function animateValue(id, start, end, duration) {
  let current = start;
  let increment = end / (duration / 16);
  let obj = document.getElementById(id);

  let timer = setInterval(() => {
    current += increment;
    if (current >= end) {
      current = end;
      clearInterval(timer);
    }
    obj.innerText = rupiah(Math.floor(current));
  }, 16);
}

// ================= TOTAL =================
function hitungTotal() {
  let totalMasuk = pemasukan.reduce((a, b) => a + b.jumlah, 0);
  let totalKeluar = pengeluaran.reduce((a, b) => a + b.jumlah, 0);

  animateValue("totalDeposit", 0, totalMasuk, 1000);
  animateValue("totalPengeluaran", 0, totalKeluar, 1000);
}

// ======================================= PREVIEW + PAGINATION ========================================
// ================= PREVIEW =================
function previewImage(src) {
  document.getElementById("previewImg").src = src;
  document.getElementById("previewModal").style.display = "flex";
}

document.getElementById("previewModal").onclick = function () {
  this.style.display = "none";
};

// ================= PAGINATION =================
function changePage(type, page) {
  if (page < 1) return;

  if (type === "masuk") {
    pageMasuk = page;
    renderMasuk();
  } else {
    pageKeluar = page;
    renderKeluar();
  }
}

function renderPagination(containerId, totalPage, currentPage, type) {
  let el = document.getElementById(containerId);
  let html = "";

  let prevDisabled = currentPage === 1 ? "disabled" : "";
  let nextDisabled = currentPage === totalPage ? "disabled" : "";

  html += `<button class="pagination-btn ${prevDisabled}" 
    ${prevDisabled ? "" : `onclick="changePage('${type}', ${currentPage - 1})"`}>
    Prev
  </button>`;

  for (let i = 1; i <= totalPage; i++) {
    html += `<button 
      class="pagination-btn ${i === currentPage ? "active" : ""}"
      onclick="changePage('${type}', ${i})">${i}</button>`;
  }

  html += `<button class="pagination-btn ${nextDisabled}" 
    ${nextDisabled ? "" : `onclick="changePage('${type}', ${currentPage + 1})"`}>
    Next
  </button>`;

  el.innerHTML = html;
}

// ==================================== RENDER MASUK + KELUAR =====================================
// ================= RENDER MASUK =================
function renderMasuk() {
  let tbody = document.getElementById("tableMasuk");
  let search = document.getElementById("searchMasuk").value.toLowerCase();
  let bulan = document.getElementById("filterBulanMasuk").value;
  let tahun = document.getElementById("filterTahunMasuk").value;

  let filtered = pemasukan.filter((d) => {
    let tgl = new Date(d.tanggal);
    return (
      (d.kategori.toLowerCase().includes(search) ||
        d.sumber.toLowerCase().includes(search)) &&
      (bulan === "" || tgl.getMonth() + 1 == bulan) &&
      (tahun === "" || tgl.getFullYear() == tahun)
    );
  });

  let limit = parseInt(document.getElementById("entriesMasuk").value);
  let totalPage = Math.ceil(filtered.length / limit) || 1;

  if (pageMasuk > totalPage) pageMasuk = totalPage;

  let start = (pageMasuk - 1) * limit;
  let data = filtered.slice(start, start + limit);

  tbody.innerHTML = "";

  data.forEach((d) => {
    let fileName = d.bukti.split("/").pop();
    tbody.innerHTML += `
      <tr>
        <td>${d.tanggal}</td>
        <td>${d.kategori}</td>
        <td>${d.sumber}</td>
        <td class="text-success">${rupiah(d.jumlah)}</td>
        <td>${d.metode}</td>
        <td>
  ${
    d.bukti.endsWith(".pdf")
      ? `<a href="${d.bukti}" target="_blank" style="display:flex; align-items:center; gap:5px;">
         <span class="material-icons text-danger">picture_as_pdf</span>
         <span>${fileName}</span>
       </a>`
      : `<div style="display:flex; align-items:center; gap:5px; cursor:pointer;" onclick="previewImage('${d.bukti}')">
         <span class="material-icons text-primary">image</span>
         <span>${fileName}</span>
       </div>`
  }
</td>
      </tr>
    `;
  });

  renderPagination("paginationMasuk", totalPage, pageMasuk, "masuk");

  if (filtered.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>`;

    renderPagination("paginationMasuk", 1, 1, "masuk"); // tetap tampil tapi disabled
    return;
  }
}

// ================= RENDER KELUAR =================
function renderKeluar() {
  let tbody = document.getElementById("tableKeluar");
  let search = document.getElementById("searchKeluar").value.toLowerCase();
  let type = document.getElementById("filterTypeKeluar").value;

  let filtered = pengeluaran.filter(
    (d) =>
      d.judul.toLowerCase().includes(search) &&
      (type === "" || d.type === type),
  );

  let limit = parseInt(document.getElementById("entriesKeluar").value);
  let totalPage = Math.ceil(filtered.length / limit) || 1;

  if (pageKeluar > totalPage) pageKeluar = totalPage;

  let start = (pageKeluar - 1) * limit;
  let data = filtered.slice(start, start + limit);

  tbody.innerHTML = "";

  data.forEach((d) => {
    let fileName = d.bukti.split("/").pop();
    tbody.innerHTML += `
      <tr>
        <td>${d.tanggal}</td>
        <td>${d.type}</td>
        <td>${d.judul}</td>
        <td class="text-danger">${rupiah(d.jumlah)}</td>
        <td>${d.deskripsi}</td>
        <td>
  ${
    d.bukti.endsWith(".pdf")
      ? `<a href="${d.bukti}" target="_blank" style="display:flex; align-items:center; gap:5px;">
         <span class="material-icons text-danger">picture_as_pdf</span>
         <span>${fileName}</span>
       </a>`
      : `<div style="display:flex; align-items:center; gap:5px; cursor:pointer;" onclick="previewImage('${d.bukti}')">
         <span class="material-icons text-primary">image</span>
         <span>${fileName}</span>
       </div>`
  }
</td>
      </tr>
    `;
  });

  renderPagination("paginationKeluar", totalPage, pageKeluar, "keluar");

  if (filtered.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>`;

    renderPagination("paginationKeluar", 1, 1, "keluar"); // tetap tampil tapi disabled
    return;
  }
}

// ============================================ EVENT INIT =============================================
// ================= EVENT =================
document.querySelectorAll("input, select").forEach((el) => {
  el.addEventListener("change", () => {
    pageMasuk = 1;
    pageKeluar = 1;
    renderMasuk();
    renderKeluar();
  });

  el.addEventListener("keyup", () => {
    pageMasuk = 1;
    pageKeluar = 1;
    renderMasuk();
    renderKeluar();
  });
});

// ================= INIT =================
hitungTotal();
renderMasuk();
renderKeluar();
