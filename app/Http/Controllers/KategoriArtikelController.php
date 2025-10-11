<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriArtikelRequest;
use App\Http\Requests\UpdateKategoriArtikelRequest;
use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\File;

class KategoriArtikelController extends BaseController
{
    public function index()
    {
        $module = 'Kategori Artikel';
        return view('admin.kategori-artikel.index', compact('module'));
    }

    public function get()
    {
        $kategoriartikels = KategoriArtikel::orderBy('created_at', 'desc')->get();
        return $this->sendResponse($kategoriartikels, 'Get data success');
    }

    public function add(StoreKategoriArtikelRequest $request)
    {

        // Gabungkan hasil validasi + banner
        $data = $request->validated();
       // $data['banner'] = $newBanner;
        $kategoriartikel = KategoriArtikel::create($data);
        return $this->sendResponse($kategoriartikel, 'Tambah data berhasil');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = KategoriArtikel::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateKategoriArtikelRequest $request, $params)
    {
        $data = KategoriArtikel::where('uuid', $params)->first();

        if (!$data) {
            return $this->sendError('Data not found', 'Data not found', 404);
        }

        $data->update($request->validated());
        return $this->sendResponse($data, 'Perubahan data kategori artikel berhasil');
    }

    public function delete($params)
    {
        $data = KategoriArtikel::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Data kategori artikel berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

}
