<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonasiDonaturTetapRequest;
use App\Http\Requests\StoreDonaturTetapRequest;
use App\Http\Requests\UpdateDonaturTetapRequest;
use App\Models\DataJamaah;
use App\Models\DonasiDonaturTetap;
use App\Models\DonaturTetap;

class DonaturTetapController extends BaseController
{
    public function index()
    {
        $module = 'Donatur Tetap';
        return view('admin.donaturtetap.index', compact('module'));
    }

    public function list_donasi($params)
    {
        $donaturTetap = DonaturTetap::where('uuid', $params)->first();
        $jamaah = DataJamaah::where('uuid', $donaturTetap->uuid_user)->first();
        $module = 'List Donasi Donatur ' . $jamaah->nama;
        return view('admin.donaturtetap.list', compact('module'));
    }

    public function get_list_donasi($params)
    {
        $donaturTetap = DonaturTetap::where('uuid', $params)->first();
        if (!$donaturTetap) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data = DonasiDonaturTetap::where('uuid_donatur', $donaturTetap->uuid)->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function aprove_donasi_tetap($params)
    {
        $data = DonasiDonaturTetap::where('uuid', $params)->first();
        try {
            $data->status = 'approved';
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Donasi approved successfully');
    }

    public function get()
    {
        $donaturTetap = DonaturTetap::all();
        $donaturTetap->map(function ($item) {
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
        return $this->sendResponse($donaturTetap, 'Get data success');
    }

    public function add(StoreDonaturTetapRequest $request)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $request->nominal);
        $data['nominal'] = $numericValue;
        $data = DonaturTetap::create($request->validated());
        return $this->sendResponse($data, 'Add data success');
    }

    public function show($params)
    {
        $data = DonaturTetap::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        return $this->sendResponse($data, 'Get data success');
    }

    public function update(StoreDonaturTetapRequest $request, $params)
    {
        $data = DonaturTetap::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data->update($request->validated());
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = DonaturTetap::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Delete data success');
    }

    // User

    public function donatur_tetap_jamaah($params)
    {
        $module = 'Donatur Tetap';
        $donaturTetap = DonaturTetap::where('uuid', $params)->first();
        if ($donaturTetap) {
            $jamaah = DataJamaah::where('uuid', $donaturTetap->uuid_user)->first();

            $donaturTetap->nama = $jamaah->nama;
        }

        return view('user.donaturtetap.index', compact('module', 'donaturTetap'));
    }

    public function donasi_donatur_tetap(StoreDonasiDonaturTetapRequest $store)
    {
        $newBukti = '';
        if ($store->file('bukti_transfer')) {
            $extension = $store->file('bukti_transfer')->extension();
            $newBukti = $store->nama_pendonasi . '-' . now()->timestamp . '.' . $extension;
            $store->file('bukti_transfer')->storeAs('public/buktidonaturtetap', $newBukti);
        }

        $numericValue = str_replace(['Rp', '.', ' '], '', $store->nominal_donasi);

        try {
            $data = new DonasiDonaturTetap();
            $data->uuid_donatur = $store->uuid_donatur;
            $data->nama_pendonasi = $store->nama_pendonasi;
            $data->nominal_donasi = $numericValue;
            $data->bukti_transfer = $newBukti;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Donasi Berhasil dikirim, tunggu konfirmasi dari admin');
    }
}
