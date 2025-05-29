<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSejarahRequest;
use App\Http\Requests\UpdateSejarahRequest;
use App\Models\Sejarah;

class SejarahController extends BaseController
{
    public function index()
    {
        $module = 'Sejarah';
        return view('admin.sejarah.index', compact('module'));
    }

    public function get()
    {
        $data = Sejarah::latest()->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function add(StoreSejarahRequest $request)
    {
        $data = $request->validated();
        $sejarah = Sejarah::create($data);
        return $this->sendResponse($sejarah, 'Data created success');
    }

    public function show($params)
    {
        $sejarah = Sejarah::where('uuid', $params)->firstOrFail();
        return $this->sendResponse($sejarah, 'Data retrieved successfully');
    }

    public function update(StoreSejarahRequest $request, $params)
    {
        $sejarah = Sejarah::where('uuid', $params)->firstOrFail();
        $data = $request->validated();
        $sejarah->update($data);
        return $this->sendResponse($sejarah, 'Data updated successfully');
    }

    public function delete($params)
    {
        $sejarah = Sejarah::where('uuid', $params)->firstOrFail();
        $sejarah->delete();
        return $this->sendResponse([], 'Data deleted successfully');
    }
}
