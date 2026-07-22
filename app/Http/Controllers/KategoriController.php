<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Read
    public function index()
    {
        $kategoris = Kategori::all();

        return view('kategori.index',compact('kategoris'));
    }

    // Create
    public function store(Request $request)
    {
        $request->validate([
            'namaKategori'=>'required'
        ]);

        Kategori::create($request->all());

        return back()->with('success','Kategori berhasil ditambahkan');
    }

    // Update
    public function update(Request $request,$id)
    {
        $kategori=Kategori::findOrFail($id);

        $kategori->update($request->all());

        return back()->with('success','Kategori berhasil diupdate');
    }

    // Delete
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success','Kategori berhasil dihapus');
    }
}