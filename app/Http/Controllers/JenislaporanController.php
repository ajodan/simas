<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisLaporanRequest;
use App\Http\Requests\UpdateJenisLaporanRequest;
use App\Models\JenisLaporan;
use Illuminate\Support\Facades\File;

class JenislaporanController extends BaseController
{
    public function index()
    {
        $module = 'Jenis Laporan';
        return view('admin.jenislaporan.index', compact('module'));
    }

    public function get()
    {
        $jenislaporan = JenisLaporan::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($jenislaporan, 'Get data success');
    }

    public function add(StoreJenisLaporanRequest $request)
    {
        // Gabungkan hasil validasi
        $data = $request->validated();
        $jenislaporan = JenisLaporan::create($data);
        return $this->sendResponse($jenislaporan, 'Tambah data berhasil');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = JenisLaporan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateJenisLaporanRequest $request, $params)
    {
        $data = JenisLaporan::where('uuid', $params)->first();

        // Gabungkan hasil validasi
        $dataUpdate = $request->validated();

        JenisLaporan::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Perubahan data jenis laporan berhasil');
    }

    public function delete($params)
    {
        $data = JenisLaporan::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Data jenis laporan berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
