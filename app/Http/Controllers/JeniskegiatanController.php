<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisKegiatanRequest;
use App\Http\Requests\UpdateJenisKegiatanRequest;
use App\Models\JenisKegiatan;
use Illuminate\Support\Facades\File;

class JeniskegiatanController extends BaseController
{
    public function index()
    {
        $module = 'Jenis Kegiatan';
        return view('admin.jeniskegiatan.index', compact('module'));
    }

    public function get()
    {
        $jeniskegiatan = JenisKegiatan::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($jeniskegiatan, 'Get data success');
    }

    public function add(StoreJenisKegiatanRequest $request)
    {
        // $newBanner = '';
        // if ($request->file('banner')) {
        //     $extension = $request->file('banner')->extension();
        //     $newBanner = 'banner' . '-' . now()->timestamp . '.' . $extension;
        //     $request->file('banner')->storeAs('public/jeniskegiatan', $newBanner);
        // }

        // Gabungkan hasil validasi + banner
        $data = $request->validated();
       // $data['banner'] = $newBanner;
        $jeniskegiatan = Jeniskegiatan::create($data);
        return $this->sendResponse($jeniskegiatan, 'Tambah data berhasil');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = JenisKegiatan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateJenisKegiatanRequest $request, $params)
    {
        $data = JenisKegiatan::where('uuid', $params)->first();

        // Gabungkan hasil validasi
        $dataUpdate = $request->validated();

        JenisKegiatan::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Perubahan data jenis kegiatan berhasil');
    }

    public function delete($params)
    {
        $data = JenisKegiatan::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Data jenis kegiatan berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    // View for user

    public function index_kegiatan_user()
    {
        $module = 'Kegiatan';
        $data = Kegiatan::orderBy('created_at', 'desc')->paginate(6);
        return view('user.kegiatan.index', compact('module', 'data'));
    }

    public function detail_kegiatan_user($params)
    {
        $data = Kegiatan::where('uuid', $params)->first();
        $module = $data->nama_kegiatan;
        $kegiatanLainnya = Kegiatan::latest()->take(4)->get();
        return view('user.kegiatan.detail', compact('module', 'data', 'kegiatanLainnya'));
    }
}
