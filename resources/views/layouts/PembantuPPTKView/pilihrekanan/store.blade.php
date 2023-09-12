@extends('layouts.app')

@section('title', 'Pilih Rekanan - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Pilihan Rekanan has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.pilihrekanan.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
