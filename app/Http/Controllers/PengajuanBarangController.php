<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanBarangRequest;
use App\Http\Requests\UpdatePengajuanBarangRequest;
use App\Models\PengajuanBarang;
use Illuminate\Http\Request;

class PengajuanBarangController extends BaseController
{
    public function index()
    {
        $module = 'Peminjaman Tempat';
        return view('admin.pengajuan.index', compact('module'));
    }

    public function get()
    {
        $data = PengajuanBarang::latest()->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function store(StorePengajuanBarangRequest $store)
    {
        $newSurat = '';
        if ($store->file('surat')) {
            $extension = $store->file('surat')->extension();
            $newSurat = 'surat' . now()->timestamp . '.' . $extension;
            $store->file('surat')->storeAs('public/pengajuan', $newSurat);
        }

        try {
            $data = new PengajuanBarang();
            $data->penanggung_jawab = $store->penanggung_jawab;
            $data->organisasi = $store->organisasi;
            $data->barang = '-';
            $data->nomor = $store->nomor;
            $data->surat = $newSurat;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Pengajuan berhasil di kirim');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = PengajuanBarang::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(Request $request, $params)
    {
        $data = PengajuanBarang::where('uuid', $params)->first();
        try {
            $data->status = $request->status;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = PengajuanBarang::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
