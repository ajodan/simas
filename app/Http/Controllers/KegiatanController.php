<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\File;

class KegiatanController extends BaseController
{
    public function index()
    {
        $module = 'Kegiatan';
        return view('admin.kegiatan.index', compact('module'));
    }

    public function get()
    {
        $kegiatan = Kegiatan::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($kegiatan, 'Get data success');
    }

    public function add(StoreKegiatanRequest $request)
    {
        $newBanner = '';
        if ($request->file('banner')) {
            $extension = $request->file('banner')->extension();
            $newBanner = 'banner' . '-' . now()->timestamp . '.' . $extension;
            $request->file('banner')->storeAs('public/kegiatan', $newBanner);
        }

        // Gabungkan hasil validasi + banner
        $data = $request->validated();
        $data['banner'] = $newBanner;
        $kegiatan = Kegiatan::create($data);
        return $this->sendResponse($kegiatan, 'Add data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Kegiatan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateKegiatanRequest $request, $params)
    {
        $data = Kegiatan::where('uuid', $params)->first();
        if ($request->file('banner')) {
            $oldBannerPath = public_path('public/kegiatan/' . $data->banner);
            if (File::exists($oldBannerPath)) {
                File::delete($oldBannerPath);
            }
            $extension = $request->file('banner')->extension();
            $newBanner = 'banner' . '-' . now()->timestamp . '.' . $extension;
            $request->file('banner')->storeAs('public/kegiatan', $newBanner);
        } else {
            $newBanner = $data->banner;
        }

        // Gabungkan hasil validasi + banner
        $dataUpdate = $request->validated();
        $dataUpdate['banner'] = $newBanner;

        Kegiatan::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Update data success');
    }

    public function delete($params)
    {
        $data = Kegiatan::where('uuid', $params)->first();
        if ($data) {
            $oldBannerPath = public_path('public/kegiatan/' . $data->banner);
            if (File::exists($oldBannerPath)) {
                File::delete($oldBannerPath);
            }
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    // View for user

    public function index_kegiatan_user()
    {
        $module = 'Kegiatan';
        $data = Kegiatan::orderBy('created_at', 'desc')->get();
        return view('user.kegiatan.index', compact('module', 'data'));
    }

    public function detail_kegiatan_user($params)
    {
        $module = 'Detail Kegiatan';
        $data = Kegiatan::where('uuid', $params)->first();
        return view('user.kegiatan.detail', compact('module', 'data'));
    }
}
