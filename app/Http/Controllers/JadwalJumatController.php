<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalJumatRequest;
use App\Http\Requests\UpdateJadwalJumatRequest;
use App\Models\JadwalJumat;
use Illuminate\Support\Facades\File;

class JadwalJumatController extends BaseController
{
    public function index()
    {
        $module = 'Jadwal Jumat';
        return view('admin.jadwaljumat.index', compact('module'));
    }

    public function get()
    {
        $jadwalJumat = JadwalJumat::all();
        return $this->sendResponse($jadwalJumat, 'Get data success');
    }

    public function add(StoreJadwalJumatRequest $request)
    {
        // Gabungkan hasil validasi + banner
        $data = $request->validated();

        $jadwal = JadwalJumat::create($data);
        return $this->sendResponse($jadwal, 'Add data success');
    }


    public function show($params)
    {
        $data = array();
        try {
            $data = JadwalJumat::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateJadwalJumatRequest $request, $params)
    {
        $jadwal = JadwalJumat::where('uuid', $params)->first();

        if (!$jadwal) {
            return $this->sendError('Data tidak ditemukan', 404);
        }

        $validated = $request->validated();

        // Update model
        $jadwal->update($validated);

        return $this->sendResponse($jadwal, 'Update data success');
    }

    public function delete($params)
    {
        $data = JadwalJumat::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse($data, 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
