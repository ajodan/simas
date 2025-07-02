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
        $newBanner = '';
        if ($request->file('banner')) {
            $extension = $request->file('banner')->extension();
            $newBanner = 'banner' . '-' . now()->timestamp . '.' . $extension;
            $request->file('banner')->storeAs('public/banner', $newBanner);
        }

        // Gabungkan hasil validasi + banner
        $data = $request->validated();
        $data['banner'] = $newBanner;

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

        if ($request->file('banner')) {
            $oldBannerPath = public_path('public/banner/' . $jadwal->banner);
            if (File::exists($oldBannerPath)) {
                File::delete($oldBannerPath);
            }

            $extension = $request->file('banner')->extension();
            $newBanner = 'banner-' . now()->timestamp . '.' . $extension;
            $request->file('banner')->storeAs('public/banner', $newBanner);

            // Tambahkan banner ke array validated
            $validated['banner'] = $newBanner;
        }

        // Update model
        $jadwal->update($validated);

        return $this->sendResponse($jadwal, 'Update data success');
    }

    public function delete($params)
    {
        $data = JadwalJumat::where('uuid', $params)->first();
        if ($data) {
            $oldBannerPath = public_path('public/banner/' . $data->banner);
            if (File::exists($oldBannerPath)) {
                File::delete($oldBannerPath);
            }
            $data->delete();
            return $this->sendResponse($data, 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
