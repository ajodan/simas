<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokumentasiRequest;
use App\Http\Requests\UpdateDokumentasiRequest;
use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\File;

class DokumentasiController extends BaseController
{
    public function index()
    {
        $module = 'Dokumentasi';
        return view('admin.dokumentasi.index', compact('module'));
    }

    public function get()
    {
        $dokumentasi = Dokumentasi::with('kegiatan')->orderBy('created_at', 'desc')->get();
        return $this->sendResponse($dokumentasi, 'Get data success');
    }

    public function add(StoreDokumentasiRequest $request)
    {
        $newFoto = '';
        if ($request->file('foto')) {
            $extension = $request->file('foto')->extension();
            $newFoto = 'dokumentasi' . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('public/dokumentasi', $newFoto);
        }

        // Gabungkan hasil validasi + foto
        $data = $request->validated();
        $data['foto'] = $newFoto;
        $dokumentasi = Dokumentasi::create($data);
        return $this->sendResponse($dokumentasi, 'Add data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Dokumentasi::with('kegiatan')->where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateDokumentasiRequest $request, $params)
    {
        $data = Dokumentasi::where('uuid', $params)->first();
        if ($request->file('foto')) {
            $oldFotoPath = public_path('public/dokumentasi/' . $data->foto);
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }
            $extension = $request->file('foto')->extension();
            $newFoto = 'dokumentasi' . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('public/dokumentasi', $newFoto);
        } else {
            $newFoto = $data->foto;
        }

        // Gabungkan hasil validasi + foto
        $dataUpdate = $request->validated();
        $dataUpdate['foto'] = $newFoto;

        Dokumentasi::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Update data success');
    }

    public function delete($params)
    {
        $data = Dokumentasi::where('uuid', $params)->first();
        if ($data) {
            $oldFotoPath = public_path('public/dokumentasi/' . $data->foto);
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    // View for user
    public function dokumentasi()
    {
        $module = 'Dokumentasi';
        $data = Dokumentasi::with('kegiatan')->orderBy('created_at', 'desc')->paginate(6);
        return view('user.dokumentasi.index', compact('module', 'data'));
    }
}
