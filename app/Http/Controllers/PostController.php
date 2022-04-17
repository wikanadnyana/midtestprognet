<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPost;
use App\Models\Writer;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {

        return view('post.index', [
            "posts" => Post::get()
        
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'writer' => Writer::all(),
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'image'     => 'required|image|mimes:png,jpg,jpeg',
            'writer_id' => 'required',
            'title'     => 'required',
            'content'   => 'required'
        ]);

         //upload image
         $image = $request->file('image');
         $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image'     => $image->hashName(),
            'writer_id' => $request->writer_id,
            'title'     => $request->title,
            'content'   => $request->content
        ]);
        
        foreach ($request->kategoris as $key => $value) {
            KategoriPost::create([
                'kategori_id' => $value,
                'post_id' => $post->id,
            ]);
        }
        
        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($id)
    {
        return view('post.allpost', [
            'post' => Post::findOrFail($id),
        ]);

    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'kategoris' => Kategori::all(),
            'writer' => Writer::all()
        ]);
    }

    public function update(Request $request, Post $post)
    {

        $this->validate($request, [
            'writer_id' => 'required',
            'title'     => 'required',
            'content'   => 'required'
        ]);
    
        //get data Post by ID
        $post = Post::findOrFail($post->id);
    
        if($request->file('image') == "") {
    
            $post->update([
                'writer_id' => $request->writer_id,
                'title'     => $request->title,
                'content'   => $request->content
            ]);
            $post->kategoris()->sync($request->kategoris);
            $post->save();
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/posts/'.$post->image);
    
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());
    
            $post->update([
                'image'     => $image->hashName(),
                'writer_id' => $request->writer_id,
                'title'     => $request->title,
                'content'   => $request->content
            ]);
            $post->kategoris()->sync($request->kategoris);
            $post->save();
        }
    
        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('post.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('post.index')->with(['error' => 'Data Gagal Diupdate!']);
        }

    }
    
    public function destroy($id)
    {
        $post = Post::find($id); 
        $post->delete();
        $post->kategoris()->detach();
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
