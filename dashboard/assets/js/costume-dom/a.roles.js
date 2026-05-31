// a.roles

// ========================================== PAGINATION ===========================================
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

function changePage(page) {
  currentPage = page;
  renderTable();
}

// =========================================== TAMBAH DATA ==============================================
function tambahData() {
  let nama = document.getElementById("namaTambah").value.trim();

  // VALIDASI
  if (!nama) {
    document.getElementById("validasiText").innerHTML =
      "Nama role wajib diisi!";

    $("#modalValidasi").modal("show");

    return;
  }

  // DUPLIKAT ROLE
  let exists = data.some((d) => d.nama.toLowerCase() === nama.toLowerCase());

  if (exists) {
    document.getElementById("validasiText").innerHTML =
      `Role <strong>${nama}</strong> sudah tersedia`;

    $("#modalValidasi").modal("show");

    return;
  }

  // PUSH DATA
  data.push({
    nama,
  });

  // RENDER TABLE
  renderTable();

  // CLOSE MODAL TAMBAH
  $("#modalTambah").modal("hide");

  // SUCCESS TEXT
  document.getElementById("successText").innerHTML = `
        Role <strong>${nama}</strong> berhasil ditambahkan
    `;

  // SHOW SUCCESS
  $("#modalSuccess").modal("show");

  // RESET INPUT
  document.getElementById("namaTambah").value = "";
}

// ========================================== EDIT DATA ===========================================
function editData(index) {
  document.getElementById("editIndex").value = index;
  document.getElementById("namaEdit").value = data[index].nama;

  $("#modalEdit").modal("show");
}

// ============================================= UPDATE DATA =============================================
function updateData() {
  let index = document.getElementById("editIndex").value;

  // DATA LAMA
  let namaLama = data[index].nama;

  // DATA BARU
  let namaBaru = document.getElementById("namaEdit").value.trim();

  // VALIDASI KOSONG
  if (!namaBaru) {
    document.getElementById("validasiText").innerHTML =
      "Nama role edit wajib diisi!";

    $("#modalValidasi").modal("show");

    return;
  }

  // VALIDASI DUPLIKAT
  let exists = data.some(
    (d, i) => i != index && d.nama.toLowerCase() === namaBaru.toLowerCase(),
  );

  if (exists) {
    document.getElementById("validasiText").innerHTML =
      `Role <strong>${namaBaru}</strong> sudah tersedia`;

    $("#modalValidasi").modal("show");

    return;
  }

  // UPDATE DATA
  data[index].nama = namaBaru;

  // RENDER TABLE
  renderTable();

  // CLOSE MODAL EDIT
  $("#modalEdit").modal("hide");

  // TITLE SUCCESS
  document.querySelector("#modalSuccess h3").innerHTML = "Role Berhasil Diedit";

  // SUCCESS TEXT
  document.getElementById("successText").innerHTML = `
        Role <strong>${namaLama}</strong>
        telah diedit menjadi
        <strong>${namaBaru}</strong>
    `;

  // SHOW SUCCESS MODAL
  $("#modalSuccess").modal("show");
}

// ============================================ HAPUS DATA =============================================
function hapusData(index) {
  if (confirm("Yakin hapus data ini?")) {
    data.splice(index, 1);
    renderTable();
  }
}

document.getElementById("deleteSelected").onclick = function () {
  let checks = document.querySelectorAll(".rowCheck:checked");

  if (checks.length === 0) {
    alert("Pilih data dulu!");
    return;
  }

  if (confirm("Hapus data terpilih?")) {
    let indexes = [...checks].map((c) => c.dataset.index).sort((a, b) => b - a);
    indexes.forEach((i) => data.splice(i, 1));
    renderTable();
  }
};

document.getElementById("checkAll").onclick = function () {
  document
    .querySelectorAll(".rowCheck")
    .forEach((c) => (c.checked = this.checked));
};

document.getElementById("searchInput").onkeyup = renderTable;

document.getElementById("showEntries").onchange = function () {
  rowsPerPage = parseInt(this.value);
  currentPage = 1;
  renderTable();
};

renderTable();
