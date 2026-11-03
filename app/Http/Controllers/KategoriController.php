<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategoris.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Kategori::withCount('items');

        if ($request->filled('kode')) {
            $data_search = $data_search->where('kode', $kode);
        }
        if ($request->filled('nama')) {
            $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }

        $data_search = $data_search->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = (object)[
                'id' => null,
                'kode' => '',
                'nama' => ''
            ];
        } else {
            $item = Kategori::findOrFail($id);
        }

        $data['item'] = $item;
        $data['method'] = $method;
        return view('kategoris.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = Kategori::with('items')->where('kode', $kode)->firstOrFail();
        return view('kategoris.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => $method == 'new' ? 'nullable|string|unique:kategoris,kode' : 'required|string|unique:kategoris,kode,' . $id
        ]);

        if ($method == 'new') {
            $kategori = new Kategori;
            if ($request->filled('kode')) {
                $kode = $request->kode;
            } else {
                $count = Kategori::withTrashed()->count('id') + 1;
                $kode = 'KAT-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        } else {
            $kategori = Kategori::findOrFail($id);
            $kode = $request->filled('kode') ? $request->kode : $kategori->kode;
        }

        $kategori->nama = $request->nama;
        $kategori->kode = $kode;
        $kategori->save();

        return redirect('kategoris');
    }

    public function delete($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect('kategoris');
    }
}

