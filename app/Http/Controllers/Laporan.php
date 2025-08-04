<?php

namespace App\Http\Controllers;

use App\Models\CampaignDonasi;
use App\Models\DonasiCampaign;
use App\Models\DonasiDonaturTetap;
use App\Models\DonasiManual;
use App\Models\DonaturTetap;
use App\Models\Realisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Laporan extends BaseController
{
    public function index()
    {
        $module = 'Laporan';
        return view('admin.laporan.index', compact('module'));
    }

    public function get($params)
    {
        // Pisahkan dan validasi tanggal
        $dateParts = explode(' to ', $params);
        $startDateStr = trim($dateParts[0] ?? now()->startOfMonth()->toDateString());
        $endDateStr = trim($dateParts[1] ?? now()->endOfMonth()->toDateString());

        $startDate = \Carbon\Carbon::parse($startDateStr)->startOfDay();
        $endDate = \Carbon\Carbon::parse($endDateStr)->endOfDay();

        // Ambil dan mapping Donasi Campaign
        $donasiCampaigns = DonasiCampaign::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->map(function ($item) {
                $campaign = CampaignDonasi::where('uuid', $item->uuid_campaign)->first();
                return (object)[
                    'tanggal' => $item->created_at->format('Y-m-d'),
                    'deskripsi' => 'Donasi untuk ' . ($campaign->judul ?? '-') . ' dari ' . $item->nama_pendonasi,
                    'pemasukan' => $item->nominal_donasi,
                    'pengeluaran' => 0
                ];
            });

        // // Ambil dan mapping Donasi Donatur Tetap
        // $donasiDonaturTetaps = DonasiDonaturTetap::where('status', 'approved')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->get()
        //     ->map(function ($item) {
        //         return (object)[
        //             'tanggal' => $item->created_at->format('Y-m-d'),
        //             'deskripsi' => 'Donasi dari donatur tetap ' . $item->nama_pendonasi,
        //             'pemasukan' => $item->nominal_donasi,
        //             'pengeluaran' => 0
        //         ];
        //     });

        $realisasi = Realisasi::get()
            ->filter(function ($item) use ($startDate, $endDate) {
                $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal_realisasi);
                return $tanggal->between($startDate, $endDate);
            })
            ->map(function ($item) {
                return (object)[
                    'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal_realisasi)->format('Y-m-d'),
                    'deskripsi' => $item->keterangan,
                    'pemasukan' => 0,
                    'pengeluaran' => $item->jumlah
                ];
            });

        $donasiManual = DonasiManual::get()
            ->filter(function ($item) use ($startDate, $endDate) {
                try {
                    $tanggal = Carbon::createFromFormat('d-m-Y', $item->tanggal);
                } catch (\Exception $e) {
                    return false; // Abaikan jika format salah
                }
                return $tanggal->between($startDate, $endDate);
            })
            ->map(function ($item) {
                $tanggal = Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d');
                $deskripsi = 'Donasi ' . $item->jenis_donasi;

                if ($item->jenis_donasi !== 'kotak infaq jumat' && !empty($item->nama_donatur)) {
                    $deskripsi .= ' dari ' . $item->nama_donatur;
                }

                return (object)[
                    'tanggal' => $tanggal,
                    'deskripsi' => $deskripsi,
                    'pemasukan' => $item->jumlah,
                    'pengeluaran' => 0
                ];
            });

        // Gabungkan semua data
        $merged = collect()
            ->merge($donasiCampaigns)
            // ->merge($donasiDonaturTetaps)
            ->merge($realisasi)
            ->merge($donasiManual)
            ->sortBy('tanggal')
            ->values();

        // Kirim respons
        return $this->sendResponse($merged, 'Get data success');
    }

    public function export_to_excel($params)
    {
        // Pisahkan dan validasi tanggal
        $dateParts = explode(' to ', $params);
        $startDateStr = trim($dateParts[0] ?? now()->startOfMonth()->toDateString());
        $endDateStr = trim($dateParts[1] ?? now()->endOfMonth()->toDateString());

        $startDate = \Carbon\Carbon::parse($startDateStr)->startOfDay();
        $endDate = \Carbon\Carbon::parse($endDateStr)->endOfDay();

        // Ambil dan mapping Donasi Campaign
        $donasiCampaigns = DonasiCampaign::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->map(function ($item) {
                $campaign = CampaignDonasi::where('uuid', $item->uuid_campaign)->first();
                return (object)[
                    'tanggal' => $item->created_at->format('Y-m-d'),
                    'deskripsi' => 'Donasi untuk ' . ($campaign->judul ?? '-') . ' dari ' . $item->nama_pendonasi,
                    'pemasukan' => $item->nominal_donasi,
                    'pengeluaran' => 0
                ];
            });

        // // Ambil dan mapping Donasi Donatur Tetap
        // $donasiDonaturTetaps = DonasiDonaturTetap::where('status', 'approved')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->get()
        //     ->map(function ($item) {
        //         return (object)[
        //             'tanggal' => $item->created_at->format('Y-m-d'),
        //             'deskripsi' => 'Donasi dari donatur tetap ' . $item->nama_pendonasi,
        //             'pemasukan' => $item->nominal_donasi,
        //             'pengeluaran' => 0
        //         ];
        //     });

        $realisasi = Realisasi::get()
            ->filter(function ($item) use ($startDate, $endDate) {
                $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal_realisasi);
                return $tanggal->between($startDate, $endDate);
            })
            ->map(function ($item) {
                return (object)[
                    'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal_realisasi)->format('Y-m-d'),
                    'deskripsi' => $item->keterangan,
                    'pemasukan' => 0,
                    'pengeluaran' => $item->jumlah
                ];
            });

        $donasiManual = DonasiManual::get()
            ->filter(function ($item) use ($startDate, $endDate) {
                $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal);
                return $tanggal->between($startDate, $endDate);
            })
            ->map(function ($item) {
                return (object)[
                    'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d'),
                    'deskripsi' => 'Donasi ' . $item->jenis_donasi . ($item->jenis_donasi == 'kotak infaq jumat' ? ' ' : ' dari ' . $item->nama_donatur),
                    'pemasukan' => $item->jumlah,
                    'pengeluaran' => 0
                ];
            });

        // Gabungkan semua data
        $merged = collect()
            ->merge($donasiCampaigns)
            // ->merge($donasiDonaturTetaps)
            ->merge($realisasi)
            ->merge($donasiManual)
            ->sortBy('tanggal')
            ->values();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');

        $sheet->setCellValue('A1', 'LAPORAN PEMASUKAN DAN PENGELURAN MASJID AGUNG UINAM')->mergeCells('A1:F1');
        $sheet->setCellValue('A2', 'Tanggal ' . $startDateStr . ' Sampai ' . $endDateStr)->mergeCells('A2:F2');

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'DESKRIPSI');
        $sheet->setCellValue('D3', 'PEMASUKAN');
        $sheet->setCellValue('E3', 'PENGELUARAN');
        $sheet->setCellValue('F3', 'SALDO AKHIR');

        $row = 4;
        $subtotalTotal = 0;

        foreach ($merged as $index => $rekap) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $rekap->tanggal);
            $sheet->setCellValue('C' . $row, $rekap->deskripsi);
            $sheet->setCellValue('D' . $row, $rekap->pemasukan ? "Rp " . number_format($rekap->pemasukan, 0, ',', '.') : '-');
            $sheet->setCellValue('E' . $row, $rekap->pengeluaran ? "Rp " . number_format($rekap->pengeluaran, 0, ',', '.') : '-');

            // Format rupiah pada kolom H
            $sisa_saldo = $rekap->pemasukan - $rekap->pengeluaran;
            $subtotalTotal += $sisa_saldo;
            $sheet->setCellValue('F' . $row, "Rp " . number_format($subtotalTotal, 0, ',', '.'));

            $row++;
        }

        // Baris Total
        $sheet->setCellValue('A' . $row, 'Total Saldo'); // Gantilah 'Total' dengan label yang sesuai
        $sheet->mergeCells('A' . $row . ':E' . $row); // Gabungkan sel dari A hingga E
        $sheet->setCellValue('F' . $row, "Rp " . number_format($subtotalTotal, 0, ',', '.')); // Menghitung total
        // Menerapkan gaya untuk sel total
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'acb9ca', // Warna Peach
                ],
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $row++; // Pindahkan ke baris berikutnya

        // Ambil objek kolom terakhir yang memiliki data (A, B, C, dst.)
        $lastColumn = $sheet->getHighestDataColumn();

        // Iterate melalui kolom-kolom yang memiliki data dan atur lebar kolomnya
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Style tengah semua isi tabel
        $sheet->getStyle('A1:F' . ($row - 1))->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $excelFileName = 'laporan_' . $startDateStr . '_sampai_' . $endDateStr . '.xlsx';
        $excelFilePath = public_path($excelFileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        return response()->download($excelFilePath)->deleteFileAfterSend(true);
    }
}
