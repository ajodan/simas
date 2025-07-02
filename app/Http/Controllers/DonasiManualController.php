<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonasiManualRequest;
use App\Http\Requests\UpdateDonasiManualRequest;
use App\Models\DonasiManual;

class DonasiManualController extends BaseController
{
    public function index()
    {
        $module = 'Donasi Manual';
        return view('admin.donasimanual.index', compact('module'));
    }

    public function get()
    {
        $data = DonasiManual::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreDonasiManualRequest $request)
    {
        $validated = $request->validated();

        // Bersihkan nilai jumlah dari format mata uang
        $validated['jumlah'] = (int) str_replace(['Rp', ',', ' '], '', $validated['jumlah']);

        // Simpan data
        $data = DonasiManual::create($validated);

        return $this->sendResponse($data, 'Add data success');
    }

    public function show($params)
    {
        $data = DonasiManual::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        return $this->sendResponse($data, 'Get data success');
    }

    public function update(StoreDonasiManualRequest $request, $params)
    {
        $data = DonasiManual::where('uuid', $params)->first();
        $validated = $request->validated();

        // Bersihkan nilai jumlah dari format mata uang
        $validated['jumlah'] = (int) str_replace(['Rp', ',', ' '], '', $validated['jumlah']);

        // Simpan data
        $data->update($validated);
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = DonasiManual::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Delete data success');
    }
}
