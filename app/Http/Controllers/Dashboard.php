<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\CampaignDonasi;
use App\Models\DataJamaah;
use App\Models\DonasiCampaign;
use App\Models\DonasiDonaturTetap;
use App\Models\DonaturTetap;
use App\Models\Event;
use App\Models\Izin;
use App\Models\JadwalJumat;
use App\Models\JamKerja;
use App\Models\Kegiatan;
use App\Models\Realisasi;
use App\Models\Sejarah;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Dashboard extends BaseController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->back();
        }
        return redirect()->route('login.login-akun');
    }

    public function dashboard_admin()
    {
        $module = 'Dashboard';
        $campaign = DonasiCampaign::where('status', 'approved')->sum('nominal_donasi');
        $donaturTetap = DonasiDonaturTetap::where('status', 'approved')->sum('nominal_donasi');
        $donasiRealisasi = Realisasi::sum('jumlah');

        $kas = $campaign + $donaturTetap - $donasiRealisasi;
        return view('dashboard.admin', compact('module', 'kas'));
    }

    public function dashboard_user()
    {
        $module = 'Masjid Agung UINAM';

        $today = Carbon::today();
        $jadwalJumat = JadwalJumat::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->first();
        $donasis = CampaignDonasi::where('status', true)->take(4)->latest()->get();

        $donasis->each(function ($donasi) {
            $donasiCampaigns = DonasiCampaign::where('uuid_campaign', $donasi->uuid)
                ->where('status', 'approved')
                ->get();
            $donasi->total_donasi = $donasiCampaigns->sum('nominal_donasi');
        });

        $kegiatans = Kegiatan::latest()->get();

        $donaturTetaps = DonaturTetap::all();
        $donaturTetaps->map(function ($item) {
            $jamaah = DataJamaah::where('uuid', $item->uuid_user)->first();

            $donasi = DonasiDonaturTetap::where('uuid_donatur', $item->uuid)
                ->where('status', 'approved')
                ->sum('nominal_donasi');

            $item->total_donasi = $donasi ? $donasi : 0;

            if ($jamaah) {
                $item->nama = $jamaah->nama;
            } else {
                $item->nama = null;
            }
            return $item;
        });
        return view('user.dashboard.user', compact('module', 'jadwalJumat', 'donasis', 'kegiatans', 'donaturTetaps'));
    }

    public function areaChart(Request $request)
    {
        $date = $request->input('date'); // ex: 2025-05-01

        if (!$date || !\Carbon\Carbon::hasFormat($date, 'Y-m-d')) {
            return response()->json([
                'message' => 'Tanggal tidak valid atau kosong.',
            ], 400);
        }

        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        $monthsIndonesian = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $result = [
            'labels' => [],
            'pemasukan' => [],
            'pengeluaran' => [],
        ];

        $daysInMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $label = $day . ' ' . $monthsIndonesian[$month];
            $result['labels'][] = $label;

            $dateFormatted = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

            // Filter created_at berdasarkan tahun, bulan, dan tanggal
            $pemasukanCampaign = DonasiCampaign::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'approved')
                ->sum('nominal_donasi');

            $pemasukanDonaturTetap = DonasiDonaturTetap::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'approved')
                ->sum('nominal_donasi');

            // Perbaikan di bagian Realisasi
            $tanggalRealisasiFormatted = str_pad($day, 2, '0', STR_PAD_LEFT) . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $year;

            $pengeluaran = Realisasi::where('tanggal_realisasi', $tanggalRealisasiFormatted)
                ->sum('jumlah');

            $result['pemasukan'][] = $pemasukanCampaign + $pemasukanDonaturTetap;
            $result['pengeluaran'][] = $pengeluaran;
        }

        // Filter data jika pemasukan dan pengeluaran = 0
        $filteredResult = [
            'labels' => [],
            'pemasukan' => [],
            'pengeluaran' => [],
        ];

        foreach ($result['labels'] as $i => $label) {
            if ($result['pemasukan'][$i] != 0 || $result['pengeluaran'][$i] != 0) {
                $filteredResult['labels'][] = $label;
                $filteredResult['pemasukan'][] = $result['pemasukan'][$i];
                $filteredResult['pengeluaran'][] = $result['pengeluaran'][$i];
            }
        }

        return $this->sendResponse($filteredResult, 'Get data success');
    }

    public function about()
    {
        $module = 'About';
        $sejarah = Sejarah::first();
        $visi = VisiMisi::where('kategori', 'Visi')->get();
        $misi = VisiMisi::where('kategori', 'Misi')->get();
        return view('user.about.index', compact('module', 'sejarah', 'visi', 'misi'));
    }

    public function monitorin()
    {
        $module = 'Monitoring';
        $today = Carbon::today();
        $jadwalJumat = JadwalJumat::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->first();
        $kegiatans = Kegiatan::latest()->get();

        $campaign = DonasiCampaign::where('status', 'approved')->sum('nominal_donasi');
        $donaturTetap = DonasiDonaturTetap::where('status', 'approved')->sum('nominal_donasi');
        $donasiRealisasi = Realisasi::sum('jumlah');

        $kas = $campaign + $donaturTetap - $donasiRealisasi;
        return view('user.monitoring.index', compact('module', 'jadwalJumat', 'kegiatans', 'kas'));
    }
}
