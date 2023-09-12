@extends('layouts.app')

@section('title', 'Dokumen Pendukung - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Dokumen Pendukung has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.dokumenpendukung.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
