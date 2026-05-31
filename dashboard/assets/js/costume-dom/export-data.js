// export-data ---> m.emp-pt
// ======================================== EXPORT EXCELDATA ========================================
// EXPORT EXCEL
function exportExcel() {
  // FILTER DATA
  let search = searchInput.value.toLowerCase();

  let divisi = filterDivisi.value;

  let periode = filterPeriode.value;

  let filtered = payrollData.filter((item) => {
    let matchSearch = item.nama.toLowerCase().includes(search);

    let matchDivisi = divisi === "" || item.divisi === divisi;

    let matchPeriode = periode === "" || item.periode === periode;

    return matchSearch && matchDivisi && matchPeriode;
  });

  // WORKBOOK
  const workbook = XLSX.utils.book_new();

  // GROUP PER BULAN
  const grouped = {};

  filtered.forEach((item) => {
    let date = new Date(item.periode + "-01");

    let month = date.toLocaleDateString("id-ID", {
      month: "short",
    });

    let year = date.toLocaleDateString("id-ID", {
      year: "2-digit",
    });

    let sheetName = month + year;

    if (!grouped[sheetName]) {
      grouped[sheetName] = [];
    }

    grouped[sheetName].push({
      Karyawan: item.nama,

      Divisi: item.divisi,

      Periode: item.periode,

      "Tgl Bayar": item.tanggal,

      Total: item.total,

      Potongan: item.potongan,

      "Take Home Pay": item.total - item.potongan,
    });
  });

  // SHEETS
  for (let sheet in grouped) {
    const worksheet = XLSX.utils.json_to_sheet(grouped[sheet]);

    XLSX.utils.book_append_sheet(workbook, worksheet, sheet);
  }

  // EXPORT
  XLSX.writeFile(workbook, "Data_Penggajian.xlsx");
}

// =========================================== PRINT SLIP GAJI ===========================================
function printSlipGaji() {
  let nama = document.getElementById("detailNama").innerHTML;
  let periode = document.getElementById("detailPeriode").innerHTML;
  let tanggal = document.getElementById("detailTanggal").innerHTML;
  let metode = document.getElementById("detailMetode").innerHTML;

  let gaji = document.getElementById("detailGaji").innerHTML;
  let tunjangan = document.getElementById("detailTunjangan").innerHTML;
  let bonus = document.getElementById("detailBonus").innerHTML;
  let lembur = document.getElementById("detailLembur").innerHTML;

  let bpjs = document.getElementById("detailBPJS").innerHTML;
  let bpjstk = document.getElementById("detailBPJSTK").innerHTML;
  let pph = document.getElementById("detailPPH").innerHTML;
  let lain = document.getElementById("detailLain").innerHTML;

  let totalPendapatan = document.getElementById(
    "detailTotalPendapatan",
  ).innerHTML;

  let totalPotongan = document.getElementById("detailTotalPotongan").innerHTML;

  let takeHome = document.getElementById("summaryTakeHomeView").innerHTML;

  let catatan = document.getElementById("detailCatatan").value;

  let printWindow = window.open("", "", "width=400,height=800");

  printWindow.document.write(`

            <html>

            <head>

                <title>Slip Gaji</title>

                <style>

                    body{

                        font-family:Arial,sans-serif;
                        padding:20px;

                        color:#112b4a;
                    }

                    .slip{

                        border:1px solid #ddd;
                        border-radius:10px;

                        padding:20px;
                    }

                    .title{

                        text-align:center;
                        margin-bottom:20px;
                    }

                    .title h2{

                        margin:0;
                    }

                    .line{

                        border-bottom:1px dashed #ccc;
                        margin:15px 0;
                    }

                    .row{

                        display:flex;
                        justify-content:space-between;

                        margin-bottom:8px;
                        font-size:14px;
                    }

                    .section-title{

                        font-weight:bold;
                        margin-top:15px;
                        margin-bottom:10px;

                        color:#6774DF;
                    }

                    .total{

                        font-weight:bold;
                    }

                    .take-home{

                        font-size:18px;
                        font-weight:bold;

                        color:#6774DF;
                    }

                    .footer{

                        margin-top:25px;
                        font-size:12px;

                        text-align:center;
                        color:#777;
                    }

                    @media print{

                        body{
                            padding:0;
                        }

                        .slip{
                            border:none;
                        }

                    }

                </style>

            </head>

            <body>

                <div class="slip">

                    <div class="title-slip"
     style="
        text-align:center;
        margin-bottom:15px;
     ">

    <!-- LOGO -->
    <img
        src="assets/images/logos/logo-light.png"
        alt="Logo"
        style="
            width:250px;
            height:auto;
            display:block;
            margin:0 auto 8px auto;
            object-fit:contain;
        ">

    <h2 style="
        margin:0;
        font-size:24px;
        color:#112b4a;
        font-weight:700;
    ">
        SLIP GAJI
    </h2>

    <small style="
        color:#777;
        font-size:13px;
    ">
        Konig Guard Bureau
    </small>

</div>

                    <div class="line"></div>

                    <div class="row">
                        <span>Karyawan</span>
                        <span>${nama}</span>
                    </div>

                    <div class="row">
                        <span>Periode</span>
                        <span>${periode}</span>
                    </div>

                    <div class="row">
                        <span>Tanggal Bayar</span>
                        <span>${tanggal}</span>
                    </div>

                    <div class="row">
                        <span>Metode</span>
                        <span>${metode}</span>
                    </div>

                    <div class="line"></div>

                    <div class="section-title">
                        Pendapatan
                    </div>

                    <div class="row">
                        <span>Gaji Pokok</span>
                        <span>${gaji}</span>
                    </div>

                    <div class="row">
                        <span>Tunjangan</span>
                        <span>${tunjangan}</span>
                    </div>

                    <div class="row">
                        <span>Bonus</span>
                        <span>${bonus}</span>
                    </div>

                    <div class="row">
                        <span>Lembur</span>
                        <span>${lembur}</span>
                    </div>

                    <div class="row total">
                        <span>Total Pendapatan</span>
                        <span>${totalPendapatan}</span>
                    </div>

                    <div class="line"></div>

                    <div class="section-title">
                        Potongan
                    </div>

                    <div class="row">
                        <span>BPJS Kesehatan</span>
                        <span>${bpjs}</span>
                    </div>

                    <div class="row">
                        <span>BPJS TK</span>
                        <span>${bpjstk}</span>
                    </div>

                    <div class="row">
                        <span>PPh 21</span>
                        <span>${pph}</span>
                    </div>

                    <div class="row">
                        <span>Lain-lain</span>
                        <span>${lain}</span>
                    </div>

                    <div class="row total">
                        <span>Total Potongan</span>
                        <span>${totalPotongan}</span>
                    </div>

                    <div class="line"></div>

                    <div class="row take-home">
                        <span>Take Home Pay</span>
                        <span>${takeHome}</span>
                    </div>

                    <div class="line"></div>

                    <div style="font-size:13px;">
                        <strong>Catatan:</strong><br>
                        ${catatan}
                    </div>

                    <div class="footer">

                        Slip ini dicetak otomatis oleh sistem payroll.

                    </div>

                </div>

                <script>

                    window.onload = function(){

                        window.print();

                    }

                <\/script>

            </body>

            </html>

        `);

  printWindow.document.close();
}
