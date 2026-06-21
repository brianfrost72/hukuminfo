// m.roles
// ============================================= DOM JS =============================================
let data = [
  {
    roleID: 1702261,
    nama: "Brian",
    email: "brian@mail.com",
    tempatLahir: "Jakarta",
    tanggalLahir: "01-01-1990",
    telepon: "08123456789",
    gender: "Laki-laki",
    status: "Menikah",
    roles: "Super Admin",
    department: "HR",
    jabatan: "Admin",
    cabang: "Jakarta",
    ktp: "1234567890123456",
    npwp: "1234567890",
    bpjs: "1234567890",
    bpjsTK: "1234567890",
    rekening: "1234567890",
    alamat: "Jakarta",
  },
  {
    roleID: 1702262,
    nama: "Steven",
    email: "steven@mail.com",
    tempatLahir: "Bandung",
    tanggalLahir: "01-01-1990",
    telepon: "08123456789",
    gender: "Laki-laki",
    status: "Belum Menikah",
    roles: "Admin",
    department: "IT",
    jabatan: "HR",
    cabang: "Bandung",
    ktp: "1234567890123456",
    npwp: "1234567890",
    bpjs: "1234567890",
    bpjsTK: "1234567890",
    rekening: "1234567890",
    alamat: "Bandung",
  },
];

let currentPage = 1;
let rowsPerPage = 5;

function renderTable() {
  let tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  let search = document.getElementById("searchInput").value.toLowerCase();

  let filtered = data.filter(
    (d) =>
      d.nama.toLowerCase().includes(search) ||
      d.email.toLowerCase().includes(search) ||
      d.cabang.toLowerCase().includes(search),
  );

  let start = (currentPage - 1) * rowsPerPage;
  let paginated = filtered.slice(start, start + rowsPerPage);

  paginated.forEach((item, index) => {
    tbody.innerHTML += `
<tr>
    <td><input type="checkbox" class="rowCheck" data-index="${start + index}"></td>
    <td>${start + index + 1}</td>

    <td>${item.roleID}</td>

    <td class="d-flex align-items-center">
        <img src="${item.photo || "../assets/images/avatars/foto-sushi-128246.jpg"}" alt="Photo"
             class="rounded-circle mr-2" width="40" height="40"
             style="object-fit:cover;">
        ${item.nama}
    </td>

    <td>${item.email}</td>
    <td>${item.roles}</td>
    <td>${item.cabang}</td>

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

// ======================================== RENDER PAGINATION =========================================
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

// ================================ PERGANTIAN HALAMAN PAGINATION ================================
function changePage(page) {
  currentPage = page;
  renderTable();
}

// ======================================= TAMBAH DATA ========================================
function tambahData() {
  let nama = document.getElementById("namaTambah").value;
  let tempatlahir = document.getElementById("tempatLahirTambah").value;
  let tanggalLahir = document.getElementById("tanggalLahirTambah").value;
  let telepon = document.getElementById("teleponTambah").value;
  let email = document.getElementById("emailTambah").value;
  let password = document.getElementById("passwordTambah").value;
  let gender = document.getElementById("genderTambah").value;
  let status = document.getElementById("statusTambah").value;
  let jabatan = document.getElementById("jabatanTambah").value;
  let roles = document.getElementById("rolesTambah").value;
  let department = document.getElementById("departmentTambah").value;
  let alamat = document.getElementById("alamatTambah").value;
  let cabang = document.getElementById("cabangTambah").value;
  let ktp = document.getElementById("ktpTambah").value;
  let npwp = document.getElementById("npwpTambah").value;
  let bpjs = document.getElementById("bpjsTambah").value;
  let bpjstk = document.getElementById("bpjstkTambah").value;
  let rekening = document.getElementById("rekeningTambah").value;
  let photo = document.getElementById("photoTambah").files[0];

  // VALIDASI
  if (
    !nama ||
    !tempatlahir ||
    !tanggalLahir ||
    !telepon ||
    !email ||
    !password ||
    !gender ||
    !status ||
    !jabatan ||
    !roles ||
    !department ||
    !alamat ||
    !cabang ||
    !ktp ||
    !npwp ||
    !bpjs ||
    !bpjstk ||
    !rekening ||
    !photo
  ) {
    alert("Wajib isi data!");
    return;
  }

  // GENERATE ROLE ID
  let roleId = "RL-" + Math.floor(Math.random() * 999999);

  // PUSH DATA
  data.push({
    roleId,
    nama,
    tempatlahir,
    tanggalLahir,
    telepon,
    email,
    password,
    gender,
    status,
    roles,
    department,
    jabatan,
    npwp,
    bpjs,
    bpjstk,
    rekening,
    alamat,
    cabang,
    ktp,
    photo: photoBase64,
  });

  // RENDER TABLE
  renderTable();

  // CLOSE MODAL TAMBAH
  $("#modalTambah").modal("hide");

  // TEXT SUCCESS
  document.getElementById("successText").innerHTML = `
        <strong>${nama}</strong> berhasil ditambahkan sebagai
        <strong>${roles}</strong>
    `;

  // SHOW SUCCESS MODAL
  $("#modalSuccess").modal("show");

  // RESET FORM
  document.getElementById("namaTambah").value = "";
  document.getElementById("tempatLahirTambah").value = "";
  document.getElementById("tanggalLahirTambah").value = "";
  document.getElementById("teleponTambah").value = "";
  document.getElementById("emailTambah").value = "";
  document.getElementById("passwordTambah").value = "";
  document.getElementById("genderTambah").value = "";
  document.getElementById("statusTambah").value = "";
  document.getElementById("jabatanTambah").value = "";
  document.getElementById("rolesTambah").value = "";
  document.getElementById("departmentTambah").value = "";
  document.getElementById("alamatTambah").value = "";
  document.getElementById("cabangTambah").value = "";
  document.getElementById("ktpTambah").value = "";
  document.getElementById("npwpTambah").value = "";
  document.getElementById("bpjsTambah").value = "";
  document.getElementById("bpjstkTambah").value = "";
  document.getElementById("rekeningTambah").value = "";
  document.getElementById("photoTambah").value = "";

  // RESET PREVIEW
  document.getElementById("previewPhoto").src = "";

  // RESET BASE64
  photoBase64 = "";
}

// =========================================== EDIT DATA ===========================================
function editData(index) {
  let user = data[index];

  document.getElementById("editIndex").value = index;

  document.getElementById("namaEdit").value = user.nama;
  document.getElementById("tempatLahirEdit").value = user.tempatlahir;
  document.getElementById("tanggalLahirEdit").value = user.tanggalLahir;
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
  document.getElementById("emailEdit").value = user.email;
  document.getElementById("passwordEdit").value = user.password || "";
  document.getElementById("genderEdit").value = user.gender || "";
  document.getElementById("statusEdit").value = user.status || "";
  document.getElementById("rolesEdit").value = user.roles || "";
  document.getElementById("departmentEdit").value = user.department || "";
  document.getElementById("jabatanEdit").value = user.jabatan || "";
  document.getElementById("npwpEdit").value = user.npwp || "";
  document.getElementById("bpjsEdit").value = user.bpjs || "";
  document.getElementById("bpjstkEdit").value = user.bpjstk || "";
  document.getElementById("rekeningEdit").value = user.rekening || "";
  document.getElementById("alamatEdit").value = user.alamat || "";
  document.getElementById("cabangEdit").value = user.cabang || "";
  document.getElementById("ktpEdit").value = user.ktp || "";

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
  let telepon = document.getElementById("teleponEdit").value;
  let email = document.getElementById("emailEdit").value;
  let password = document.getElementById("passwordEdit").value;
  let gender = document.getElementById("genderEdit").value;
  let status = document.getElementById("statusEdit").value;
  let roles = document.getElementById("rolesEdit").value;
  let department = document.getElementById("departmentEdit").value;
  let jabatan = document.getElementById("jabatanEdit").value;
  let npwp = document.getElementById("npwpEdit").value;
  let bpjs = document.getElementById("bpjsEdit").value;
  let bpjstk = document.getElementById("bpjstkEdit").value;
  let rekening = document.getElementById("rekeningEdit").value;
  let alamat = document.getElementById("alamatEdit").value;
  let cabang = document.getElementById("cabangEdit").value;
  let ktp = document.getElementById("ktpEdit").value;

  if (
    !nama ||
    !tempatlahir ||
    !tanggalLahir ||
    !email ||
    !password ||
    !gender ||
    !roles ||
    !department ||
    !jabatan ||
    !npwp ||
    !bpjs ||
    !bpjstk ||
    !rekening ||
    !alamat ||
    !cabang ||
    !ktp
  ) {
    alert("Data wajib diisi!");
    return;
  }

  data[index] = {
    ...data[index],
    nama,
    tempatlahir,
    tanggalLahir,
    telepon,
    email,
    password,
    gender,
    status,
    npwp,
    bpjs,
    bpjstk,
    rekening,
    roles,
    department,
    jabatan,
    alamat,
    cabang,
    ktp,
    photo: photoEditBase64 || data[index].photo,
  };

  $("#modalEdit").modal("hide");

  renderTable();

  // TEXT VALIDASI EDIT
  document.getElementById("editSuccessText").innerHTML = `
    <strong>${nama}</strong> berhasil di edit
`;

  // SHOW MODAL
  $("#modalEditSuccess").modal("show");
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

// ====================================== TAMBAH FOTO PROFILE =======================================
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

// ====================================== EDIT FOTO PROFILE =======================================
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

// ================================== VIEW DATA ======================================
function viewData(index) {
  $("#modalView").modal("show");

  document.getElementById("loadingView").style.display = "block";
  document.getElementById("contentView").style.display = "none";

  setTimeout(() => {
    
    let cover =
      user.cover ||
      "https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d";

    document.querySelector(".profile-cover").style.backgroundImage =
      `url('${cover}')`;

    document.getElementById("contentView").style.display = "block";
  }, 600);
}

// =================================== TOGGLE PASSWORD ================================
function togglePassword() {
  let input = document.getElementById("passwordTambah");
  input.type = input.type === "password" ? "text" : "password";
}

function togglePasswordEdit() {
  let input = document.getElementById("passwordEdit");
  input.type = input.type === "password" ? "text" : "password";
}

// ======================================== FILL SEARCH INPUT ================================
// TIDAK AUTO FILL SEARCH INPUT OLEH BROWSER
document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("searchInput");

  // kosongkan paksa
  input.value = "";

  // trick supaya chrome gak inject value
  input.setAttribute("readonly", true);

  setTimeout(() => {
    input.removeAttribute("readonly");
  }, 100);
});

// ===================================== TANGGAL LAHIR =====================================
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
