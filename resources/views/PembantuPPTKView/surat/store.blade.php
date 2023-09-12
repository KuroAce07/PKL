@extends('layouts.app')

@section('title', 'Surat Pemesanan - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Surat Pemesanan has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.surat.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
