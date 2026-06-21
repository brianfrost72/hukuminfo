// m.department
// ============================================== JS DOM ==============================================
let data = [
  {
    nama: "HR",
  },
  {
    nama: "Admin",
  },
];

let currentPage = 1;
let rowsPerPage = 5;

function renderTable() {
  let tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  let search = document.getElementById("searchInput").value.toLowerCase();

  let filtered = data.filter((d) => d.nama.toLowerCase().includes(search));

  let start = (currentPage - 1) * rowsPerPage;
  let paginated = filtered.slice(start, start + rowsPerPage);

  paginated.forEach((item, index) => {
    tbody.innerHTML += `
            <tr>
                <td><input type="checkbox" class="rowCheck" data-index="${start + index}"></td>
                <td>${start + index + 1}</td>
                <td>${item.nama}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData(${start + index})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="hapusData(${start + index})">Hapus</button>
                </td>
            </tr>
        `;
  });

  renderPagination(filtered.length);
}

// ======================================= PAGINATION =======================================
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

// =========================================== TAMBAH DATA ============================================
function tambahData() {
  let input = document.getElementById("departemenTambah");
  let nama = input.value.trim();

  // VALIDASI
  if (nama === "") {
    document.getElementById("validasiText").innerHTML =
      "Nama departemen wajib diisi";

    $("#modalValidasi").modal("show");

    input.focus();

    return;
  }

  // DUPLIKAT
  let exists = data.some((d) => d.nama.toLowerCase() === nama.toLowerCase());

  if (exists) {
    document.getElementById("validasiText").innerHTML =
      `Departemen <strong>${nama}</strong> sudah tersedia`;

    $("#modalValidasi").modal("show");

    return;
  }

  // TAMBAH DATA
  data.push({
    nama,
  });

  // REFRESH TABLE
  renderTable();

  // CLOSE MODAL
  $("#modalTambah").modal("hide");

  // SUCCESS TITLE
  document.getElementById("successTitle").innerHTML = "Tambah Berhasil";

  // SUCCESS TEXT
  document.getElementById("successText").innerHTML = `
        <strong>${nama}</strong> berhasil ditambahkan
    `;

  // SHOW MODAL
  $("#modalSuccess").modal("show");

  // RESET
  input.value = "";

  document.getElementById("checkAll").checked = false;
}

// =========================================== EDIT DATA ===========================================
function editData(index) {
  document.getElementById("editIndex").value = index;
  document.getElementById("departemenEdit").value = data[index].nama;

  $("#modalEdit").modal("show");
}

// =========================================== UPDATE DATA ===========================================
function updateData() {
  let index = document.getElementById("editIndex").value;

  let input = document.getElementById("departemenEdit");
  let nama = input.value.trim();

  // VALIDASI
  if (nama === "") {
    document.getElementById("validasiText").innerHTML =
      "Nama departemen edit wajib diisi";

    $("#modalValidasi").modal("show");

    input.focus();

    return;
  }

  // DUPLIKAT
  let exists = data.some(
    (d, i) => i != index && d.nama.toLowerCase() === nama.toLowerCase(),
  );

  if (exists) {
    document.getElementById("validasiText").innerHTML =
      `Departemen <strong>${nama}</strong> sudah tersedia`;

    $("#modalValidasi").modal("show");

    return;
  }

  // UPDATE
  data[index].nama = nama;

  // REFRESH TABLE
  renderTable();

  // CLOSE
  $("#modalEdit").modal("hide");

  // TITLE
  document.getElementById("successTitle").innerHTML = "Edit Berhasil";

  // TEXT
  document.getElementById("successText").innerHTML = `
        <strong>${nama}</strong> berhasil di edit
    `;

  // SHOW
  $("#modalSuccess").modal("show");

  document.getElementById("checkAll").checked = false;
}

// =========================================== HAPUS DATA ===========================================
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
