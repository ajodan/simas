<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRealisasiRequest;
use App\Http\Requests\UpdateRealisasiRequest;
use App\Models\Realisasi;

class RealisasiController extends BaseController
{
    public function index()
    {
        $module = 'Catat Pengeluaran';
        return view('admin.realisasi.index', compact('module'));
    }

    public function get()
    {
        $data = Realisasi::latest()->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreRealisasiRequest $request)
    {
        $data = $request->validated();
        $data['jumlah'] = (int) str_replace(['Rp', ',', ' '], '', $request->jumlah);
        $data['keterangan'] = $request->keterangan;
        $realisasi = Realisasi::create($data);
        return $this->sendResponse($realisasi, 'Data created successfully');
    }

    public function show($params)
    {
        $realisasi = Realisasi::where('uuid', $params)->firstOrFail();
        return $this->sendResponse($realisasi, 'Data retrieved successfully');
    }

    public function update(StoreRealisasiRequest $request, $params)
    {
        $realisasi = Realisasi::where('uuid', $params)->firstOrFail();
        $data = $request->validated();
        $data['jumlah'] = (int) str_replace(['Rp', ',', ' '], '', $request->jumlah);
        $data['keterangan'] = $request->keterangan;
        $realisasi->update($data);
        return $this->sendResponse($realisasi, 'Data updated successfully');
    }

    public function delete($params)
    {
        $realisasi = Realisasi::where('uuid', $params)->firstOrFail();
        $realisasi->delete();
        return $this->sendResponse([], 'Data deleted successfully');
    }
}
