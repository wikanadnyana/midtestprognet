@extends('layouts.dashboard')
@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-normal">GAMBAR</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-normal">PENULIS</label>
                                <select name="writer_id" class="form-control @error('writer_id') is-invalid @enderror">
                                    <option disabled selected>"{{ old('writer_id', $post->writer->writer) }}"</option>
                                    @foreach ($writer as $item)
                                        <option value="{{ $item->id }}">{{ $item->writer}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-normal">KATEGORI</label>
                                <select class="form-select categories" name="kategoris[]" multiple='multiple'>
                                    @foreach ($kategoris as $category)
                                    @if (old('category_id', $category->id) === $category->id)
                                      <option value="{{ $category->id }}" selected> {{ $category->kategori }} </option>
                                      @else
                                      <option value="{{ $category->id }}"> {{ $category->kategori }} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-normal">JUDUL</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Blog">
                            
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-normal">KONTEN</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="9" placeholder="Masukkan Konten Blog">{{ old('content', $post->content) }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection