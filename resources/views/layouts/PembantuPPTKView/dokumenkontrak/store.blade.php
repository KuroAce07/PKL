@extends('layouts.app')

@section('title', 'Dokumen Kontrak - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Dokumen Kontrak has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.dokumenkontrak.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
