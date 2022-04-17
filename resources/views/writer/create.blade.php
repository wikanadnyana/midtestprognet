@extends('layouts.dashboard')

@section('content')
<div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('writer.store') }}" method="POST">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">PENULIS</label>
                                <input type="text" class="form-control @error('writer') is-invalid @enderror" name="writer" value="{{ old('writer') }}" placeholder="Masukkan Penulis">
                            
                                <!-- error message untuk title -->
                                @error('writer')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection