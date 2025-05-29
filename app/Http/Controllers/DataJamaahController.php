<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataJamaahRequest;
use App\Http\Requests\UpdateDataJamaahRequest;
use App\Models\DataJamaah;
use Illuminate\Contracts\Cache\Store;

class DataJamaahController extends BaseController
{
    public function index()
    {
        $module = 'Data Jamaah';
        return view('admin.jamaah.index', compact('module'));
    }

    public function get()
    {
        $data = DataJamaah::all();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreDataJamaahRequest $request)
    {
        $data = DataJamaah::create($request->validated());
        return $this->sendResponse($data, 'Add data success');
    }

    public function show($params)
    {
        $data = DataJamaah::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        return $this->sendResponse($data, 'Get data success');
    }

    public function update(StoreDataJamaahRequest $request, $params)
    {
        $data = DataJamaah::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data->update($request->validated());
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = DataJamaah::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Delete data success');
    }
}
