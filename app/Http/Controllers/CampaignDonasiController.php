<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignDonasiRequest;
use App\Http\Requests\StoreDonasiCampaignRequest;
use App\Http\Requests\UpdateCampaignDonasiRequest;
use App\Models\CampaignDonasi;
use App\Models\DonasiCampaign;
use Illuminate\Support\Facades\File;

class CampaignDonasiController extends BaseController
{
    public function index()
    {
        $module = 'Campaign Donasi';
        return view('admin.campaigndonasi.index', compact('module'));
    }

    public function get()
    {
        $data = CampaignDonasi::all();
        $data->each(function ($item) {
            $donasiCampaigns = DonasiCampaign::where('uuid_campaign', $item->uuid)
                ->where('status', 'approved')
                ->get();
            $item->total_donasi = $donasiCampaigns->sum('nominal_donasi');
        });
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreCampaignDonasiRequest $store_campaign_donasi_request)
    {
        $newGambar = '';
        if ($store_campaign_donasi_request->file('gambar')) {
            $extension = $store_campaign_donasi_request->file('gambar')->extension();
            $newGambar = $store_campaign_donasi_request->judul . '-' . now()->timestamp . '.' . $extension;
            $store_campaign_donasi_request->file('gambar')->storeAs('public/campaign', $newGambar);
        }

        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $store_campaign_donasi_request->target_dana);

        try {
            $data = new CampaignDonasi();
            $data->judul = $store_campaign_donasi_request->judul;
            $data->deskripsi = $store_campaign_donasi_request->deskripsi;
            $data->target_dana = $numericValue;
            $data->tanggal_mulai = $store_campaign_donasi_request->tanggal_mulai;
            $data->tanggal_selesai = $store_campaign_donasi_request->tanggal_selesai;
            $data->gambar = $newGambar;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Add data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = CampaignDonasi::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateCampaignDonasiRequest $update_campaign_donasi_request, $params)
    {
        $data = CampaignDonasi::where('uuid', $params)->first();
        if ($update_campaign_donasi_request->hasFile('gambar')) {
            $oldFotoPath = public_path('public/campaign/' . $data->gambar);
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }

            $gambarFile = $update_campaign_donasi_request->file('gambar');
            $gambar = $update_campaign_donasi_request->judul . now()->timestamp . '.' . $gambarFile->extension();
            $gambarFile->storeAs('public/campaign', $gambar);
        } else {
            $gambar = $data->gambar;
        }

        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $update_campaign_donasi_request->target_dana);

        try {
            $data->judul = $update_campaign_donasi_request->judul;
            $data->deskripsi = $update_campaign_donasi_request->deskripsi;
            $data->target_dana = $numericValue;
            $data->tanggal_mulai = $update_campaign_donasi_request->tanggal_mulai;
            $data->tanggal_selesai = $update_campaign_donasi_request->tanggal_selesai;
            $data->gambar = $gambar;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = CampaignDonasi::where('uuid', $params)->first();
            $oldGambarPath = public_path('public/campaign/' . $data->gambar);
            if (File::exists($oldGambarPath)) {
                File::delete($oldGambarPath);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }

    //!SECTION User Campaign Donasi
    public function donasi_campaign_user()
    {
        $module = 'Campaign Donasi';
        $data = CampaignDonasi::where('status', true)
            ->latest()
            ->paginate(6);

        $data->getCollection()->transform(function ($item) {
            $totalDonasi = DonasiCampaign::where('uuid_campaign', $item->uuid)
                ->where('status', 'approved')
                ->sum('nominal_donasi');

            $item->total_donasi = $totalDonasi;
            return $item;
        });
        return view('user.campaigndonasi.index', compact('module', 'data'));
    }

    public function detail_donasi_campaign($params)
    {
        $data = CampaignDonasi::where('uuid', $params)->first();
        if (!$data) {
            return redirect()->route('user.dashboard.user')->with('error', 'Campaign not found');
        }
        $module = $data->judul;

        $dataPendonasis = DonasiCampaign::where('uuid_campaign', $data->uuid)->where('status', 'approved')->get();
        $totalDonasi = $dataPendonasis->sum('nominal_donasi');

        $dataDonasiTerbaru = CampaignDonasi::latest()->take(4)->get();
        return view('user.campaigndonasi.detail', compact('module', 'data', 'dataPendonasis', 'totalDonasi', 'dataDonasiTerbaru'));
    }

    public function donasi_campaign(StoreDonasiCampaignRequest $store)
    {
        $newBukti = '';
        if ($store->file('bukti_transfer')) {
            $extension = $store->file('bukti_transfer')->extension();
            $newBukti = $store->nama_pendonasi ? $store->nama_pendonasi : 'Anonim' . '-' . now()->timestamp . '.' . $extension;
            $store->file('bukti_transfer')->storeAs('public/bukticampaign', $newBukti);
        }

        $numericValue = str_replace(['Rp', '.', ' '], '', $store->nominal_donasi);

        try {
            $data = new DonasiCampaign();
            $data->uuid_campaign = $store->uuid_campaign;
            $data->nama_pendonasi = $store->nama_pendonasi ? $store->nama_pendonasi : 'Anonim';
            $data->nominal_donasi = $numericValue;
            $data->bukti_transfer = $newBukti;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Donasi Berhasil dikirim, tunggu konfirmasi dari admin');
    }

    public function update_tombol($params)
    {
        $data = CampaignDonasi::where('uuid', $params)->first();
        try {
            if ($data->status == true) {
                $data->status = false;
            } elseif ($data->status == false) {
                $data->status = true;
            }
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update tombol success');
    }

    public function list_donasi_campaign($params)
    {
        $data = CampaignDonasi::where('uuid', $params)->first();
        $module = 'List Donasi ' . $data->judul;
        return view('admin.campaigndonasi.list', compact('module'));
    }

    public function get_list_donasi_campaign($params)
    {
        $data = DonasiCampaign::where('uuid_campaign', $params)->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function aprove_donasi_campaign($params)
    {
        $data = DonasiCampaign::where('uuid', $params)->first();
        try {
            $data->status = 'approved';
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Donasi campaign approved successfully');
    }

    public function delete_donasi_campaign($params)
    {
        $data = DonasiCampaign::where('uuid', $params)->first();
        try {
            $oldBuktiPath = public_path('public/bukticampaign/' . $data->bukti_transfer);
            if (File::exists($oldBuktiPath)) {
                File::delete($oldBuktiPath);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete donasi campaign success');
    }
}
