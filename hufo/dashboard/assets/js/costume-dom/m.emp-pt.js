// m.emp-pt
// =========================================== FORMAT RUPIAH ===========================================
// FORMAT RUPIAH
function formatRupiah(angka) {
  let number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  return rupiah ? "Rp " + rupiah : "";
}

// AMBIL ANGKA
function getNumber(value) {
  return parseInt(value.replace(/[^0-9]/g, "")) || 0;
}

// INPUT
const pendapatanInputs = document.querySelectorAll(".pendapatan-input");
const potonganInputs = document.querySelectorAll(".potongan-input");

// TOTAL
const totalPendapatan = document.getElementById("totalPendapatan");
const totalPotongan = document.getElementById("totalPotongan");

const summaryPendapatan = document.getElementById("summaryPendapatan");
const summaryPotongan = document.getElementById("summaryPotongan");

const takeHomePay = document.getElementById("takeHomePay");

// FORMAT INPUT
document.querySelectorAll(".rupiah-input").forEach((input) => {
  input.setAttribute("type", "text");

  input.addEventListener("input", function () {
    let angka = this.value.replace(/[^0-9]/g, "");
    this.value = formatRupiah(angka);

    hitungTotal();
  });
});

// HITUNG TOTAL
function hitungTotal() {
  let totalP = 0;
  let totalPot = 0;

  pendapatanInputs.forEach((input) => {
    totalP += getNumber(input.value);
  });

  potonganInputs.forEach((input) => {
    totalPot += getNumber(input.value);
  });

  let takeHome = totalP - totalPot;

  totalPendapatan.innerHTML = formatRupiah(totalP.toString());
  totalPotongan.innerHTML = formatRupiah(totalPot.toString());

  summaryPendapatan.innerHTML = formatRupiah(totalP.toString());
  summaryPotongan.innerHTML = formatRupiah(totalPot.toString());

  takeHomePay.innerHTML = formatRupiah(takeHome.toString());
}

// RESET
document.querySelector(".btn-light").addEventListener("click", function () {
  document.querySelectorAll(".rupiah-input").forEach((input) => {
    input.value = "";
  });

  document.querySelector("textarea").value = "";

  totalPendapatan.innerHTML = "Rp 0";
  totalPotongan.innerHTML = "Rp 0";

  summaryPendapatan.innerHTML = "Rp 0";
  summaryPotongan.innerHTML = "Rp 0";

  takeHomePay.innerHTML = "Rp 0";
});

// ======================================== PENJUMLAHAN ========================================
// DATA
let payrollData = [];

// DUMMY DATA
for (let i = 1; i <= 120; i++) {
  payrollData.push({
    nama: "Karyawan " + i,
    divisi: i % 3 == 0 ? "Finance" : i % 2 == 0 ? "IT" : "Marketing",

    periode: i % 2 == 0 ? "2025-05" : "2025-06",

    tanggal: "31/05/2025",

    total: 8000000 + i * 10000,

    potongan: 1000000,
  });
}

// ==================================== FILTER + PAGINATION + RENDER TABLE ==========================
// ELEMENT
const tableBody = document.getElementById("tableBody");
const showEntries = document.getElementById("showEntries");
const filterDivisi = document.getElementById("filterDivisi");
const filterPeriode = document.getElementById("filterPeriode");
const searchInput = document.getElementById("searchInput");

const pagination = document.getElementById("pagination");
const paginationInfo = document.getElementById("paginationInfo");

// PAGE
let currentPage = 1;

// FORMAT RUPIAH
function rupiah(number) {
  return "Rp " + number.toLocaleString("id-ID");
}

// RENDER TABLE
function renderTable(page = 1) {
  currentPage = page;

  let search = searchInput.value.toLowerCase();
  let divisi = filterDivisi.value;
  let periode = filterPeriode.value;
  let limit = parseInt(showEntries.value);

  // FILTER
  let filtered = payrollData.filter((item) => {
    let matchSearch = item.nama.toLowerCase().includes(search);

    let matchDivisi = divisi === "" || item.divisi === divisi;

    let matchPeriode = periode === "" || item.periode === periode;

    return matchSearch && matchDivisi && matchPeriode;
  });

  // TOTAL PAGE
  let totalPages = Math.ceil(filtered.length / limit);

  // START
  let start = (page - 1) * limit;

  // END
  let end = start + limit;

  // SLICE
  let paginated = filtered.slice(start, end);

  // RESET
  tableBody.innerHTML = "";

  // EMPTY
  if (paginated.length === 0) {
    tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">
                        Data tidak ditemukan
                    </td>
                </tr>
            `;

    pagination.innerHTML = "";
    paginationInfo.innerHTML = "";

    return;
  }

  // LOOP
  paginated.forEach((item, index) => {
    let takeHome = item.total - item.potongan;

    let periodeText = new Date(item.periode + "-01").toLocaleDateString(
      "id-ID",
      {
        month: "long",
        year: "numeric",
      },
    );

    tableBody.innerHTML += `
                <tr>

                    <td>${start + index + 1}</td>

                    <td>${item.nama}</td>

                    <td>${item.divisi}</td>

                    <td>${periodeText}</td>

                    <td>${item.tanggal}</td>

                    <td class="text-success">
                        ${rupiah(item.total)}
                    </td>

                    <td class="text-danger">
                        ${rupiah(item.potongan)}
                    </td>

                    <td class="text-primary">
                        ${rupiah(takeHome)}
                    </td>

                    <td>

                        <button class="btn btn-sm btn-primary"
        onclick="viewPayroll(${index})">

    View

</button>

                       <button class="btn btn-sm btn-danger"
        onclick="hapusPayroll(${start + index})">

    Hapus

</button>

                    </td>

                </tr>
            `;
  });

  // INFO
  paginationInfo.innerHTML = `
            Menampilkan
            ${start + 1}
            sampai
            ${Math.min(end, filtered.length)}
            dari
            ${filtered.length} data
        `;

  renderPagination(totalPages, page);
}

// PAGINATION
function renderPagination(totalPages, currentPage) {
  pagination.innerHTML = "";

  // BUTTON
  function createButton(page) {
    return `
                <button
                    onclick="renderTable(${page})"
                    class="pagination-btn ${page === currentPage ? "active" : ""}">
                    ${page}
                </button>
            `;
  }

  // FIRST
  for (let i = 1; i <= Math.min(3, totalPages); i++) {
    pagination.innerHTML += createButton(i);
  }

  // DOTS START
  if (currentPage > 5) {
    pagination.innerHTML += `
                <span class="pagination-dots">
                    ...
                </span>
            `;
  }

  // MIDDLE
  let startPage = Math.max(4, currentPage - 1);
  let endPage = Math.min(totalPages - 3, currentPage + 1);

  for (let i = startPage; i <= endPage; i++) {
    pagination.innerHTML += createButton(i);
  }

  // DOTS END
  if (currentPage < totalPages - 4) {
    pagination.innerHTML += `
                <span class="pagination-dots">
                    ...
                </span>
            `;
  }

  // LAST
  for (let i = Math.max(totalPages - 2, 4); i <= totalPages; i++) {
    pagination.innerHTML += createButton(i);
  }
}

// EVENTS
showEntries.addEventListener("change", () => {
  renderTable(1);
});

filterDivisi.addEventListener("change", () => {
  renderTable(1);
});

filterPeriode.addEventListener("input", () => {
  renderTable(1);
});

searchInput.addEventListener("input", () => {
  renderTable(1);
});

// FIRST LOAD
renderTable();

// ========================================== HAPUS PAYROLL ==========================================
function hapusPayroll(index) {
  // AMBIL DATA
  let item = payrollData[index];

  // VALIDASI
  let konfirmasi = confirm(
    "Yakin ingin menghapus data penggajian:\n\n" + item.nama + " ?",
  );

  // CANCEL
  if (!konfirmasi) {
    return;
  }

  // HAPUS DATA
  payrollData.splice(index, 1);

  // TUTUP DETAIL JIKA TERBUKA
  document.getElementById("detailPayrollCard").style.display = "none";

  // REFRESH TABLE
  renderTable(currentPage);

  // ALERT
  alert("Data berhasil dihapus!");
}

// ========================================== EDIT DATA ==========================================
let currentEditIndex = null;
let editMode = false;

// VIEW DETAIL
function viewPayroll(realIndex) {
  currentEditIndex = realIndex;

  let item = payrollData[realIndex];

  // SHOW CARD
  document.getElementById("detailPayrollCard").style.display = "block";

  // TOP
  document.getElementById("detailNama").value = item.nama;

  document.getElementById("detailPeriode").value = item.periode;

  // FORMAT DATE
  let splitDate = item.tanggal.split("/");

  let formatDate = splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0];

  document.getElementById("detailTanggal").value = formatDate;

  // METODE
  document.getElementById("detailMetode").value =
    item.metode || "Transfer Bank";

  // PENDAPATAN
  detailGaji.value = rupiah(item.gaji || 5000000);

  detailTunjangan.value = rupiah(item.tunjangan || 1000000);

  detailBonus.value = rupiah(item.bonus || 1000000);

  detailLembur.value = rupiah(item.lembur || 500000);

  // POTONGAN
  detailBPJS.value = rupiah(item.bpjs || 300000);

  detailBPJSTK.value = rupiah(item.bpjstk || 200000);

  detailPPH.value = rupiah(item.pph || 500000);

  detailLain.value = rupiah(item.lain || 0);

  // CATATAN
  detailCatatan.value = item.catatan || "";

  // HITUNG TOTAL
  hitungDetailTotal();

  // DEFAULT LOCK
  lockEditMode();

  // BUTTON RESET
  document.getElementById("btnEditPayroll").innerHTML = "Edit";

  document.getElementById("btnEditPayroll").classList.remove("btn-success");

  document.getElementById("btnEditPayroll").classList.add("btn-warning");

  document.getElementById("btnCancelEdit").style.display = "none";

  editMode = false;

  // SCROLL
  document.getElementById("detailPayrollCard").scrollIntoView({
    behavior: "smooth",
  });
}

// LOCK EDIT
function lockEditMode() {
  // JANGAN EDIT
  detailNama.readOnly = true;
  detailPeriode.readOnly = true;

  // BOLEH EDIT
  detailTanggal.readOnly = true;

  detailMetode.disabled = true;

  detailGaji.readOnly = true;
  detailTunjangan.readOnly = true;
  detailBonus.readOnly = true;
  detailLembur.readOnly = true;

  detailBPJS.readOnly = true;
  detailBPJSTK.readOnly = true;
  detailPPH.readOnly = true;
  detailLain.readOnly = true;

  detailCatatan.readOnly = true;
}

// UNLOCK EDIT
function unlockEditMode() {
  // TETAP LOCK
  detailNama.readOnly = true;
  detailPeriode.readOnly = true;

  // BOLEH EDIT
  detailTanggal.readOnly = false;

  detailMetode.disabled = false;

  detailGaji.readOnly = false;
  detailTunjangan.readOnly = false;
  detailBonus.readOnly = false;
  detailLembur.readOnly = false;

  detailBPJS.readOnly = false;
  detailBPJSTK.readOnly = false;
  detailPPH.readOnly = false;
  detailLain.readOnly = false;

  detailCatatan.readOnly = false;
}

// TOTAL DETAIL
function hitungDetailTotal() {
  let totalPendapatan =
    getNumber(detailGaji.value) +
    getNumber(detailTunjangan.value) +
    getNumber(detailBonus.value) +
    getNumber(detailLembur.value);

  let totalPotongan =
    getNumber(detailBPJS.value) +
    getNumber(detailBPJSTK.value) +
    getNumber(detailPPH.value) +
    getNumber(detailLain.value);

  let takeHome = totalPendapatan - totalPotongan;

  // UPDATE UI
  detailTotalPendapatan.innerHTML = rupiah(totalPendapatan);

  detailTotalPotongan.innerHTML = rupiah(totalPotongan);

  summaryPendapatanView.innerHTML = rupiah(totalPendapatan);

  summaryPotonganView.innerHTML = rupiah(totalPotongan);

  summaryTakeHomeView.innerHTML = rupiah(takeHome);
}

// FORMAT INPUT EDIT
document.querySelectorAll(".detail-rupiah").forEach((input) => {
  input.addEventListener("input", function () {
    // HANYA ANGKA
    let angka = this.value.replace(/[^0-9]/g, "");

    // FORMAT RP
    this.value = formatRupiah(angka);

    // UPDATE TOTAL
    hitungDetailTotal();
  });
});

// TOGGLE EDIT
function toggleEditPayroll() {
  let btn = document.getElementById("btnEditPayroll");

  // EDIT MODE
  if (!editMode) {
    editMode = true;

    unlockEditMode();

    btn.innerHTML = "Simpan";

    btn.classList.remove("btn-warning");

    btn.classList.add("btn-success");

    btnCancelEdit.style.display = "inline-block";
  }

  // SAVE
  else {
    let item = payrollData[currentEditIndex];

    // SAVE
    item.tanggal = detailTanggal.value.split("-").reverse().join("/");

    item.metode = detailMetode.value;

    item.gaji = getNumber(detailGaji.value);

    item.tunjangan = getNumber(detailTunjangan.value);

    item.bonus = getNumber(detailBonus.value);

    item.lembur = getNumber(detailLembur.value);

    item.bpjs = getNumber(detailBPJS.value);

    item.bpjstk = getNumber(detailBPJSTK.value);

    item.pph = getNumber(detailPPH.value);

    item.lain = getNumber(detailLain.value);

    item.catatan = detailCatatan.value;

    // TOTAL
    item.total = item.gaji + item.tunjangan + item.bonus + item.lembur;

    item.potongan = item.bpjs + item.bpjstk + item.pph + item.lain;

    // LOCK
    lockEditMode();

    // BUTTON
    editMode = false;

    btn.innerHTML = "Edit";

    btn.classList.remove("btn-success");

    btn.classList.add("btn-warning");

    btnCancelEdit.style.display = "none";

    // REFRESH
    renderTable(currentPage);

    // REFRESH DETAIL
    viewPayroll(currentEditIndex);

    alert("Data berhasil diperbarui!");
  }
}

// CANCEL
function cancelEditPayroll() {
  editMode = false;

  viewPayroll(currentEditIndex);
}

function closeDetailPayroll() {
  // HIDE CARD
  document.getElementById("detailPayrollCard").style.display = "none";

  // RESET EDIT MODE
  editMode = false;

  // RESET BUTTON
  document.getElementById("btnEditPayroll").innerHTML = "Edit";

  document.getElementById("btnEditPayroll").classList.remove("btn-success");

  document.getElementById("btnEditPayroll").classList.add("btn-warning");

  // HIDE CANCEL
  document.getElementById("btnCancelEdit").style.display = "none";

  // LOCK INPUT
  lockEditMode();
}

// ========================================= TAMBAH DATA ========================================
// SIMPAN PAYROLL
document
  .getElementById("btnSimpanPayroll")
  .addEventListener("click", function () {
    let nama = document.querySelector("select.form-control").value;

    // VALIDASI
    if (nama === "Pilih Karyawan") {
      alert("Silakan pilih karyawan!");
      return;
    }

    // AMBIL DATA
    let periode = document.querySelector('input[type="month"]').value;
    let tanggal = document.querySelector('input[type="date"]').value;

    let totalPendapatanValue = getNumber(
      document.getElementById("summaryPendapatan").innerText,
    );

    let totalPotonganValue = getNumber(
      document.getElementById("summaryPotongan").innerText,
    );

    // PUSH DATA
    payrollData.unshift({
      nama: nama,
      divisi: "Marketing",

      periode: periode,

      tanggal: tanggal.split("-").reverse().join("/"),

      total: totalPendapatanValue,

      potongan: totalPotonganValue,
    });

    // REFRESH TABLE
    renderTable(1);

    // MODAL SUCCESS
    document.getElementById("modalSuccessTitle").innerText = "Simpan Berhasil";

    document.getElementById("modalSuccessText").innerHTML =
      `<b>${nama}</b> berhasil disimpan`;

    $("#modalSuccess").modal("show");
  });

// OPEN MODAL RESET
document
  .getElementById("btnResetPayroll")
  .addEventListener("click", function () {
    $("#modalReset").modal("show");
  });

// CONFIRM RESET
document
  .getElementById("btnConfirmReset")
  .addEventListener("click", function () {
    // RESET INPUT
    document.querySelectorAll(".rupiah-input").forEach((input) => {
      input.value = "";
    });

    // RESET TEXTAREA
    document.querySelector("textarea").value = "";

    // RESET TOTAL
    totalPendapatan.innerHTML = "Rp 0";
    totalPotongan.innerHTML = "Rp 0";

    summaryPendapatan.innerHTML = "Rp 0";
    summaryPotongan.innerHTML = "Rp 0";

    takeHomePay.innerHTML = "Rp 0";

    // CLOSE MODAL
    $("#modalReset").modal("hide");

    // SHOW SUCCESS
    document.getElementById("modalSuccessTitle").innerText = "Reset Berhasil";

    document.getElementById("modalSuccessText").innerHTML =
      `Form payroll berhasil di reset`;

    $("#modalSuccess").modal("show");
  });
