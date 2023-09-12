@extends('layouts.app')

@section('title', 'Dokumen Kontrak SPK - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Dokumen Kontrak SPK has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.dokumenkontrakspk.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
