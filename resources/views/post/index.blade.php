@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
          <div class="card border-0 shadow rounded border-bottom-primary">
              <div class="card-body">
                  <a href="{{ route('post.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">GAMBAR</th>
                          <th scope="col">PENULIS</th>
                          <th scope="col">KATEGORI</th>
                          <th scope="col">JUDUL</th>
                          <th scope="col">KONTEN</th>
                          <th scope="col">AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($posts as $post)
                          <tr>
                              <td class="text-center">
                                  <img src="{{ Storage::url('public/posts/').$post->image }}" class="rounded" style="width: 100px; height : auto;">
                              </td>
                              <td>{{ $post->writer->writer}}</td>
                              <td>{{ $post->kategoris->pluck('kategori')->implode(',') }}</td>
                              <td>{{ $post->title }}</td>
                              <td>{{ $post->content }}</td>
                              <td class="text-center">
                                  <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                      <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                  </form>
                              </td>
                          </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post Belum Tersedia.
                            </div>
                        @endforelse
                      </tbody>
                    </table>
                    
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection