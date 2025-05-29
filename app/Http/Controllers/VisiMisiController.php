<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisiMisiRequest;
use App\Http\Requests\UpdateVisiMisiRequest;
use App\Models\VisiMisi;

class VisiMisiController extends BaseController
{
    public function index()
    {
        $module = 'Visi Misi';
        return view('admin.visimisi.index', compact('module'));
    }

    public function get()
    {
        $data = VisiMisi::latest()->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreVisiMisiRequest $request)
    {
        $data = $request->validated();
        $visimisi = VisiMisi::create($data);
        return $this->sendResponse($visimisi, 'Data created success');
    }

    public function show($params)
    {
        $visimisi = VisiMisi::where('uuid', $params)->firstOrFail();
        return $this->sendResponse($visimisi, 'Data retrieved successfully');
    }

    public function update(StoreVisiMisiRequest $request, $params)
    {
        $visimisi = VisiMisi::where('uuid', $params)->firstOrFail();
        $data = $request->validated();
        $visimisi->update($data);
        return $this->sendResponse($visimisi, 'Data updated successfully');
    }

    public function delete($params)
    {
        $visimisi = VisiMisi::where('uuid', $params)->firstOrFail();
        $visimisi->delete();
        return $this->sendResponse([], 'Data deleted successfully');
    }
}
