<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisInventarisRequest;
use App\Http\Requests\UpdateJenisInventarisRequest;
use App\Models\JenisInventaris;

class JenisInventarisController extends BaseController
{
    public function index()
    {
        $module = 'Jenis Inventaris';
        return view('admin.jenisinventaris.index', compact('module'));
    }

    public function get()
    {
        $jenisInventaris = JenisInventaris::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($jenisInventaris, 'Get data success');
    }

    public function add(StoreJenisInventarisRequest $request)
    {
        $data = $request->validated();
        $jenisInventaris = JenisInventaris::create($data);
        return $this->sendResponse($jenisInventaris, 'Tambah data berhasil');
    }

    public function show($uuid)
    {
        $data = [];
        try {
            $data = JenisInventaris::where('uuid', $uuid)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateJenisInventarisRequest $request, $uuid)
    {
        $data = JenisInventaris::where('uuid', $uuid)->first();
        if (!$data) {
            return $this->sendError('Data jenis inventaris tidak ditemukan', 'Data not found', 404);
        }
        $dataUpdate = $request->validated();
        $data->update($dataUpdate);
        return $this->sendResponse($data, 'Perubahan data jenis inventaris berhasil');
    }

    public function delete($uuid)
    {
        $data = JenisInventaris::where('uuid', $uuid)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Data jenis inventaris berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
