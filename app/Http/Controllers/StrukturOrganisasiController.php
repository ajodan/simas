<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStrukturOrganisasiRequest;
use App\Http\Requests\UpdateStrukturOrganisasiRequest;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends BaseController
{
    public function index()
    {
        $module = 'Struktur Organisasi';
        return view('admin.strukturrganisasi.index', compact('module'));
    }

    public function get()
    {
        $data = StrukturOrganisasi::latest()->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(Request $request)
    {
        $data = $request->only([
            'nama',
            'posisi',
            'unit'
        ]);
        $sejarah = StrukturOrganisasi::create($data);
        return $this->sendResponse($sejarah, 'Data created success');
    }

    public function show($params)
    {
        $sejarah = StrukturOrganisasi::where('uuid', $params)->firstOrFail();
        return $this->sendResponse($sejarah, 'Data retrieved successfully');
    }

    public function update(Request $request, $params)
    {
        $sejarah = StrukturOrganisasi::where('uuid', $params)->firstOrFail();
        $data = $request->only([
            'nama',
            'posisi',
            'unit'
        ]);
        $sejarah->update($data);
        return $this->sendResponse($sejarah, 'Data updated successfully');
    }

    public function delete($params)
    {
        $sejarah = StrukturOrganisasi::where('uuid', $params)->firstOrFail();
        $sejarah->delete();
        return $this->sendResponse([], 'Data deleted successfully');
    }
}
