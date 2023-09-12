@extends('layouts.app')

@section('title', 'Dokumen Justifikasi - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Dokumen Justifikasi has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.dokumenjustifikasi.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
