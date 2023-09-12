@extends('layouts.app')

@section('title', 'Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH) - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH) has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.baph.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
