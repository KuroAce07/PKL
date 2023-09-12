@extends('layouts.app')

@section('title', 'Berita Acara Serah Terima Hasil Pekerjaan (BAST) - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Berita Acara Serah Terima Hasil Pekerjaan (BAST) has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.bast.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
