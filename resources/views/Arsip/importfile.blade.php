@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('Arsip.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="inputFile">Choose File:</label>
                    <input 
                        type="file" 
                        name="file" 
                        id="inputFile"
                        class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
