<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        $writers = Writer::latest()->paginate(5);
        return view('writer.index', compact('writers'));
    }
    
    public function create()
    {
        return view('writer.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'writer'     => 'required|unique:writers'
        ]);
    
    
        $writer = Writer::create([
            'writer'     => $request->writer
        ]);
    
        if($writer){
            //redirect dengan pesan sukses
            return redirect()->route('writer.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('writer.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Writer $writer)
    {
        $writerrr = Writer::find($writer);
        return view('writer.edit', compact('writer'));
    }

    public function update(Request $request, Writer $writer)
    {

        $request->validate([
            'writer' => 'required|unique:writers',
        ]);

        $writer->update([
            'writer' => $request->writer
        ]);

        return redirect()->route('writer.index')->with(['success' => 'Data Berhasil Diperbarui!']); 
    }

    public function destroy($id)
    {
        $writerr = Writer::findOrFail($id);
        try{
            $writerr->delete();
        } catch (\Exception $e){
            return redirect()->route('writer.index')->with(['warning' => 'Terdapat Penulis di dalam Tabel Post!']);
        }
        return redirect()->route('writer.index')->with(['success' => 'Data Berhasil Dihapus!']); 


    }
}
