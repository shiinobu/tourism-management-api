<?php

namespace App\Http\Controllers;

use App\Http\Resources\WisataResource as Data;
use App\Models\WisataModel;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index()
    {
        return Data::collection(WisataModel::all());
    }

    public function create()
    {
        // Not used by the API-only CRUD flow.
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_wisata' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $path = $this->storeImage($request->file('foto'));

        WisataModel::create([
            'nama_wisata' => $validated['nama_wisata'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $path,
        ]);

        return response()->json([
            'success' => 'Berhasil Menambah Data!',
        ], 201);
    }

    public function show($id)
    {
        $findData = WisataModel::find($id);

        if (!$findData) {
            return response()->json([
                'errors' => 'Data Wisata Tidak Ditemukan!',
            ], 404);
        }

        return new Data($findData);
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_wisata' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $findData = WisataModel::find($id);

        if (!$findData) {
            return response()->json([
                'errors' => 'Data Wisata Tidak Ditemukan!',
            ], 404);
        }

        $findData->nama_wisata = $validated['nama_wisata'];
        $findData->deskripsi = $validated['deskripsi'];

        if ($request->hasFile('foto')) {
            $oldPath = $findData->foto;
            $findData->foto = $this->storeImage($request->file('foto'));

            if ($oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $findData->save();

        return response()->json([
            'success' => 'Berhasil Merubah Data!',
        ]);
    }

    public function destroy($id)
    {
        $findData = WisataModel::find($id);

        if (!$findData) {
            return response()->json([
                'errors' => 'Data Wisata Tidak Ditemukan!',
            ], 404);
        }

        if ($findData->foto) {
            Storage::disk('public')->delete($findData->foto);
        }

        $findData->delete();

        return response()->json([
            'success' => 'Berhasil Menghapus Data!',
        ]);
    }

    private function storeImage(UploadedFile $file): string
    {
        $filename = Str::random(40) . '.' . $file->extension();

        return $file->storeAs('images', $filename, 'public');
    }
}
