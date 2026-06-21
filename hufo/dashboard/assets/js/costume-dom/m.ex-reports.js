// m.ex-reports


// ========================================= DATA TAMBAH ==========================================
function addData() {
  let tanggalEl = document.getElementById("tanggal");
  let typePengeluaranEl = document.getElementById("typePengeluaran");
  let judulPengeluaranEl = document.getElementById("judulPengeluaran");
  let jumlahEl = document.getElementById("jumlah");
  let deskripsiEl = document.getElementById("deskripsi");
  let fileEl = document.getElementById("file");

  let tanggal = tanggalEl.value;
  let typePengeluaran = typePengeluaranEl.value;
  let judulPengeluaran = judulPengeluaranEl.value;
  let deskripsi = deskripsiEl.value;

  let jumlahRaw = jumlahEl.value.replace(/[^0-9]/g, "");
  let jumlah = parseInt(jumlahRaw);

  if (!tanggal || isNaN(jumlah)) {
    alert("Isi data dengan benar!");
    return;
  }

  let file = fileEl.files[0];

  data.push({
    tanggal,
    typePengeluaran,
    judulPengeluaran,
    jumlah,
    deskripsi,
    file: file,
    fileURL: file ? URL.createObjectURL(file) : null,
  });

  renderTable();

  // RESET
  tanggalEl.value = "";
  typePengeluaranEl.selectedIndex = 0;
  judulPengeluaranEl.value = "";
  jumlahEl.value = "";
  deskripsiEl.value = "";
  fileEl.value = "";

  tanggalEl.focus();

  alert("Data berhasil ditambahkan!");
}

function getTypeInfo(type) {
  const info = {
    opex: "Biaya operasional harian bisnis",
    non: "Biaya di luar operasional utama",
    capex: "Investasi jangka panjang",
    fixed: "Biaya tetap tiap bulan",
    variable: "Biaya berubah sesuai aktivitas",
  };

  return info[type] || "-";
}

// =========================================== EDIT DATA ============================================
// EDIT MODAL
function openEdit(index) {
  let d = data[index];

  document.getElementById("editIndex").value = index;
  document.getElementById("editTanggal").value = d.tanggal;
  document.getElementById("editSumber").value = d.sumber;
  document.getElementById("editJumlah").value = formatRupiah(d.jumlah);
  document.getElementById("editMetode").value = d.metode;

  // PREVIEW FILE LAMA
  let oldPreview = document.getElementById("oldPreview");

  if (d.fileURL) {
    if (d.file.type.includes("image")) {
      oldPreview.innerHTML = `<img src="${d.fileURL}" width="120">`;
    } else {
      oldPreview.innerHTML = `<a href="${d.fileURL}" target="_blank">Lihat PDF Lama</a>`;
    }
  } else {
    oldPreview.innerHTML = "Tidak ada file";
  }

  // PREVIEW FILE BARU
  document.getElementById("editFile").onchange = function (e) {
    let file = e.target.files[0];
    let preview = document.getElementById("newPreview");

    if (!file) return;

    let url = URL.createObjectURL(file);

    if (file.type.includes("image")) {
      preview.innerHTML = `<img src="${url}" width="120">`;
    } else {
      preview.innerHTML = `<span>PDF siap diupload</span>`;
    }
  };

  $("#editModal").modal("show");
}

// ============================================ UPDATE DATA ============================================
// UPDATE DATA
function updateData() {
  let index = document.getElementById("editIndex").value;

  let jumlahRaw = document
    .getElementById("editJumlah")
    .value.replace(/[^0-9]/g, "");
  let jumlah = parseInt(jumlahRaw);

  data[index].tanggal = document.getElementById("editTanggal").value;
  data[index].sumber = document.getElementById("editSumber").value;
  data[index].jumlah = jumlah;
  data[index].metode = document.getElementById("editMetode").value;

  let file = document.getElementById("editFile").files[0];

  if (file) {
    data[index].file = file;
    data[index].fileURL = URL.createObjectURL(file);
  }

  $("#editModal").modal("hide");
  renderTable();
}

// ============================================ DELETE DATA ============================================
// DELETE DATA
function deleteData(index) {
  let confirmDelete = confirm("Yakin ingin menghapus data ini?");

  if (!confirmDelete) return;

  data.splice(index, 1);

  alert("Data berhasil dihapus!");
  renderTable();
}



// ======================================== RENDER + PAGINATION =========================================
function renderTable() {
  let tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  let search = document.getElementById("searchInput").value.toLowerCase();
  let show = parseInt(document.getElementById("showEntries").value);
  let bulan = document.getElementById("filterBulan").value;
  let tahun = document.getElementById("filterTahun").value;

  // ================= FILTER =================
  let filtered = data.filter((d) => {
    let tgl = new Date(d.tanggal);

    let cocokSearch =
      d.judulPengeluaran.toLowerCase().includes(search) ||
      d.typePengeluaran.toLowerCase().includes(search);

    let cocokBulan = bulan === "" || tgl.getMonth() == bulan;
    let cocokTahun = tahun === "" || tgl.getFullYear() == tahun;

    return cocokSearch && cocokBulan && cocokTahun;
  });

  // ================= PAGINATION =================
  let totalData = filtered.length;
  let totalPage = Math.ceil(totalData / show);

  if (currentPage > totalPage) currentPage = totalPage || 1;

  let start = (currentPage - 1) * show;
  let paginated = filtered.slice(start, start + show);

  // ================= TOTAL =================
  let totalPengeluaran = filtered.reduce((a, b) => a + b.jumlah, 0);
  let sisaSaldo = totalPendapatanGlobal - totalPengeluaran;

  // animasi semua
  animateValue("totalPendapatanText", totalPendapatanGlobal);
  animateValue("totalPengeluaranText", totalPengeluaran);
  animateValue("sisaSaldoText", sisaSaldo);

  // ================= PAGINATION =================
  renderPagination(totalPage);
}



