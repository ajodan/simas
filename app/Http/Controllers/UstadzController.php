<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUstadzRequest;
use App\Http\Requests\UpdateUstadzRequest;
use App\Models\Ustadz;
use Illuminate\Support\Facades\File;

class UstadzController extends BaseController
{
    public function index()
    {
        $module = 'Data Ustadz';
        return view('admin.ustadz.index', compact('module'));
    }

    public function get()
    {
        $ustadz = Ustadz::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($ustadz, 'Get data success');
    }

    public function add(StoreUstadzRequest $request)
    {
        $newPhoto = '';
        if ($request->file('photo')) {
            $extension = $request->file('photo')->extension();
            $newPhoto = 'photo' . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/ustadz', $newPhoto);
        }

        // Gabungkan hasil validasi + photo
        $data = $request->validated();
        $data['photo'] = $newPhoto;
        $ustadz = Ustadz::create($data);
        return $this->sendResponse($ustadz, 'Add data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Ustadz::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateUstadzRequest $request, $params)
    {
        $data = Ustadz::where('uuid', $params)->first();
        if ($request->file('photo')) {
            $oldPhotoPath = public_path('public/ustadz/' . $data->photo);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }
            $extension = $request->file('photo')->extension();
            $newPhoto = 'photo' . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/ustadz', $newPhoto);
        } else {
            $newPhoto = $data->photo;
        }

        // Gabungkan hasil validasi + photo
        $dataUpdate = $request->validated();
        $dataUpdate['photo'] = $newPhoto;

        Ustadz::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Update data success');
    }

    public function delete($params)
    {
        $data = Ustadz::where('uuid', $params)->first();
        if ($data) {
            $oldPhotoPath = public_path('public/ustadz/' . $data->photo);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }
}
