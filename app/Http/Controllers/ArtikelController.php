<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\File;

class ArtikelController extends BaseController
{
    public function index()
    {
        $module = 'Artikel';
        return view('admin.artikel.index', compact('module'));
    }

    public function get()
    {
        $artikels = Artikel::with('kategori')->orderBy('created_at', 'desc')->get();
        return $this->sendResponse($artikels, 'Get data success');
    }

    public function add(StoreArtikelRequest $request)
    {
        $newPhoto = '';
        if ($request->file('photo')) {
            $extension = $request->file('photo')->extension();
            $newPhoto = 'artikel' . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/artikel', $newPhoto);
        }

        $data = $request->validated();
        $data['photo'] = $newPhoto;
        $artikel = Artikel::create($data);
        return $this->sendResponse($artikel, 'Add data success');
    }

    public function show($params)
    {
        $data = [];
        try {
            $data = Artikel::with('kategori')->where('id', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateArtikelRequest $request, $params)
    {
        $data = Artikel::where('id', $params)->first();
        if ($request->file('photo')) {
            $oldPhotoPath = public_path('public/artikel/' . $data->photo);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }
            $extension = $request->file('photo')->extension();
            $newPhoto = 'artikel' . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/artikel', $newPhoto);
        } else {
            $newPhoto = $data->photo;
        }

        $dataUpdate = $request->validated();
        $dataUpdate['photo'] = $newPhoto;

        Artikel::where('id', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Update data success');
    }

    public function delete($params)
    {
        $data = Artikel::where('id', $params)->first();
        if ($data) {
            $oldPhotoPath = public_path('public/artikel/' . $data->photo);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }
            $data->delete();
            return $this->sendResponse([], 'Delete data success');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    // View for user landing page
    public function landingPage()
    {
        $module = 'Artikel';
        $artikels = Artikel::with('kategori')->where('status', 'published')->orderBy('created_at', 'desc')->paginate(6);
        return view('user.artikel.index', compact('module', 'artikels'));
    }

    // View for user article detail
    public function showUser($slug)
    {
        $artikel = Artikel::with('kategori')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $module = 'Artikel';
        return view('user.artikel.detail', compact('artikel', 'module'));
    }

     public function index_artikel_user()
    {
        $module = 'Artikel';
        $artikels = Artikel::orderBy('created_at', 'desc')->paginate(6);
        return view('user.artikel.index', compact('module', 'artikels'));
    }

    public function detail_artikel_user($params)
    {
        $data = Artikel::where('uuid', $params)->first();
        $module = $data->judul;
        $artikelLainnya = Artikel::latest()->take(4)->get();
        return view('user.artikel.detail', compact('module', 'data', 'artikelLainnya'));
    }
}
