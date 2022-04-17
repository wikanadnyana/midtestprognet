<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(5);
        return view('kategori.index', compact('kategoris'));
    }
    
    public function create()
    {
        return view('kategori.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori'     => 'required|unique:kategoris'
        ]);
    
    
        $kategori = Kategori::create([
            'kategori'     => $request->kategori
        ]);
    
        if($kategori){
            //redirect dengan pesan sukses
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Kategori $kategori)
    {
        $kategoriii = Kategori::find($kategori);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {

        $request->validate([
            'kategori' => 'required|unique:kategoris',
        ]);

        $kategori->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diperbarui!']); 
    }

    public function destroy($id)
    {
        $kategorii = Kategori::findOrFail($id);
        try{
            $kategorii->delete();
        } catch (\Exception $e){
            return redirect()->route('kategori.index')->with(['info' => 'Terdapat kategori di dalam Tabel Post!']);
        }
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']); 

    }
}
