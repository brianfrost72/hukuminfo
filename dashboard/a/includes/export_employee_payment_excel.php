<?php

require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../koneksi.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('Asia/Jakarta');

/* =========================================
   LOAD TEMPLATE
========================================= */

$spreadsheet = IOFactory::load("Data_Payroll.xlsx");

/* =========================================
   QUERY PERIODE
========================================= */

$queryPeriod = mysqli_query($conn, "

    SELECT DISTINCT period_date

    FROM employee_payment

    ORDER BY period_date ASC

");

$sheetIndex = 0;

/* =========================================
   LOOP PERIODE
========================================= */

while ($period = mysqli_fetch_assoc($queryPeriod)) {

    $periodDate = $period['period_date'];

    $monthName = date(
        'F Y',
        strtotime($periodDate)
    );

    /* =========================================
   SHEET
========================================= */

    if ($sheetIndex == 0) {

        $sheet = $spreadsheet->getActiveSheet();
    } else {

        /* =========================================
       LOAD TEMPLATE BARU
    ========================================= */

        $templateSpreadsheet =
            IOFactory::load("Data_Payroll.xlsx");

        $templateSheet =
            $templateSpreadsheet->getActiveSheet();

        /* =========================================
       CREATE NEW SHEET
    ========================================= */

        $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet(
            $spreadsheet,
            $monthName
        );

        $spreadsheet->addSheet($sheet);

        /* =========================================
       COPY TEMPLATE
    ========================================= */

        foreach (
            $templateSheet->getRowIterator()
            as $row
        ) {

            foreach (
                $row->getCellIterator()
                as $cell
            ) {

                $sheet->setCellValue(
                    $cell->getCoordinate(),
                    $cell->getValue()
                );
            }
        }
    }

    /* =========================================
       SET ACTIVE
    ========================================= */

    $spreadsheet->setActiveSheetIndex($sheetIndex);

    $sheet = $spreadsheet->getActiveSheet();

    /* =========================================
       TITLE SHEET
    ========================================= */

    $sheet->setTitle(
        substr($monthName, 0, 31)
    );

    /* =========================================
       JUDUL
    ========================================= */

    $sheet->setCellValue(
        'A2',
        'DATA PAYROLL ' . strtoupper($monthName)
    );

    /* =========================================
       QUERY DATA
    ========================================= */

    $query = mysqli_query($conn, "

        SELECT

            employee_payment.*,

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

        WHERE employee_payment.period_date = '$periodDate'

        ORDER BY employee.full_name ASC

    ");

    /* =========================================
       START ROW
    ========================================= */

    $rowNumber = 3;

    $no = 1;

    /* =========================================
       LOOP DATA
    ========================================= */

    while ($row = mysqli_fetch_assoc($query)) {

        $totalPendapatan =
            $row['basic_salary'] +
            $row['benefit_salary'] +
            $row['bonus_salary'] +
            $row['overtime_salary'];

        $totalPotongan =
            $row['bpjs_deduction'] +
            $row['bpjstk_deduction'] +
            $row['pph21_deduction'] +
            $row['etc_deduction'];

        $takeHomePay =
            $totalPendapatan - $totalPotongan;

        /* =========================================
   TEMPLATE FINAL
=========================================

A = No
B = Nama Karyawan
C = Department
D = Jabatan
E = Periode
F = Tanggal Bayar
G = Total Pendapatan
H = Total Potongan
I = Take Home Pay

========================================= */

        /* NO */
        $sheet->setCellValue(
            'A' . $rowNumber,
            $no++
        );

        /* NAMA KARYAWAN */
        $sheet->setCellValue(
            'B' . $rowNumber,
            $row['full_name']
        );

        /* DEPARTMENT */
        $sheet->setCellValue(
            'C' . $rowNumber,
            $row['department_name']
        );

        /* JABATAN */
        $sheet->setCellValue(
            'D' . $rowNumber,
            $row['position_name']
        );

        /* PERIODE */
        $sheet->setCellValue(
            'E' . $rowNumber,
            date(
                'F Y',
                strtotime($row['period_date'])
            )
        );

        /* TANGGAL BAYAR */
        $sheet->setCellValue(
            'F' . $rowNumber,
            date(
                'd/m/Y',
                strtotime($row['payment_date'])
            )
        );

        /* TOTAL PENDAPATAN */
        $sheet->setCellValue(
            'G' . $rowNumber,
            $totalPendapatan
        );

        /* TOTAL POTONGAN */
        $sheet->setCellValue(
            'H' . $rowNumber,
            $totalPotongan
        );

        /* TAKE HOME PAY */
        $sheet->setCellValue(
            'I' . $rowNumber,
            $takeHomePay
        );

        /* =========================================
           FORMAT RUPIAH
        ========================================= */

        foreach (['G', 'H', 'I'] as $col) {

            $sheet->getStyle($col . $rowNumber)
                ->getNumberFormat()
                ->setFormatCode('#,##0');
        }

        $rowNumber++;
    }

    /* =========================================
       AUTO SIZE
    ========================================= */

    foreach (range('A', 'I') as $column) {

        $sheet->getColumnDimension($column)
            ->setAutoSize(true);
    }

    /* =========================================
   NEXT SHEET
========================================= */

    $sheetIndex++;
}

/* =========================================
   ACTIVE FIRST SHEET
========================================= */

$spreadsheet->setActiveSheetIndex(0);

/* =========================================
   DOWNLOAD
========================================= */

$fileName =
    "Data_Payroll_" .
    date('YmdHis') .
    ".xlsx";

header(
    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
    'Content-Disposition: attachment;filename="' . $fileName . '"'
);

header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter(
    $spreadsheet,
    'Xlsx'
);

$writer->save('php://output');

exit;
