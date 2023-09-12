@extends('layouts.app')

@section('title', 'Buku Rekening Bank - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Buku Rekening Bank has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.buku.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
