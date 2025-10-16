<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;
use App\Models\Inventaris;
use App\Models\JenisInventaris;
use Illuminate\Support\Facades\File;

class InventarisController extends BaseController
{
    public function index()
    {
        $module = 'Inventaris';
        $jenisInventaris = JenisInventaris::all();
        return view('admin.inventaris.index', compact('module', 'jenisInventaris'));
    }

    public function get()
    {
        $inventaris = Inventaris::with('jenisInventaris')->orderBy('created_at', 'desc')->get();
        return $this->sendResponse($inventaris, 'Get data success');
    }

    public function add(StoreInventarisRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->extension();
            $newPhoto = 'inventaris-' . now()->timestamp . '-' . uniqid() . '.' . $extension;
            $request->file('photo')->storeAs('inventaris', $newPhoto);
            $data['photo'] = $newPhoto;
        }

        $inventaris = Inventaris::create($data);
        return $this->sendResponse($inventaris, 'Tambah data berhasil');
    }

    public function show($uuid)
    {
        $data = [];
        try {
            $data = Inventaris::where('uuid', $uuid)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateInventarisRequest $request, $uuid)
    {
        $data = Inventaris::where('uuid', $uuid)->first();
        if (!$data) {
            return $this->sendError('Data inventaris tidak ditemukan', 'Data not found', 404);
        }
        $dataUpdate = $request->validated();

        if ($request->hasFile('photo')) {
            // Delete old photo
            $oldPhotoPath = public_path('storage/inventaris/' . $data->photo);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }

            $extension = $request->file('photo')->extension();
            $newPhoto = 'inventaris-' . now()->timestamp . '-' . uniqid() . '.' . $extension;
            $request->file('photo')->storeAs('inventaris', $newPhoto);
            $dataUpdate['photo'] = $newPhoto;
        }

        $data->update($dataUpdate);
        return $this->sendResponse($data, 'Perubahan data inventaris berhasil');
    }

    public function delete($uuid)
    {
        $data = Inventaris::where('uuid', $uuid)->first();
        if ($data) {
            // Delete photo
            $photoPath = public_path('storage/inventaris/' . $data->photo);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }

            $data->delete();
            return $this->sendResponse([], 'Data inventaris berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    public function index_inventaris_user()
    {
        $module = 'Inventaris';
        $inventaris = Inventaris::with('jenisInventaris')->orderBy('created_at', 'desc')->get();
        return view('user.inventaris.index', compact('module', 'inventaris'));
    }

    public function detail_inventaris_user($params)
    {
        $data = Inventaris::where('uuid', $params)->with('jenisInventaris')->first();
        $module = $data ? $data->nama_inventaris : 'Detail Inventaris';
        return view('user.inventaris.detail', compact('module', 'data'));
    }
}
