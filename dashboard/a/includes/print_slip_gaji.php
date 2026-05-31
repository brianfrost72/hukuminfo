<?php

require_once __DIR__ . '/../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

/* =========================================
   GET ID
========================================= */

$id = intval($_GET['id']);

/* =========================================
   QUERY DETAIL
========================================= */

$query = mysqli_query($conn, "

    SELECT

        employee_payment.*,

        employee.id AS employee_id,
        employee.full_name,

        department.department_name,

        positions.position_name

    FROM employee_payment

    LEFT JOIN employee
        ON employee_payment.id_employee = employee.id

    LEFT JOIN department
        ON employee_payment.id_department = department.id

    LEFT JOIN positions
        ON employee_payment.id_position = positions.id

    WHERE employee_payment.id = '$id'

");

$data = mysqli_fetch_assoc($query);

if (!$data) {

    die("Data payroll tidak ditemukan");
}

/* =========================================
   TOTAL
========================================= */

$totalPendapatan =
    $data['basic_salary'] +
    $data['benefit_salary'] +
    $data['bonus_salary'] +
    $data['overtime_salary'];

$totalPotongan =
    $data['bpjs_deduction'] +
    $data['bpjstk_deduction'] +
    $data['pph21_deduction'] +
    $data['etc_deduction'];

$takeHomePay =
    $totalPendapatan - $totalPotongan;

/* =========================================
   NOMOR SLIP
========================================= */

$year = date(
    'y',
    strtotime($data['payment_date'])
);

$month = date(
    'm',
    strtotime($data['payment_date'])
);

$day = date(
    'd',
    strtotime($data['payment_date'])
);

/* =========================================
   NO SLIP
========================================= */

$slipNumber =
    $year .
    $month .
    $day .
    $data['id'];

/* =========================================
   ID KARYAWAN
========================================= */

$employeeId =
    $year .
    $month .
    $data['employee_id'];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Slip Gaji
    </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 20px;
        }

        .slip-container {

            width: 1120px;
            margin: auto;

            background: #fff;

            border-radius: 10px;

            padding: 30px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);

        }

        .header {

            display: flex;
            justify-content: space-between;
            align-items: center;

            border-bottom: 2px solid #ECEEF0;

            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .logo {

            display: flex;
            align-items: center;
        }

        .logo img {

            width: 70px;
            margin-right: 15px;
        }

        .company-name {

            font-size: 24px;
            font-weight: bold;
        }

        .company-address {

            color: #666;
            font-size: 13px;
        }

        .title {

            text-align: right;
        }

        .title h2 {

            margin: 0;
            color: #2F80ED;
        }

        .title small {

            color: #666;
        }

        .info-grid {

            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;

            margin-bottom: 25px;
        }

        .info-box {

            border: 1px solid #ECEEF0;

            border-radius: 8px;

            padding: 15px;
        }

        .info-box table {

            width: 100%;
        }

        .info-box td {

            padding: 6px 0;
            font-size: 14px;
        }

        .section-title {

            margin-bottom: 10px;

            font-weight: bold;
        }

        table.salary-table {

            width: 100%;
            border-collapse: collapse;
        }

        table.salary-table th {

            background: #F7F9FC;

            padding: 10px;

            border: 1px solid #ECEEF0;
        }

        table.salary-table td {

            padding: 10px;

            border: 1px solid #ECEEF0;
        }

        .text-right {

            text-align: right;
        }

        .income {

            color: #27AE60;
            font-weight: bold;
        }

        .deduction {

            color: #EB5757;
            font-weight: bold;
        }

        .take-home {

            background: #2F80ED;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {

            margin-top: 40px;

            display: flex;
            justify-content: space-between;
        }

        .signature {

            text-align: center;
            width: 250px;
        }

        .print-btn {

            margin-top: 25px;
            text-align: right;
        }

        .print-btn button {

            background: #2F80ED;
            color: #fff;
            border: none;

            padding: 12px 20px;

            border-radius: 6px;

            cursor: pointer;
        }

        /* =========================================
   PRINT
========================================= */

        @page {

            size: landscape;

            margin: 10mm;

        }

        @media print {

            html,
            body {

                width: 297mm;
                height: 210mm;

                background: #fff !important;

                margin: 0;
                padding: 0;

            }

            body {

                zoom: 95%;

            }

            .print-btn {

                display: none !important;

            }

            .slip-container {

                width: 100% !important;

                max-width: 100% !important;

                box-shadow: none !important;

                border-radius: 0;

                margin: 0 auto;

                padding: 10mm;

                overflow: hidden;

            }

            table {

                width: 100% !important;

            }

            .salary-table td,
            .salary-table th {

                font-size: 12px;

                padding: 8px;

            }

            .company-name {

                font-size: 22px;

            }

            .title h2 {

                font-size: 24px;

            }

        }
    </style>

</head>

<body>

    <div class="slip-container">

        <!-- HEADER -->
        <div class="header">

            <div class="logo">

                <!-- GANTI SESUAI LOGO -->
                <img src="../../assets/images/logos/logo-full.png">

                <div>

                    <div class="company-name">
                        KONIG GUARD BUREAU
                    </div>

                    <div class="company-address">
                        Slip Penggajian Karyawan
                    </div>

                </div>

            </div>

            <div class="title">

                <h2>
                    SLIP GAJI
                </h2>

                <small>
                    No Slip :
                    <?= $slipNumber; ?>
                </small>

                <br>

                <small>
                    No. ID Karyawan :
                    <?= $employeeId; ?>
                </small>

            </div>

        </div>

        <!-- INFO -->
        <div class="info-grid">

            <div class="info-box">

                <table>

                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            <?= $data['full_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Department</td>
                        <td>:</td>
                        <td>
                            <?= $data['department_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>
                            <?= $data['position_name']; ?>
                        </td>
                    </tr>

                </table>

            </div>

            <div class="info-box">

                <table>

                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>
                            <?= date('F Y', strtotime($data['period_date'])); ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Bayar</td>
                        <td>:</td>
                        <td>
                            <?= date('d F Y', strtotime($data['payment_date'])); ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Metode</td>
                        <td>:</td>
                        <td>
                            <?= $data['payment_method']; ?>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <!-- TABLE -->
        <table class="salary-table">

            <thead>

                <tr>

                    <th>
                        Pendapatan
                    </th>

                    <th class="text-right">
                        Nominal
                    </th>

                    <th>
                        Potongan
                    </th>

                    <th class="text-right">
                        Nominal
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Gaji Pokok</td>

                    <td class="text-right income">
                        Rp <?= number_format($data['basic_salary'], 0, ',', '.'); ?>
                    </td>

                    <td>BPJS Kesehatan</td>

                    <td class="text-right deduction">
                        Rp <?= number_format($data['bpjs_deduction'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <tr>

                    <td>Tunjangan</td>

                    <td class="text-right income">
                        Rp <?= number_format($data['benefit_salary'], 0, ',', '.'); ?>
                    </td>

                    <td>BPJS TK</td>

                    <td class="text-right deduction">
                        Rp <?= number_format($data['bpjstk_deduction'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <tr>

                    <td>Bonus</td>

                    <td class="text-right income">
                        Rp <?= number_format($data['bonus_salary'], 0, ',', '.'); ?>
                    </td>

                    <td>PPh 21</td>

                    <td class="text-right deduction">
                        Rp <?= number_format($data['pph21_deduction'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <tr>

                    <td>Lembur</td>

                    <td class="text-right income">
                        Rp <?= number_format($data['overtime_salary'], 0, ',', '.'); ?>
                    </td>

                    <td>Lain-lain</td>

                    <td class="text-right deduction">
                        Rp <?= number_format($data['etc_deduction'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <tr>

                    <td colspan="1">
                        <strong>
                            Total Pendapatan
                        </strong>
                    </td>

                    <td class="text-right income">
                        <strong>
                            Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?>
                        </strong>
                    </td>

                    <td>
                        <strong>
                            Total Potongan
                        </strong>
                    </td>

                    <td class="text-right deduction">
                        <strong>
                            Rp <?= number_format($totalPotongan, 0, ',', '.'); ?>
                        </strong>
                    </td>

                </tr>

                <tr class="take-home">

                    <td colspan="3">
                        TAKE HOME PAY
                    </td>

                    <td class="text-right">
                        Rp <?= number_format($takeHomePay, 0, ',', '.'); ?>
                    </td>

                </tr>

            </tbody>

        </table>

        <!-- FOOTER -->
        <div class="footer">

            <div>
                Catatan:
                <br>

                <?= $data['note_payment'] ?: '-'; ?>

            </div>

            <div class="signature">

                <p>
                    STEMPEL
                </p>

                <br><br><br>

                ___________________

            </div>

        </div>

        <!-- PRINT -->
        <div class="print-btn">

            <button onclick="window.print()">
                Print Slip Gaji
            </button>

        </div>

    </div>

</body>

</html>