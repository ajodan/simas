<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanKeuanganRequest;
use App\Http\Requests\UpdateLaporanKeuanganRequest;
use App\Models\JenisLaporan;
use App\Models\LaporanKeuangan;
use Illuminate\Support\Facades\File;

class LaporanKeuanganController extends BaseController
{
    public function index()
    {
        $module = 'Data Laporan Keuangan';
        $jenisLaporans = JenisLaporan::all();
        return view('admin.laporan-keuangan.index', compact('module', 'jenisLaporans'));
    }

    public function get()
    {
        $laporanKeuangan = LaporanKeuangan::with('jenisLaporan')->orderBy('created_at', 'desc')->get();
        return $this->sendResponse($laporanKeuangan, 'Get data success');
    }

    public function add(StoreLaporanKeuanganRequest $request)
    {
        $newFile = '';
        if ($request->file('upload_file')) {
            $extension = $request->file('upload_file')->extension();
            $newFile = 'file' . '-' . now()->timestamp . '.' . $extension;
            $request->file('upload_file')->storeAs('laporan-keuangan', $newFile);
        }

        // Gabungkan hasil validasi + file
        $data = $request->validated();
        $data['upload_file'] = $newFile;
        $laporanKeuangan = LaporanKeuangan::create($data);
        return $this->sendResponse($laporanKeuangan, 'Add data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = LaporanKeuangan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateLaporanKeuanganRequest $request, $params)
    {
        $data = LaporanKeuangan::where('uuid', $params)->first();
        if ($request->file('upload_file')) {
            $oldFilePath = public_path('laporan-keuangan/' . $data->upload_file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $extension = $request->file('upload_file')->extension();
            $newFile = 'file' . '-' . now()->timestamp . '.' . $extension;
            $request->file('upload_file')->storeAs('public/laporan-keuangan', $newFile);
        } else {
            $newFile = $data->upload_file;
        }

        // Gabungkan hasil validasi + file
        $dataUpdate = $request->validated();
        $dataUpdate['upload_file'] = $newFile;

        LaporanKeuangan::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Update data success');
    }

    public function delete($params)
    {
        $data = LaporanKeuangan::where('uuid', $params)->first();
        if ($data) {
            $oldFilePath = public_path('laporan-keuangan/' . $data->upload_file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
