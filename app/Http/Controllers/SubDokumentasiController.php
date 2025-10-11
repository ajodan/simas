<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubDokumentasiRequest;
use App\Http\Requests\UpdateSubDokumentasiRequest;
use App\Models\SubDokumentasi;
use Illuminate\Support\Facades\File;

class SubDokumentasiController extends BaseController
{
    public function index($dokumentasi_uuid = null)
    {
        $module = 'Sub Dokumentasi';
        $dokumentasi = null;
        if ($dokumentasi_uuid) {
            $dokumentasi = \App\Models\Dokumentasi::where('uuid', $dokumentasi_uuid)->first();
            $module = 'Sub Dokumentasi untuk ' . ($dokumentasi ? $dokumentasi->judul : 'Dokumentasi');
        }
        return view('admin.sub-dokumentasi.index', compact('module', 'dokumentasi'));
    }

    public function get()
    {
        $query = SubDokumentasi::with('dokumentasi')->orderBy('created_at', 'desc');
        if (request('dokumentasi_uuid')) {
            $dokumentasi = \App\Models\Dokumentasi::where('uuid', request('dokumentasi_uuid'))->first();
            if ($dokumentasi) {
                $query->where('dokumentasi_id', $dokumentasi->id);
            }
        }
        $subDokumentasi = $query->get();
        return $this->sendResponse($subDokumentasi, 'Get data success');
    }

    public function add(StoreSubDokumentasiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->extension();
            $newFoto = 'foto' . '-' . now()->timestamp . '-' . uniqid() . '.' . $extension;
            $request->file('foto')->storeAs('public/dokumentasi', $newFoto);
            $data['foto'] = $newFoto;
        }

        $subDokumentasi = SubDokumentasi::create($data);
         return $this->sendResponse($subDokumentasi, 'Add data success');

    }

    public function show($params)
    {
        $data = SubDokumentasi::with('dokumentasi')->where('id', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateSubDokumentasiRequest $request, $params)
    {
        $subDokumentasi = SubDokumentasi::find($params);
        if (!$subDokumentasi) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Delete old foto
            $oldFotoPath = public_path('public/dokumentasi/' . $subDokumentasi->foto);
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }

            $extension = $request->file('foto')->extension();
            $newFoto = 'sub-dokumentasi-' . now()->timestamp . '-' . uniqid() . '.' . $extension;
            $request->file('foto')->storeAs('public/dokumentasi', $newFoto);
            $data['foto'] = $newFoto;
        }

        $subDokumentasi->update($data);
        return $this->sendResponse($subDokumentasi->load('dokumentasi'), 'Update data success');
    }

    public function delete($params)
    {
        $subDokumentasi = SubDokumentasi::find($params);
        if (!$subDokumentasi) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }

        // Delete foto
        $fotoPath = public_path('public/dokumentasi/' . $subDokumentasi->foto);
        if (File::exists($fotoPath)) {
            File::delete($fotoPath);
        }

        $subDokumentasi->delete();
        return $this->sendResponse([], 'Delete data success');
    }
}
