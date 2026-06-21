// m.emp
// ============================================= JS DOM =============================================
let data = [
  {
    nik: "1234567890",
    nama: "Brian",
    tempatlahir: "Jakarta",
    tanggallahir: "1990-01-01",
    email: "brian@mail.com",
    telepon: "08123456789",
    gender: "Laki-laki",
    status: "Sudah Menikah",
    department: "HR",
    jabatan: "Admin",
    ktp: "1234567890123456",
    kta: "987654321",
    npwp: "1234567890",
    bpjs: "1234567890",
    bpjsTK: "1234567890",
    rekening: "1234567890",
    alamat: "Jakarta",
    photo: "",
  },
  {
    nik: "1234567891",
    nama: "Steven",
    tempatlahir: "Bandung",
    tanggallahir: "1990-01-01",
    email: "steven@mail.com",
    telepon: "08123456789",
    gender: "Laki-laki",
    status: "Belum Menikah",
    department: "IT",
    jabatan: "HR",
    ktp: "0987654321098765",
    kta: "123456789",
    npwp: "0987654321",
    bpjs: "0987654321",
    bpjsTK: "0987654321",
    rekening: "0987654321",
    alamat: "Bandung",
    photo: "",
  },
];

let currentPage = 1;
let rowsPerPage = 5;

function renderTable() {
  let tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  let search = document.getElementById("searchInput").value.toLowerCase();
  let filterDept = document
    .getElementById("filterDepartment")
    .value.toLowerCase();
  let filterJabatan = document
    .getElementById("filterJabatan")
    .value.toLowerCase();
  let filterGender = document
    .getElementById("filterGender")
    .value.toLowerCase();

  // FILTER DATA
  let filtered = data.filter((d) => {
    let nama = (d.nama || "").toLowerCase();
    let gender = (d.gender || "").toLowerCase();
    let department = (d.department || "").toLowerCase();
    let jabatan = (d.jabatan || "").toLowerCase();

    // SEARCH GLOBAL
    let matchSearch =
      nama.includes(search) ||
      gender.includes(search) ||
      department.includes(search) ||
      jabatan.includes(search);

    // FILTER DEPARTEMEN
    let matchDept = filterDept === "" || department === filterDept;

    // FILTER JABATAN
    let matchJabatan = filterJabatan === "" || jabatan === filterJabatan;

    // FILTER GENDER
    let matchGender = filterGender === "" || gender.includes(filterGender);

    return matchSearch && matchDept && matchJabatan && matchGender;
  });

  // PAGINATION
  let start = (currentPage - 1) * rowsPerPage;
  let paginated = filtered.slice(start, start + rowsPerPage);

  // RENDER TABLE
  paginated.forEach((item, index) => {
    tbody.innerHTML += `
<tr>
    <td>
        <input type="checkbox" class="rowCheck" data-index="${start + index}">
    </td>

    <td>${start + index + 1}</td>

    <td>${item.nik || "-"}</td>

    <td class="d-flex align-items-center">
        <img src="${item.photo || "../assets/images/avatars/foto-sushi-128246.jpg"}"
             class="rounded-circle mr-2"
             width="40" height="40"
             style="object-fit:cover;">
        ${item.nama || "-"}
    </td>

    <td>${item.gender || "-"}</td>
    <td>${item.department || "-"}</td>
    <td>${item.jabatan || "-"}</td>

    <td>
        <button class="btn btn-info btn-sm" onclick="viewData(${start + index})">
            <i class="material-icons">remove_red_eye</i>
        </button>

        <button class="btn btn-warning btn-sm" onclick="editData(${start + index})">
            <i class="material-icons">edit</i>
        </button>

        <button class="btn btn-danger btn-sm" onclick="hapusData(${start + index})">
            <i class="material-icons">delete</i>
        </button>
    </td>
</tr>
`;
  });

  renderPagination(filtered.length);
}

document.getElementById("filterDepartment").onchange = function () {
  currentPage = 1;
  renderTable();
};

document.getElementById("filterJabatan").onchange = function () {
  currentPage = 1;
  renderTable();
};

document.getElementById("filterGender").onchange = function () {
  currentPage = 1;
  renderTable();
};

// ========================================= PAGINATION ============================================
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

// ======================================= TAMBAH DATA ===================================================
function tambahData() {
  let nama = document.getElementById("namaTambah").value;
  let tempatlahir = document.getElementById("tempatLahirTambah").value;
  let tanggalLahir = document.getElementById("tanggalLahirTambah").value;
  let email = document.getElementById("emailTambah").value;
  let telepon = document.getElementById("teleponTambah").value;
  let gender = document.getElementById("genderTambah").value;
  let status = document.getElementById("statusTambah").value;
  let department = document.getElementById("departmentTambah").value;
  let jabatan = document.getElementById("jabatanTambah").value;
  let ktp = document.getElementById("ktpTambah").value;
  let kta = document.getElementById("ktaTambah").value;
  let npwp = document.getElementById("npwpTambah").value;
  let bpjs = document.getElementById("bpjsTambah").value;
  let bpjsTK = document.getElementById("bpjsTKTambah").value;
  let rekening = document.getElementById("rekeningTambah").value;
  let alamat = document.getElementById("alamatTambah").value;
  let photo = document.getElementById("photoTambah").files[0];

  let photoBase64 = "";
  if (photo) {
    photoBase64 = URL.createObjectURL(photo);
  }

  if (
    !nama ||
    !tempatlahir ||
    !tanggalLahir ||
    !email ||
    !telepon ||
    !gender ||
    !status ||
    !department ||
    !jabatan ||
    !ktp ||
    !npwp ||
    !bpjs ||
    !bpjsTK ||
    !rekening ||
    !alamat ||
    !photo
  ) {
    document.getElementById("validasiText").innerHTML =
      "Semua data personel wajib diisi";

    $("#modalValidasi").modal("show");

    return;
  }

  data.push({
    nama,
    tempatlahir,
    tanggalLahir,
    email,
    telepon,
    gender,
    status,
    department,
    jabatan,
    ktp,
    npwp,
    bpjs,
    bpjsTK,
    rekening,
    alamat,
    photo: photoBase64,
  });

  $("#modalTambah").modal("hide");

  renderTable();

  // TITLE
  document.getElementById("successTitle").innerHTML = "Tambah Berhasil";

  // TEXT
  document.getElementById("successText").innerHTML = `
    <strong>${nama}</strong> berhasil ditambahkan
`;

  // SHOW
  $("#modalSuccess").modal("show");
}

// ========================================== EDIT DATA =================================================
function editData(index) {
  let user = data[index];

  document.getElementById("editIndex").value = index;

  document.getElementById("namaEdit").value = user.nama || "";
  document.getElementById("tempatLahirEdit").value = user.tempatlahir || "";
  document.getElementById("tanggalLahirEdit").value = user.tanggallahir || "";
  // HITUNG UMUR SAAT EDIT
  if (user.tanggallahir) {
    const tanggalLahir = new Date(user.tanggallahir);
    const today = new Date();

    let umur = today.getFullYear() - tanggalLahir.getFullYear();

    const bulan = today.getMonth() - tanggalLahir.getMonth();

    if (
      bulan < 0 ||
      (bulan === 0 && today.getDate() < tanggalLahir.getDate())
    ) {
      umur--;
    }

    document.getElementById("umurTextEdit").innerHTML =
      '<span class="material-icons align-middle mr-1" style="font-size:16px;">cake</span>' +
      "Umur saat ini <b>" +
      umur +
      " Tahun</b>";
  } else {
    document.getElementById("umurTextEdit").innerHTML =
      "Umur akan muncul di sini";
  }
  document.getElementById("emailEdit").value = user.email || "";
  document.getElementById("teleponEdit").value = user.telepon || "";
  document.getElementById("genderEdit").value = user.gender || "";
  document.getElementById("statusEdit").value = user.status || "";
  document.getElementById("departmentEdit").value = user.department || "";
  document.getElementById("jabatanEdit").value = user.jabatan || "";
  document.getElementById("ktpEdit").value = user.ktp || "";
  document.getElementById("npwpEdit").value = user.npwp || "";
  document.getElementById("bpjsEdit").value = user.bpjs || "";
  document.getElementById("bpjsTKEdit").value = user.bpjsTK || "";
  document.getElementById("rekeningEdit").value = user.rekening || "";
  document.getElementById("ktaEdit").value = user.kta || "";
  document.getElementById("alamatEdit").value = user.alamat || "";

  document.getElementById("previewPhotoEdit").src =
    user.photo || "https://via.placeholder.com/100";

  photoEditBase64 = user.photo || "";

  $("#modalEdit").modal("show");
}

// =========================================== UPDATE DATA ===========================================
function updateData() {
  let index = document.getElementById("editIndex").value;

  let nama = document.getElementById("namaEdit").value;
  let tempatlahir = document.getElementById("tempatLahirEdit").value;
  let tanggalLahir = document.getElementById("tanggalLahirEdit").value;
  let email = document.getElementById("emailEdit").value;
  let telepon = document.getElementById("teleponEdit").value;
  let gender = document.getElementById("genderEdit").value;
  let status = document.getElementById("statusEdit").value;
  let department = document.getElementById("departmentEdit").value;
  let jabatan = document.getElementById("jabatanEdit").value;
  let ktp = document.getElementById("ktpEdit").value;
  let kta = document.getElementById("ktaEdit").value;
  let npwp = document.getElementById("npwpEdit").value;
  let bpjs = document.getElementById("bpjsEdit").value;
  let bpjsTK = document.getElementById("bpjsTKEdit").value;
  let rekening = document.getElementById("rekeningEdit").value;
  let alamat = document.getElementById("alamatEdit").value;

  if (
    !nama ||
    !tempatlahir ||
    !tanggalLahir ||
    !email ||
    !telepon ||
    !gender ||
    !status ||
    !department ||
    !jabatan ||
    !ktp ||
    !npwp ||
    !bpjs ||
    !bpjsTK ||
    !rekening ||
    !alamat
  ) {
    document.getElementById("validasiText").innerHTML =
      "Data edit personel wajib diisi";

    $("#modalValidasi").modal("show");

    return;
  }

  data[index] = {
    ...data[index],
    nama,
    tempatlahir,
    tanggalLahir,
    email,
    telepon,
    gender,
    status,
    department,
    jabatan,
    ktp,
    kta,
    npwp,
    bpjs,
    bpjsTK,
    rekening,
    alamat,
    photo: photoEditBase64 || data[index].photo,
  };

  $("#modalEdit").modal("hide");

  renderTable();

  // TITLE
  document.getElementById("successTitle").innerHTML = "Edit Berhasil";

  // TEXT
  document.getElementById("successText").innerHTML = `
    <strong>${nama}</strong> berhasil di edit
`;

  // SHOW
  $("#modalSuccess").modal("show");
}

// =========================================== DELETE DATA ===========================================
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

// =========================================== VIEW DATA ===========================================
function viewData(index) {
  $("#modalView").modal("show");

  document.getElementById("loadingView").style.display = "block";
  document.getElementById("contentView").style.display = "none";

  let user = data[index];

  setTimeout(() => {
    document.getElementById("viewPhoto").src =
      user.photo || "../assets/images/avatars/foto-sushi-128246.jpg";

    document.getElementById("viewNama").innerText = user.nama;
    document.getElementById("viewTempatlahir").innerText =
      user.tempatlahir || "-";
    document.getElementById("viewTanggallahir").innerText =
      user.tanggalLahir || "-";
    document.getElementById("viewEmail").innerText = user.email;
    document.getElementById("viewTelp").innerText = user.telepon;
    document.getElementById("viewDepartment").innerText =
      user.department || "-";
    document.getElementById("viewJabatan").innerText = user.jabatan || "-";
    document.getElementById("viewGender").innerText = user.gender || "-";
    document.getElementById("viewStatus").innerText = user.status || "-";
    document.getElementById("viewKtp").innerText = user.ktp || "-";
    document.getElementById("viewKta").innerText = user.kta || "-";
    document.getElementById("viewNpwp").innerText = user.npwp || "-";
    document.getElementById("viewBpjs").innerText = user.bpjs || "-";
    document.getElementById("viewBpjsTK").innerText = user.bpjsTK || "-";
    document.getElementById("viewRekening").innerText = user.rekening || "-";
    document.getElementById("viewAlamat").innerText = user.alamat || "-";

    let cover =
      user.cover ||
      "https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d";

    document.querySelector(".profile-cover").style.backgroundImage =
      `url('${cover}')`;

    document.getElementById("loadingView").style.display = "none";
    document.getElementById("contentView").style.display = "block";
  }, 600);
}

// =========================================== PHOTO TAMBAH ===========================================
let photoBase64 = "";

document.getElementById("photoTambah").onchange = function (e) {
  let file = e.target.files[0];
  let reader = new FileReader();

  reader.onload = function (event) {
    let img = new Image();
    img.src = event.target.result;

    img.onload = function () {
      let canvas = document.createElement("canvas");
      let maxSize = 300;

      let scale = Math.min(maxSize / img.width, maxSize / img.height);
      canvas.width = img.width * scale;
      canvas.height = img.height * scale;

      let ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

      photoBase64 = canvas.toDataURL("image/jpeg");

      document.getElementById("previewPhoto").src = photoBase64;
    };
  };
  reader.readAsDataURL(file);
};

// =========================================== PHOTO EDIT ===========================================
let photoEditBase64 = "";

document.getElementById("photoEdit").onchange = function (e) {
  let file = e.target.files[0];
  let reader = new FileReader();

  reader.onload = function (event) {
    let img = new Image();
    img.src = event.target.result;

    img.onload = function () {
      let canvas = document.createElement("canvas");
      let maxSize = 300;

      let scale = Math.min(maxSize / img.width, maxSize / img.height);
      canvas.width = img.width * scale;
      canvas.height = img.height * scale;

      let ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

      photoEditBase64 = canvas.toDataURL("image/jpeg");

      document.getElementById("previewPhotoEdit").src = photoEditBase64;
    };
  };
  reader.readAsDataURL(file);
};

// ========================================== TANGGAL LAHIR ===========================================
$("#tanggalLahirTambah").on("change", function () {
  const tanggalLahir = new Date($(this).val());

  if (!$(this).val()) {
    $("#umurText").html("Umur akan muncul di sini");
    return;
  }

  const today = new Date();

  let umur = today.getFullYear() - tanggalLahir.getFullYear();

  const bulan = today.getMonth() - tanggalLahir.getMonth();

  if (bulan < 0 || (bulan === 0 && today.getDate() < tanggalLahir.getDate())) {
    umur--;
  }

  $("#umurText").html(
    '<span class="material-icons align-middle mr-1" style="font-size:16px;">cake</span>' +
      "Umur saat ini <b>" +
      umur +
      " Tahun</b>",
  );
});

$("#tanggalLahirEdit").on("change", function () {
  const tanggalLahir = new Date($(this).val());

  if (!$(this).val()) {
    $("#umurTextEdit").html("Umur akan muncul di sini");
    return;
  }

  const today = new Date();

  let umur = today.getFullYear() - tanggalLahir.getFullYear();

  const bulan = today.getMonth() - tanggalLahir.getMonth();

  if (bulan < 0 || (bulan === 0 && today.getDate() < tanggalLahir.getDate())) {
    umur--;
  }

  $("#umurTextEdit").html(
    '<span class="material-icons align-middle mr-1" style="font-size:16px;">cake</span>' +
      "Umur saat ini <b>" +
      umur +
      " Tahun</b>",
  );
});
